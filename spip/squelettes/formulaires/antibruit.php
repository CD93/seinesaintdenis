<?php
function formulaires_antibruit_charger_dist()
{
	$valeurs = array
	(
		'type' 				=> 'appart',
		'cas' 				=> '1',
		'piece' 			=> '1',
		'cuisine' 			=> '1',
		'devis' 			=> '0'
	);
	return $valeurs;
}

function formulaires_antibruit_verifier_dist()
{
}

function formulaires_antibruit_traiter_dist()
{
	$retour = array('editable' => true);
	switch (_request('type'))
	{
		case 'appart':
			if (_request('cas')==1) {$seuil=1829;} elseif (_request('cas')==2) {$seuil=1982;}
			break;
		case 'maison':
			if (_request('cas')==1) {$seuil=3201;} elseif (_request('cas')==2) {$seuil=3506;}
			break;
	}
	if (_request('cas')==1) {$seuilc=1372;} elseif (_request('cas')==2) {$seuilc=1829;}
	$submax= _request('piece')*$seuil + _request('cuisine')*$seuilc ;
		$devisttc = _request('devis');
		if ($devisttc > $submax) {$sub=$submax;}else{$sub=$devisttc;}
	$subfinal = 0.9*$sub;
	$retour ="Estimation du montant de la subvention : ".round($subfinal)." euros"; 
	return $retour;
}
?>