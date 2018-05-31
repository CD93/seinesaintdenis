<?php
/*
 * Plugin Recommander a un ami
 * (c) 2006-2010 Fil
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/filtres');

/**
 * Charger les valeurs du formulaire recommander
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_recommander_charger_dist($titre, $url='', $texte='', $subject=''){
	$valeurs = array(
		'recommander_from'=> isset($GLOBALS['visiteur_session']['email']) ? $GLOBALS['visiteur_session']['email'] :'',
		'recommander_to'=> '',
		'recommander_message'=> '',
		'nombre_a' => rand(1, 10),
		'nombre_b' => rand(1, 10),
		'nobot' => '',
		'test' => ''
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
function formulaires_recommander_verifier_dist($titre, $url='', $texte='', $subject=''){
	$erreurs = array();
	foreach(array('recommander_from','recommander_to') as $c) {
		if (!$email = trim(_request($c)))
			$erreurs[$c] = _T('form_prop_indiquer_email');
		elseif (!email_valide($email))
			$erreurs[$c] = _T('pass_erreur_non_valide', array(
				'email_oubli' => htmlspecialchars($email)
				)
			);
	}

	function contains_bad_str($str_to_test) {
	  $bad_strings = array(
      "content-type:"
      ,"mime-version:"
      ,"multipart/mixed"
			,"Content-Transfer-Encoding:"
      ,"bcc:"
			,"cc:"
			,"to:"
	  );
	  foreach($bad_strings as $bad_string) {
	    if(eregi($bad_string, strtolower($str_to_test))) {
	      return "$bad_string found. Suspected injection attempt - mail not being sent.";
	    }
	  }
	}
	function contains_newlines($str_to_test) {
	  if(preg_match("/(%0A|%0D|\n+|\r+)/i", $str_to_test) != 0) {
	    return "newline found in $str_to_test. Suspected injection attempt - mail not being sent.";
	  }
	}
	$from = _request('recommander_from');
	$to = _request('recommander_to');
	$message = _request('recommander_message');
	$subject = _request('subject');
	if (contains_bad_str($from)) $erreurs['recommander_from'] = contains_bad_str($from);
	if (contains_bad_str($to)) 	$erreurs['recommander_to'] = contains_bad_str($to);
	if (contains_bad_str($message)) 	$erreurs['recommander_message'] = contains_bad_str($message);
	if (contains_newlines($from)) $erreurs['recommander_from'] = contains_newlines($from);
	if (contains_newlines($to)) 	$erreurs['recommander_to'] = contains_newlines($to);

	if (_request('nobot')) {
		$erreurs['message_erreur'] = _T('pass_rien_a_faire_ici');
	}
	if(_request('test') != _request('nba')+_request('nbb')){
		$erreurs['message_erreur'] = "mauvaise réponse au calcul";
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
function formulaires_recommander_traiter_dist($titre, $url='', $texte='', $subject=''){
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	   echo("Unauthorized attempt to access page.");
	   exit;
	}
	$subject = sinon ($subject,
		_T('recommander:recommander_titre',array('nom_site'=>$GLOBALS['meta']['nom_site']))
		.sinon($titre, _request('recommander_titre'))
	);

	$contexte = array(
		'titre'=>$titre,
		'texte'=>$texte,
		'url'=>$url ? $url : self(),
		'recommander_from'=>_request('recommander_from'),
		'recommander_to'=>_request('recommander_to'),
		'recommander_message'=>_request('recommander_message'),
	);
	$body = recuperer_fond('modeles/recommander_email',$contexte);
	$header = "X-Originating-IP: ".$GLOBALS['ip']."\n";

	$res = true;
	if (
		include_spip("inc/notifications")
		AND function_exists('notifications_envoyer_mails')){
		notifications_envoyer_mails(_request('recommander_to'), $body, $subject, _request('recommander_from'), $header);
	}
	else {
		$envoyer_mail = charger_fonction('envoyer_mail','inc');
		if (!$envoyer_mail(_request('recommander_to'),$subject,$body,_request('recommander_from'),$header))
			$res = false;
	}
	if (!$res)
		return array('message_erreur' => _L("Erreur lors de l'envoi du message."));
	else
		return array('message_ok' => recuperer_fond('modeles/recommander_envoye',$contexte));
}

?>
