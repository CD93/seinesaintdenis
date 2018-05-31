<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/session');

function formulaires_badges_charger_dist($id_article)
{
	$valeurs = array
	(
		'email' 	=> '',
		'nom' =>'',
		'adresse' => '',
		'cp' => '',
		'ville' => '',
		'abo' => '',
		'id_article' => $id_article,
		"editform" => 'oui'	
	);
	return $valeurs;
}

function formulaires_badges_verifier_dist($id_article)
{
}

function formulaires_badges_traiter_dist($id_article)
{
	$email = _request('email');
	$id = sql_insertq('spip_badges', 
	array('id_article'=>$id_article,
			'email' =>$email,
			'nom' =>_request('nom'),
			'adresse' => _request('adresse'),
			'cp' => _request('cp'),
			'ville' => _request('ville'),
			'abo' => _request('abo')
			));
	//session_set("pgp",$valeur);
	return array(
		"editform" => false,
		"message_ok" => "Félicitations, vous recevrez votre badge prochainement dans votre boîte aux lettres !"
	);
	
}
?>