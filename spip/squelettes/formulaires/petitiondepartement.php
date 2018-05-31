<?php
/*
 * Plugin Recommander a un ami
 * (c) 2006-2010 Fil
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/filtres');
include_spip('base/abstract_sql');

/**
 * Charger les valeurs du formulaire recommander
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_petitiondepartement_charger_dist(){
	$valeurs = array(
		'email'=> isset($GLOBALS['visiteur_session']['email']) ? $GLOBALS['visiteur_session']['email'] :'',
		'nom'=> '',
		'prenom'=> '',
		'profession'=> ''
	);

	return $valeurs;
}

/**
 * Verifier les valeurs du formulaire recommander
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_petitiondepartement_verifier_dist(){
	$erreurs = array();

	foreach(array('email') as $c) {
		if (!$email = trim(_request($c)))
			$erreurs[$c] = _T('form_prop_indiquer_email');
		elseif (!email_valide($email)){
			$erreurs[$c] = "email invalide";
			}
	}
	return $erreurs;
}


/**
 * Envoyer le mail
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_petitiondepartement_traiter_dist(){
	$email = _request('email');
	$nom = _request('nom');
	$prenom = _request('prenom');
	$profession = _request('profession');
	$message .= "Votre signature à bien été enregistrée. Merci";
	sql_insertq('petition_departement', array(
			'nom' => $nom, 
			'prenom' => $prenom,
			'email' => $email,

			'profession' => $profession
			));
	return array('message_ok' => $message);
}

?>