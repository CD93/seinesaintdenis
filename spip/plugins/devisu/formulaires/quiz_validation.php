<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');

function formulaires_quiz_validation_charger_dist($id_quiz,$liste_quiz)
{
	$valeurs = array
	(
		'reponse' 	=> '',
		'editform' => 'oui',
		'email' => '',
		'id_quiz' => $id_quiz
	);
	return $valeurs;
}

function formulaires_quiz_validation_verifier_dist($id_quiz,$liste_quiz)
{
}

function formulaires_quiz_validation_traiter_dist($id_quiz,$liste_quiz)
{
	$email = _request('email');
	$score = 0;
	foreach ($liste_quiz as $key => $value) {
	    $score= $score + session_get($value);
	}
	$nb_question = count($liste_quiz);
	$enregistre = array();
	$enregistre[] = $email;
	$enregistre[] = $id_quiz;
	$enregistre[] = $score." sur ".$nb_question;
	$enregistre[] = date("Ymd");
	 
	$csv = new SplFileObject('IMG/csv/gagnant'.$id_quiz.'.csv', 'a');
	$line = '"';
	$line .= implode('";"', $enregistre);
	$line .= '"';
	$line .= "\r\n";
	$csv->fwrite($line);
	
	return array(
		"editform" => false,
		"message_ok" => "Votre participation a bien été enregistrée."
	);
	
}
?>