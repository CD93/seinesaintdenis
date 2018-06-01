<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');

function formulaires_quiz_validation_cine_charger_dist($id_quiz,$liste_quiz)
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

function formulaires_quiz_validation_cine_verifier_dist($id_quiz,$liste_quiz)
{
}

function formulaires_quiz_validation_cine_traiter_dist($id_quiz,$liste_quiz)
{
	$brep = array();
	$score = 0;
	foreach ($liste_quiz as $key => $value) {
	    $score= $score + session_get($value);
	    if(session_get($value)==1){
	    	$brep[] = $key;
		}
	    
	}
	$nb_question = count($liste_quiz);
	if ($score==0) $message =	"Vous n'avez aucune bonne réponse.";
	elseif ($score==1) $message =	"Vous avez ".$score." bonne réponse sur ".$nb_question." !";
	elseif ($score==$nb_question) $message =	"Bravo, vous avez toutes les bonnes réponses !";
	else $message =	"Vous avez ".$score." bonnes réponses sur ".$nb_question." !";
	if (($score!=0)&&($score!=$nb_question)){
		$message .= "<br/>Vous avez répondu correctement aux questions ";
		foreach ($brep as $value)
		{
			$message .= "  ".($value+1);
		}
	}
	return array(
		"editform" => false,
		"message_ok" => $message
	);
	
}
?>