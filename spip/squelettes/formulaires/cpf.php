<?php
function formulaires_cpf_charger_dist()
{
	$valeurs = array
	(
		'enfantcharge' 			=> '0',
		'enfanthandicap' 		=> '0',
		'revenus' 		=> '0'	
	);
	return $valeurs;
}

function formulaires_cpf_verifier_dist(){
		$erreurs = array();
		if (!is_whole_number(_request('enfantcharge'))||!is_whole_number(_request('enfanthandicap'))||!is_whole_number(_request('revenus')))
		{
			$erreurs['enfantcharge'] = "Vous devez renseigner un chiffre entier";
			$erreurs['revenus'] = "Vous devez renseigner un nombre";
		}
		if (!_request('enfantcharge')&!_request('enfanthandicap') ) {
			$erreurs['enfantcharge'] = "Vous devez avoir au moins un enfant";
		}
		if (_request('revenus')<=0) {
			$erreurs['revenus'] = "Veillez renseigner vos revenus !";
		}
		if (count($erreurs)) {
			$erreurs['message_erreur'] = "Une erreur est pr&eacute;sente dans votre saisie";
		}
		return $erreurs;
}
function is_whole_number($var){
  return (is_numeric($var)&&(intval($var)==floatval($var)));
}

function formulaires_cpf_traiter_dist()
{
	$enfants_charge = _request('enfantcharge');
	$totrev = _request('revenus');
	$enfants_handi = _request('enfanthandicap');
	//ces 5 paramètres suivants sont à réactualiser en janvier de chaque année
	$plancher = 550;
	$plafond = 5200;
	$minimum_horaire = 0.33;
	$maximum_horaire = 2.74;
	$taux_effort_tab = array(1=>0.6, 2=>0.5,3=>0.4,4=>0.30,5=>0.30,6=>0.30,7=>0.30,8=>0.20);
	//fin des paramètres à réactualiser
	$nb_enf_total = $enfants_charge+$enfants_handi;
	$taux_effort = $taux_effort_tab[$nb_enf_total];
	$prix_horaire = round($totrev*($taux_effort/1000),2);
	$prix_horaire_final = ($prix_horaire<=$minimum_horaire ? $minimum_horaire : ($prix_horaire>=$maximum_horaire ? $maximum_horaire : $prix_horaire));
	$prix_journee = $prix_horaire_final*10;
	$reponse = "votre prix de journ&eacute;e est de ".$prix_journee." Euros" ;
	$reponse .= "<br/><small>les r&eacute;sultats obtenus &agrave; partir de cet outil de simulation n'ont qu'une valeur indicative et non contractuelle.</small>";
	return $reponse;
}
?>