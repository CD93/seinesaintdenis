<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2016                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/


if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_ecrirecontact_charger_dist() {
	include_spip('inc/texte');
	$puce = definir_puce();
	$valeurs = array(
		'nombre_a' => rand(1, 10),
		'nombre_b' => rand(1, 10),
		'sujet_message_auteur' => '',
		'texte_message_auteur' => '',
		'email_message_auteur' => isset($GLOBALS['visiteur_session']['email']) ?
			$GLOBALS['visiteur_session']['email'] : '',
		'nobot' => '',
		'test' => ''
	);
	return $valeurs;
}

function formulaires_ecrirecontact_verifier_dist() {
	$erreurs = array();

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

	if (contains_bad_str($from)) $erreurs['recommander_from'] = contains_bad_str($from);
	if (contains_bad_str($to)) 	$erreurs['recommander_to'] = contains_bad_str($to);
	if (contains_bad_str($message)) 	$erreurs['recommander_message'] = contains_bad_str($message);
	if (contains_newlines($from)) $erreurs['recommander_from'] = contains_newlines($from);
	if (contains_newlines($to)) 	$erreurs['recommander_to'] = contains_newlines($to);



	include_spip('inc/filtres');
	if (!$adres = _request('email_message_auteur')) {
		$erreurs['email_message_auteur'] = _T('info_obligatoire');
	} elseif (!email_valide($adres) or contains_bad_str($adres) or contains_newlines($adres)) {
		$erreurs['email_message_auteur'] = _T('form_prop_indiquer_email');
	} else {
		include_spip('inc/session');
		session_set('email', $adres);
	}

	if (!$sujet = _request('sujet_message_auteur')) {
		$erreurs['sujet_message_auteur'] = _T('info_obligatoire');
	} elseif (!(strlen($sujet) > 3)) {
		$erreurs['sujet_message_auteur'] = _T('forum:forum_attention_trois_caracteres');
	} elseif (contains_bad_str($sujet) or contains_newlines($sujet)){
		$erreurs['sujet_message_auteur'] = "certains caractères utilisés sont interdits";
	}

	if (!$html = _request('texte_message_auteur')) {
		$erreurs['texte_message_auteur'] = _T('info_obligatoire');
	} elseif (!(strlen($html) > 10)) {
		$erreurs['texte_message_auteur'] = _T('forum:forum_attention_dix_caracteres');
	}

	if (_request('nobot')) {
		$erreurs['message_erreur'] = _T('pass_rien_a_faire_ici');
	}
	if(_request('test') != _request('nba')+_request('nbb')){
		$erreurs['message_erreur'] = "mauvaise réponse au calcul";
	}

	return $erreurs;
}

function formulaires_ecrirecontact_traiter_dist() {
	$mail="contact@seinesaintdenis.fr";
	$adres = _request('email_message_auteur');
	$sujet = _request('sujet_message_auteur');

	$sujet = '[' . supprimer_tags(extraire_multi($GLOBALS['meta']['nom_site'])) . '] '
		. _T('info_message_2') . ' '
		. $sujet;
	$html = '';
	$html .= "email: ".$adres."<br/>";
	$html .= "objet: ".$sujet."<br/>";
	$html .= "contenu: ";
	$html .= _request('texte_message_auteur');
	$html .= "<br/><br/>" . _T('envoi_via_le_site') . ' '
		. supprimer_tags(extraire_multi($GLOBALS['meta']['nom_site']))
		. ' (' . $GLOBALS['meta']['adresse_site'] . "/) --<br/>";
	$htmlar = "Nous avons bien reçu votre courriel, nos équipes vont transmettre votre demande au service concerné dans les deux jours ouvrés. Merci de nous avoir contactés. L'équipe web.<br/> votre message : <br/>"._request('texte_message_auteur');

	// Chargement de la fonction
	$envoyer_mail = charger_fonction('envoyer_mail', 'inc/');

	$texte = str_replace("<br/>","\n",$html);
	$textear = str_replace("<br/>","\n",$htmlar);
	$corps = array(
		'html' => $html,
		'texte' => $texte,
		'repondre_a' => $adres
	);
	$corpsar = array(
		'html' => $htmlar,
		'texte' => $textear
	);
	$ar = ($envoyer_mail($adres, "accusé de reception ".$sujet, $corpsar, $mail,
	  'X-Originating-IP: ' . $GLOBALS['ip']));
	if ($envoyer_mail($mail, $sujet, $corps, $adres,
	  'X-Originating-IP: ' . $GLOBALS['ip'])) {
	  $message = "Votre message a bien été envoyé, vous allez recevoir un accusé de réception par courriel";
	  return array('message_ok' => $message);
	} else {
	  $message = _T('pass_erreur_probleme_technique');
	  return array('message_erreur' => $message);
	}
	return array('message_ok' => $message);

}
