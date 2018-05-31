<?php
function formulaires_adpa_charger_dist()
{
	$valeurs = array
	(
		'age' 				=> '',
		'reside93' 			=> '',
		'aide' 				=> '',
		'etatcivil' 		=> '',
		'ressources' 		=> '0.00',
		'prelevement' 		=> '0.00',
		'valeurCapitaux' 	=> '0.00',
		'valeurBatis' 		=> '0.00',
		'valeurNonBatis' 	=> '0.00',
	);
	return $valeurs;
}

function formulaires_adpa_verifier_dist()
{
	$erreurs = array();
	
	foreach(array('age', 'reside93', 'aide') as $valeur)
		if(!_request($valeur))
			$erreurs[$valeur] = 'Ce champ est obligatoire';
	
	if(_request('ressources') == 0 && _request('prelevement') == 0 && is_numeric(_request('ressources')) && is_numeric(_request('prelevement')))
	{
		$erreurs['ressources'] = 'Vous devez renseigner au moins l\'une des deux premi&egrave;res ressources';
		$erreurs['prelevement'] = 'Vous devez renseigner au moins l\'une des deux premi&egrave;res ressources';				
	}
	
	foreach(array('ressources', 'prelevement') as $valeur)
	{
		if(!is_numeric(_request($valeur)))
			$erreurs[$valeur] = 'Vous devez entrer une valeur num&eacute;rique';
		if(_request($valeur) < 0)
			$erreurs[$valeur] = 'Vous devez entrer une valeur positive ou &eacute;gale &agrave; z&eacute;ro';
	}
			
	foreach(array('valeurCapitaux', 'valeurBatis', 'valeurNonBatis') as $valeur)
		if(!is_numeric(_request($valeur)))
			$erreurs[$valeur] = 'Vous devez entrer une valeur num&eacute;rique';
		else if(_request($valeur) < 0)
			$erreurs[$valeur] = 'Vous devez entrer une valeur positive ou &eacute;gale &agrave; z&eacute;ro';
	
    if (count($erreurs))
        $erreurs['message_erreur'] = '';
		
	return $erreurs;
}

function formulaires_adpa_traiter_dist()
{
	$retour = array('editable' => true);
	$ressourceMensuelles = (_request('ressources')/12) + (_request('prelevement')/12) + ((_request('valeurCapitaux')/12)*0.30) + ((_request('valeurBatis')/12)*0.50) + ((_request('valeurNonBatis')/12)*0.80);
	switch (_request('etatcivil'))
	{
		case 'seul':
			$quotientFamilial = 1;
			break;
		case 'conjointDomicile':
			$quotientFamilial = 1.70;
			break;
		case 'conjointHebergement':
			$quotientFamilial = 2;
			break;
		default:
			// C'est impossible...
			break;
	}
	$ressourceMensuellesUsager = $ressourceMensuelles/$quotientFamilial;
	$majorationTiercePersonne =  1097; // Valeur à changer toutes les années.	
	$seuil1 = 0.67*$majorationTiercePersonne;
	$seuil2 = 2.67*$majorationTiercePersonne;
	if($ressourceMensuellesUsager < $seuil1)
		$participationUsager = 0;
	elseif($ressourceMensuellesUsager > $seuil2)
		$participationUsager = 90;
	else
		$participationUsager = 90*(($ressourceMensuellesUsager - $seuil1)/(2*$majorationTiercePersonne));
	$participationDepartement = 100 - $participationUsager;	
	$retour = '<h3>Estimation de votre taux de participation &agrave; l\'A.D.P.A &agrave; domicile</h3>
				<br>
				L\'A.D.P.A &agrave; domicile prend en charge tout ou partie des frais qu\'occasionne la d&eacute;pendance.
				Le montant de l\'A.D.P.A &agrave; domicile vers&eacute; par le d&eacute;partement couvre la diff&eacute;rence entre ces frais et le montant de votre participation.
				Le taux de votre participation est calcul&eacute; en fonction de vos ressources.
				<br><br>
				Le montant de vos ressources pris en compte s\'&eacute;l&egrave;ve &agrave; : '.round($ressourceMensuelles, 2).' euros par mois	
				<br>
				Votre taux de participation &agrave; l\'A.D.P.A serait de : '.round($participationUsager, 2).' % 
				<br>
				Le taux de participation du D&eacute;partement serait de : '.round($participationDepartement, 2).' % 
				<br><br>
				Ceci est <u><b>une estimation</b></u> qui ne peut &ecirc;tre oppos&eacute;e au d&eacute;partement de  la Seine-Saint-Denis.
				Seul le montant de votre taux de participation figurant sur la d&eacute;cision d\'attribution de l\'A.D.P.A &agrave; domicile engage le d&eacute;partement.
				<br/><br/><center><a href="http://www.seine-saint-denis.fr/ADPA.html">Effectuer une nouvelle estimation</a><center>
				';
	
	return $retour;
}
?>