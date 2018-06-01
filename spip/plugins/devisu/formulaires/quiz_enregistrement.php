<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/session');

function formulaires_quiz_enregistrement_charger_dist($id_quiz,$liste_quiz)
{
	$valeurs = array
	(
		'reponse' 	=> '',
		'id_auteur' => '',
		'editform' => 'oui'
	);
	$score = 0;
	foreach ($liste_quiz as $key => $value) {
	    $score= $score + session_get($value);
	}
	$valeurs["score"] = $score;
	return $valeurs;
}

function formulaires_quiz_enregistrement_verifier_dist($id_quiz,$liste_quiz)
{
}

function formulaires_quiz_enregistrement_traiter_dist($id_quiz,$liste_quiz)
{
	$id_auteur = _request('id_auteur');
	$score = 0;
	$rec = array();
	foreach ($liste_quiz as $key => $value) {
	    $score= $score + session_get($value);
	    if (session_get($value)=="1") $rec[$value] = "1";
	    if (session_get($value)=="0") $rec[$value] = "0";
	}
	$nb_question = count($liste_quiz);
	$valeur = serialize($rec);
	sql_updateq('spip_auteurs', array('pgp' => $valeur,'bio' => $score), 'id_auteur='.intval($id_auteur));
	//session_set("pgp",$valeur);
	return array(
		"editform" => false,
		"message_ok" => "votre participation est enregistrée."
	);
	
}
?>