<?php
function formulaires_adpaasv_charger_dist()
{
	$valeurs = array
	(
		'couple' 	=> '',
		'gir' 		=> '',
		'heure' 	=> '',
		'inter' 	=> '',
		'revenus' 	=> '',
	);
	return $valeurs;
}

function formulaires_adpaasv_verifier_dist()
{
	$erreurs = array();
	if (!_request('couple'))
		$erreurs['couple'] = _T('info_obligatoire');
if (!_request('gir'))
	$erreurs['gir'] = _T('info_obligatoire');
if (!_request('heure'))
	$erreurs['heure'] = _T('info_obligatoire');
if (!_request('inter'))
	$erreurs['inter'] = _T('info_obligatoire');
if (!_request('revenus'))
	$erreurs['revenus'] = _T('info_obligatoire');

	return $erreurs;
}

function formulaires_adpaasv_traiter_dist()
{
	
	$revenus = _request('revenus');
	$heure = floatval(str_replace(",",".",_request('heure')));
	//$retour = array('editable' => true);
	$couple = _request('couple');
	$gir = _request('gir');
	$inter = _request('inter');
	switch ($couple)
	{
		case 'non':
			$quotientFamilial = 1;
			break;
		case 'oui':
			$quotientFamilial = 1.70;
			break;
		default:
			break;
	}
	switch ($gir)
	{
		case '1':
			$besoin = 1312.67;
			$besoinnew = 1713.08;
			break;
		case '2':
			$besoin = 1125.14;
			$besoinnew = 1375.54;
			break;
		case '3':
			$besoin = 843.86;
			$besoinnew = 993.88;
			break;
		case '4':
			$besoin = 562.57;
			$besoinnew = 662.95;
			break;
		default:
			break;
	}
	
	switch ($inter)
	{
		case 'presta':
			$tarif = 19.32;
			break;
		case 'manda':
			$tarif = 13.62;
			break;
		case 'gre':
			$tarif = 11.88;
			break;
		default:
			break;
	}	
	$revenusmens = $revenus/$quotientFamilial/12;
	$montant2015 = $heure*4.2*$tarif;
	$majorationTiercePersonne =  1103.08; // Valeur à changer toutes les années.	

	$seuil1 = 0.67*$majorationTiercePersonne;
	$seuil2 = 2.67*$majorationTiercePersonne;
	if($revenusmens < $seuil1)
		$participationUsager = 0;
	elseif($revenusmens > $seuil2)
		$participationUsager = 90;
	else
		$participationUsager = 90*(($revenusmens - $seuil1)/(2*$majorationTiercePersonne));
	
	$tauxparticipation = $participationUsager;	
	$montantparticipation = $montant2015 * $tauxparticipation / 100;
	$parfraction1 =  0.317;
	$parfraction2 =  0.498;
	$fraction1 = $majorationTiercePersonne * $parfraction1;
	$fraction2 = $majorationTiercePersonne * ( $parfraction2 - $parfraction1 );
	if ($montant2015 <= $fraction1) { $Afract1 = $montant2015; $Afract2 =0; $Afract3 =0;} 
	elseif ($montant2015 > $fraction1 AND $montant2015 < $fraction1+$fraction2) { $Afract1= $parfraction1 ;$Afract2 = $montant2015 - $Afract1;$Afract3 =0;} 
	else {$Afract1 = $fraction1;$Afract2 = $fraction2;$Afract3 = $montant2015 - $fraction1 - $fraction2;} 
	$fraction3 = $Afract3;

	$seuilnew1 = 0.725 * $majorationTiercePersonne;
	$seuilnew2 = 2.67 * $majorationTiercePersonne;
	if($revenusmens <= $seuilnew1)
		$participationUsagernew = 0;
	elseif($revenusmens > $seuilnew2)
		$participationUsagernew = 0.9 * $montant2015;
	else {
		$participationUsagernew = 0.9 * (
			$Afract1 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) 
			+ $Afract2 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) * ( ( ( ( 1 - 0.4 ) / ( $seuilnew2 - $seuilnew1 ) ) * $revenusmens ) + ( ( 0.4 * $seuilnew2 - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) ) )
			+ $Afract3 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) * ( ( ( ( 1 - 0.2 ) / ( $seuilnew2 - $seuilnew1 ) ) * $revenusmens ) + ( ( 0.2 * $seuilnew2 - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) ) )
		);
		$val1 = $Afract1 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) ;
		$val2 = $Afract2 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) * ( ( ( ( 1 - 0.4 ) / ( $seuilnew2 - $seuilnew1 ) ) * $revenusmens ) + ( ( 0.4 * $seuilnew2 - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) ) );
		$val3 = $Afract3 * ( $revenusmens - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) * ( ( ( ( 1 - 0.2 ) / ( $seuilnew2 - $seuilnew1 ) ) * $revenusmens ) + ( ( 0.2 * $seuilnew2 - $seuilnew1 ) / ( $seuilnew2 - $seuilnew1 ) ) );
	}
		
	
	$tauxparticipationnew = $participationUsagernew / $montant2015 * 100;	
	$montantparticipationnew = $participationUsagernew;
	$retour = "";
	/*
	$retour .= "
		Vos revenus : $revenus<br/>
		Vie en couple : $couple<br/>
		Niveau de dépendance : $gir<br/>
		Besoin en heure d'aide à domicile : $heure<br/>
		Mode d'intervention : $inter ($tarif)<br/>
		";
	*/
	$retour .="<b>Avant la loi</b><br/>
		Le montant mensuel de votre plan d'aide s'élevait à ".min(round($montant2015, 2),$besoin)." euros<br/>";
	if ($montant2015<$besoin) $retour .="Si vos besoins d'aide augmentaient, il pouvait s'élever jusqu'à : ".$besoin." euros<br/>";
	$retour .="Votre taux de participation était de ".round($tauxparticipation, 2)." %<br/>
		ce qui signifie que vous deviez payer <b>".round($montantparticipation, 2)."</b> euros<br/>
		";
	$retour .="
		<br/><b>Après la loi</b><br/>
		Le montant mensuel de votre plan d'aide s'élève aussi à ".min(round($montant2015, 2),$besoinnew)." euros<br/>";
	if ($montant2015<$besoinnew) $retour .="Si vos besoins d'aide augmentaient, il peut s'élever jusqu'à : ".$besoinnew." euros<br/>";
	$retour .="Votre taux de participation est maintenant de ".round($tauxparticipationnew, 2)." %<br/>
		ce qui signifie que vous ne devez payer plus que <b>".round($montantparticipationnew, 2)."</b> euros<br/>
		<br/><b><big>ce qui représente une économie annuelle de ".round(($montantparticipation-$montantparticipationnew)*12)." euros</b></big><br/>
		";
	/*
	$retour .="
		Vos revenus : $revenus<br/>
		Vie en couple : $couple<br/>
		Niveau de dépendance : $gir<br/>
		Besoin en heure d'aide à domicile : $heure<br/>
		Mode d'intervention : $inter ($tarif)<br/>
		<hr/>
		revenus mens: ".round($revenusmens,2)."<br/>
		Niveau de dépendance : $gir<br/>	
		Montant2015 (A): ".round($montant2015,2)."<br/>
		participationUsager : ".round($participationUsager,2)."%<br/>
		montantparticipation : ".round($montantparticipation,2)."<br/>
		participationCG : ".round($montant2015-$montantparticipation,2)."<br/>
		plafond GIR : ".round($besoin,2)."<br/>
		taux saturation : ".round(100*$montant2015/$besoin,2)."%<br/>
	
		<hr/>
		
		nouveau plafond GIR : ".round($besoinnew,2)."<br/>
		Nouveau montant: ".round($montant2015,2)."<br/>
		fraction1 : ".round($fraction1,2)."<br/>
		fraction2 : ".round($fraction2,2)."<br/>
		fraction3 : ".round($fraction3,2)."<br/>
		
		<hr/>
		
		Afract1 : ".$Afract1."<br/>
		Afract2 : ".$Afract2."<br/>
		Afract3 : ".$Afract3."<br/>
		
		<hr/>
		
		seuil1 : ".round($seuil1,2)."<br/>
		seuil2 : ".round($seuil2,2)."<br/>

		
		seuilnew1 : ".round($seuilnew1,2)."<br/>
		seuilnew2 : ".round($seuilnew2,2)."<br/>
		participationUsagernew : ".round($participationUsagernew,2)."<br/>
		tauxparticipationnew : ".round($tauxparticipationnew,2)."<br/>		
		montantparticipationnew : ".round($montantparticipationnew,2)."<br/>
				
		A1 : ".round($Afract1,2)."<br/>
		A2 : ".round($Afract2,2)."<br/>
		A3 : ".round($Afract3,2)."<br/>
		P : ".round($montantparticipationnew,2)."<br/>
		revenus mens: ".round($revenusmens,2)."<br/>
		seuil1 : ".round($seuil1,2)."<br/>
		seuil2 : ".round($seuil2,2)."<br/>
		seuilnew1 : ".round($seuilnew1,2)."<br/>
		seuilnew2 : ".round($seuilnew2,2)."<br/>		
		val1 : ".round($val1,2)."<br/>		
		val2 : ".round($val2,2)."<br/>		
		val3 : ".round($val3,2)."<br/>		
			
		";
	*/
	$retourtab = array (
		'message_ok'			=> array(
			'retour'	=> $retour,
			'couple' 			=> $couple,
			'gir' 				=> $gir,
			'heure' 			=> $heure,
			'inter' 			=> $inter,
			'revenus' 			=> $revenus,
			'tarif'				=> $tarif,
			'planaide'			=> round($montant2015,2),
			'besoin'			=> $besoin,
			'tauxparticipation'	=> round($tauxparticipation, 2),
			'montantparticipation'	=> round($montantparticipation, 2),
			'besoinnew'			=> $besoinnew,
			'tauxparticipationnew'	=> round($tauxparticipationnew, 2),
			'montantparticipationnew'	=> round($montantparticipationnew, 2),
			'economie'	=> round(($montantparticipation-$montantparticipationnew)*12),
			'editable' => true
		)
	); 
	return $retourtab;
}
?>