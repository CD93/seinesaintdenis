<?php
function formulaires_ashfl_charger_dist()
{
	$valeurs = array
	(
		'age' 			=> '',
		'reside93' 		=> '',
		'heberge' 		=> '',
		'jour' 			=> '0.00',
		'salaires' 		=> '0.00',
		'retraites' 	=> '0.00',
		'revenusic' 	=> '0.00',
		'viageres' 		=> '0.00',
		'revenuscm' 	=> '0.00',
		'revenusf' 		=> '0.00',
		'aspa' 			=> '0.00',
		'etatcivil' 	=> 'seul',
	);
	return $valeurs;
}

function formulaires_ashfl_verifier_dist()
{
	$erreurs = array();
	
	foreach(array('age', 'reside93', 'heberge') as $valeur)
		if(!_request($valeur))
			$erreurs[$valeur] = 'Ce champ est obligatoire';
	
	if(is_numeric(_request('jour')))
	{
		if(_request('jour') < 0)
			$erreurs['jour'] = 'Vous devez entrer une valeur positive';
		else if(_request('jour') == 0)
		$erreurs['jour'] = 'Ce champ est obligatoire';
	}
	else 
		$erreurs['jour'] = 'Vous devez entrer une valeur num&eacute;rique';
	
	foreach(array('salaires', 'retraites', 'revenusic', 'viageres', 'revenuscm', 'revenusf', 'aspa') as $valeur)
		if(!is_numeric(_request($valeur)))
			$erreurs[$valeur] = 'Vous devez entrer une valeur num&eacute;rique';
		else if(_request($valeur) < 0)
			$erreurs[$valeur] = 'Vous devez entrer une valeur positive ou &eacute;gale &agrave; z&eacute;ro';
	
	$minimumVieillesse =  708.95; // Valeur a changer toutes les ann�es.
	if(_request('aspa') > $minimumVieillesse)
		$erreurs['aspa'] = 'Les ressources ne peuvent pas &ecirc;tre sup&eacute;rieures &agrave; '.$minimumVieillesse.' &euro;, montant minimum vieillesse pour une personne seule, au 1er avril 2010.';
    
	if (count($erreurs))
        $erreurs['message_erreur'] = '';
		
	return $erreurs;
}

function formulaires_ashfl_traiter_dist()
{
	$retour = array('editable' => true);
	$ressourceMensuelles = (_request('salaires')+ _request('retraites') + _request('revenusic') + _request('viageres') + _request('revenuscm') + _request('revenusf'))/12;
	$totalRessource = $ressourceMensuelles + _request('aspa');
	$minimumVieillesse = 708.95; // Valeur a changer toutes les ann�es.
	if($ressourceMensuelles > $minimumVieillesse)	
	{	
		$capacaiteContributive = ($ressourceMensuelles - $minimumVieillesse) * 0.90;
		if($capacaiteContributive < 5)
			$capacaiteContributive = 0;				
	}
	else
		$capacaiteContributive = 0;
	$montantSejour = _request('jour') * 31;
	$resteFinancer = $montantSejour - $capacaiteContributive;
	$retour = '<h3>Estimation de votre taux de participation &agrave; l\'A.S.H.</h3>
				<br />
				<br />
				Le montant de vos ressources pris en compte s\'&eacute;l&egrave;ve &agrave; <b>'.number_format($totalRessource, 2, ",", " ").' &euro;</b> par mois
				<br />
				Le co&ucirc;t mensuel de votre s&eacute;jour s\'&eacute;l&egrave;ve &agrave; <b>'.number_format($montantSejour, 2, ",", " ").' &euro;</b>
				<br />
				L\'estimation de votre capacit&eacute; contributive mensuelle s\'&eacute;l&egrave;ve &agrave; <b>'.number_format($capacaiteContributive, 2, ",", " ").' &euro;</b>';
	if($capacaiteContributive < $montantSejour)
		$retour .= '<br />
					<br />
					L\'estimation de votre capacit&eacute; contributive est inf&eacute;rieure au co&ucirc;t de votre s&eacute;jour. 
					<br />
					<br />
					Si vous n\'avez pas d\'oblig&eacute;s alimentaires vous pouvez donc pr&eacute;tendre &agrave; l&rsquo;Aide Sociale &agrave; l\'H&eacute;bergement qui compl&egrave;tera &agrave; hauteur de <b>'.number_format(($montantSejour - $capacaiteContributive), 2, ",", " ").' &euro;</b> par mois.
					<br />
					Si vous b&eacute;n&eacute;ficiez d\'une Allocation Logement (A.L.) ou d\'une Aide Personnalis&eacute;e au Logement (A.P.L.), celle-ci sera r&eacute;cup&eacute;r&eacute;e en totalit&eacute; par le Conseil g&eacute;n&eacute;ral.					
					<br />
					<br />
					Sinon vos oblig&eacute;s alimentaires seront sollicit&eacute;s en fonction de leur situation financi&egrave;re et familiale.
					<br />
					Pour &eacute;valuer leur participation &eacute;ventuelle, veuillez vous munir du montant total de leurs ressources annuelles et passer  &agrave; l\'&eacute;tape suivante : 					
					<a href="./spip.php?article861&totalRessource='.$totalRessource.'&montantSejour='.$montantSejour.'&capacaiteContributive='.$capacaiteContributive.'">Ajouter un oblig&eacute; alimentaire</a>
					<br />';
	else
		$retour .= '<br />
					<br />
					L\'estimation de votre capacit&eacute; contributive est sup&eacute;rieure ou &eacute;gale au co&ucirc;t de votre s&eacute;jour.
					<br />
					En fonction des donn&eacute;es fournies, vous ne pouvez b&eacute;n&eacute;ficier de l\'Aide Sociale &agrave; l\'H&eacute;bergement.
					<br />';					
	$retour .= 	'<br />
				<a href="./spip.php?article4">Autre estimation</a>
				<br />
				<a href="https://seinesaintdenis.fr">Quitter l\'estimation</a>
				<br />
				<br />
				<b>Rappel :</b> Ceci est une simulation et ne peut engager le D&eacute;partement de la Seine-Saint-Denis. 
				La d&eacute;cision est prise par le Pr&eacute;sident du Conseil g&eacute;n&eacute;ral au vu de la demande d&ucirc;ment remplie 
				et sign&eacute;e accompagn&eacute;e des justificatifs n&eacute;cessaires.';
	return $retour;
}
?>