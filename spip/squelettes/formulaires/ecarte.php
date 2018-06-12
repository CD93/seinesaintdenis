<?php
function formulaires_ecarte_charger_dist(){
	$valeurs['numero']='';
	return $valeurs;
}
function formulaires_ecarte_verifier_dist(){
	$erreurs = array();
	// verifier que les champs obligatoires sont bien la :
	foreach(array('mail_dest','mail_exp') as $obligatoire)
		if (!_request($obligatoire)) $erreurs[$obligatoire] = 'Ce champ est obligatoire';
	
	// verifier que si un email a été saisi, il est bien valide :
	if (count($erreurs))
		$erreurs['message_erreur'] = 'Votre saisie contient des erreurs !';
	return $erreurs;
}

function formulaires_ecarte_traiter_dist(){
	$mail_dest = _request('mail_dest');
	$mail_exp = _request('mail_exp');
	$nom_dest = _request('nom_dest');
	$nom_exp = _request('nom_exp');
	$message = _request('message');
	$message = str_replace("œ","oe",$message);	
	$message=utf8_decode($message);
	$message=nl2br($message);
	$subject='Bonjour '.$nom_dest.', '.$nom_exp.' vous a envoyé une e-carte !';
	$subject=utf8_decode($subject);
	$corp ='
	<img src="https://seinesaintdenis.fr/squelettes/images/voeux2017/E-Carte-2017.jpg"/><br/>
	<p class="texte" style="font-size:14px;padding:10px;border:2px solid #ddd; width:522px;font-family:\'Arial Black\', Gadget, sans-serif; color:#66347D;">'
	.$message.'
	</p><strong style="font-size:14px;padding:10px;width:522px;font-family:\'Arial Black\', Gadget, sans-serif; color:#66347D;">'.$nom_exp.'</strong><br/><br/><p>Envoy&eacute; depuis <a href="https://seinesaintdenis.fr/?page=sommaire&utm_campaign=Voeux_2015&utm_medium=e-mail&utm_source=EmailVoeux">www.seine-saint-denis.fr</a></p>';
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//$headers .= 'To: '.$mail_dest."\r\n";
			$headers .= 'From: '.$mail_exp."\r\n";
			$headers .= 'Reply-To: '.$mail_exp.'' . "\r\n";
			$headers .= 'Bcc: concours@cg93.fr \r\n';
		    if (mail($mail_dest, $subject, $corp, $headers)){
		   	 $reponse = '</p><strong style="font-size:16px;padding:10px; width:522px;font-family:\'Arial Black\', Gadget, sans-serif; color:#66347D;">Votre e-carte &agrave; bien &eacute;t&eacute; envoy&eacute;e !<p>';
			}
	$headers2  = 'MIME-Version: 1.0' . "\r\n";
	$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers2 .= 'From: '.$mail_dest."\r\n";
	$headers2 .= 'Reply-To: '.$mail_dest.'' . "\r\n";
	$accu="Votre e-carte a bien été envoyée à ".$nom_dest;
	$accu=utf8_decode($accu);
	mail($mail_exp, $accu, $corp, $headers2);
			return "<br/>".$reponse;
}