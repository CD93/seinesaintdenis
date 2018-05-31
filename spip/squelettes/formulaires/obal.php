<?php
function formulaires_obal_charger_dist()
{
	$valeurs = array
	(
		'ressources1' 	=> '0.00',
		'nbrPersonnes1' => '0',
		'ressources2' 	=> '0.00',
		'nbrPersonnes2' => '0',
		'ressources3' 	=> '0.00',
		'nbrPersonnes3' => '0',
		'ressources4' 	=> '0.00',
		'nbrPersonnes4' => '0',
		'ressources5' 	=> '0.00',
		'nbrPersonnes5' => '0',
		'ressources6' 	=> '0.00',
		'nbrPersonnes6' => '0',
		'ressources7' 	=> '0.00',
		'nbrPersonnes7' => '0',
		'ressources8' 	=> '0.00',
		'nbrPersonnes8' => '0',
		'ressources9' 	=> '0.00',
		'nbrPersonnes9' => '0',
		'ressources10' 	=> '0.00',
		'nbrPersonnes10' => '0',
	);
	return $valeurs;
}

function formulaires_obal_verifier_dist()
{
	$erreurs = array();
	
	for($i = 1; $i <= 10; $i++)
	{
		$ressources = 'ressources'.$i;
		$nbrPersonnes = 'nbrPersonnes'.$i;
		foreach(array($ressources, $nbrPersonnes) as $valeur)
		{
			if(!is_numeric(_request($valeur)))
				$erreurs[$valeur] = 'Vous devez entrer une valeur num&eacute;rique';
			if(_request($valeur) < 0)
					$erreurs[$valeur] = 'Vous devez entrer une valeur positive ou &eacute;gale &agrave; z&eacute;ro';
			
		}
		if((_request($ressources) > 0 || _request($nbrPersonnes) > 0) && (_request($ressources) == 0 || _request($nbrPersonnes) == 0))
		{
			$erreurs[$ressources] = 'Vous devez remplir les 2 champs';
			$erreurs[$nbrPersonnes] = ' ';
		}
	}
    if (count($erreurs))
        $erreurs['message_erreur'] = '';
	return $erreurs;
}

function formulaires_obal_traiter_dist()
{
	spip_log("\ntraiter 1\n",_LOG_ERREUR);
	
	$retour = array('editable' => true);
	$retour = '<div id="recap" style="display: none;">
				Le co&ucirc;t mensuel de votre s&eacute;jour s\'&eacute;l&egrave;ve &agrave; <b>'.number_format($_GET["montantSejour"], 2, ",", " ").' &euro;</b>
				<br />
				L\'estimation de votre capacit&eacute; contributive mensuelle s\'&eacute;l&egrave;ve &agrave; <b>'.number_format($_GET["capacaiteContributive"], 2, ",", " ").' &euro;</b>
				</div>';
	$smic =  1133; // Valeur à changer toutes les années.
	$totalParticipationOA = 0;
	$nbrObliges = 0;	
	$retour2="";
	for($i = 1; $i <= 10; $i++)
	{
		$ressources = 'ressources'.$i;
		$nbrPersonnes = 'nbrPersonnes'.$i;
		if(_request($ressources) > 0 && _request($nbrPersonnes) > 0)
		{
			$nbrObliges++;
			$csmic = (_request($nbrPersonnes) + 1) * 0.5;
			$smicp = $smic * $csmic;		
			$participationOA = 0;
			$reste = _request($ressources);		
			$nbrTranche = 0;			
			if($reste > $smicp)
			{
				$reste -= $smicp;
				$nbrTranche = (int)($reste / $smic);				
				for($j = 1; $j <= $nbrTranche; $j ++)
				{
					$participationOA += $smic * 0.05 * $j;
				}
				$reste = fmod($reste, $smic);
				$nbrTranche++;
				if(($reste *  0.05 * $nbrTranche) >= 15.00)
				{			
					$participationOA += $reste *  0.05 * $nbrTranche;
				}				
			}
			
			$totalParticipationOA += $participationOA;
			$retour2 .= '<br /><b>'.number_format($participationOA, 2, ",", " ").' &euro;</b> par mois pour votre obligé alimentaire n° <b>'.$nbrObliges.'</b>';
		}
		
	}
	$retour .= 'Vous avez renseigné <b>'.$nbrObliges.'</b> oblig&eacute;(s) alimentaire(s).
			<br />L\'estimation de la capacit&eacute; contributive mensuelle de l\'ensemble de vos 
			oblig&eacute;s alimentaires s\'&eacute;l&egrave;ve &agrave <b>'.number_format($totalParticipationOA, 2, ",", " ").'</b> &euro;.<br />
			<div id="recap1">';			
	$retour .= $retour2;
	
	$retour .= '</div><div id="recap2"  style="display: none;">';
	if(($_GET["montantSejour"] - $_GET["capaciteContributive"] - $totalParticipationOA) > 0)
		$retour .= '<br />L\'estimation du total des capacit&eacute;s contributives est inf&eacute;rieure au co&ucirc;t de votre s&eacute;jour.<br />
				Vous pouvez donc pr&eacute;tendre &agrave; l&rsquo;Aide Sociale &agrave; l\'H&eacute;bergement qui compl&egrave;tera la diff&eacute;rence de <b>'.number_format(($_GET["montantSejour"] - $_GET["capacaiteContributive"] - $totalParticipationOA), 2, ",", " ").'</b> par mois entre le co&ucirc;t de votre s&eacute;jour et le total des capacit&eacute;s contributives.';
	$retour .= '<br />Si vous b&eacute;n&eacute;ficiez d\'une Allocation Logement (A.L.) ou d\'une Aide Personnalis&eacute;e au Logement (A.P.L.), celle-ci sera r&eacute;cup&eacute;r&eacute;e en totalit&eacute; par le Conseil g&eacute;n&eacute;ral.<br /></div>';
	if($_GET["montantSejour"] != 0 || $_GET["capacaiteContributive"] != 0)
		$retour .= "<br /><br /><a href=\"javascript:deplie('recap'); deplie('recap1'); deplie('recap2');\">R&eacute;capitulatif</a>";
	return array(
		"editable" => false,
		"message_ok" => $retour
	);
}
?>