<?php
function formulaires_ashfv_charger_dist()
{
	$valeurs = array
	(
		'travailleur'     => '',
		'reside93'        => '',
		'heberge'         => '',
		'jour'            => '',
		'allocation'      => '',
		'retraites'       => '',
		'revenusic'       => '',
		'viageres'        => '',
		'revenuscm'       => '',
		'revenusf'        => '',
		'mutuelle'        => '',
		'tutelle'         => '',
		'impot'           => '',
		'fonciere'        => '',
		'habitation'      => '',
		'apl'             => '',
		'charge'          => '',
		'conjoint'        => ''
	);
	return $valeurs;
}

function formulaires_ashfv_verifier_dist()
{
	$erreurs = array();
	
	foreach(array('travailleur', 'reside93', 'heberge') as $valeur) {
		if (!_request($valeur)) {
			$erreurs[$valeur] = 'Ce champ est obligatoire';
        }
    }
	
	if(_request('jour')) {
		if(is_numeric(_request('jour'))) {
			if(_request('jour') <= 0) {
				$erreurs['jour'] = 'Vous devez entrer une valeur positive';
			}
		} else {
			$erreurs['jour'] = 'Vous devez entrer une valeur numérique';
		}
	} else {
		$erreurs['jour'] = 'Ce champ est obligatoire';
	}
	
	if(_request('allocation')) {
		if(is_numeric(_request('allocation'))) {
			if(_request('allocation') <= 0) {
				$erreurs['allocation'] = 'Vous devez entrer une valeur positive';
			}
		} else {
			$erreurs['allocation'] = 'Vous devez entrer une valeur numérique';
		}
	} else {
		$erreurs['allocation'] = 'Ce champ est obligatoire';
	}

	foreach(array('retraites', 'revenusic', 'viageres', 'revenuscm', 'revenusf') as $valeur) {
		if(!is_numeric(_request($valeur)) && _request($valeur) != '' && _request($valeur)) {
			$erreurs[$valeur] = 'Vous devez entrer une valeur numérique';
        } else if(_request($valeur) < 0) {
			$erreurs[$valeur] = 'Vous devez entrer une valeur positive ou égale à zéro';
        }
    }

	if (count($erreurs)) {
        $erreurs['message_erreur'] = '';
    }
		
	return $erreurs;
}

function formulaires_ashfv_traiter_dist()
{
    $pj = _request('jour');
    $b1 = _request('allocation');
    $b2 = _request('retraites');
    $b3 = _request('revenusic');
    $b4 = _request('viageres');
    $b5 = _request('revenuscm');
    $b6 = _request('revenusf');
    $c  = _request('mutuelle');
    $d1 = _request('tutelle');
    $d2 = _request('impot');
    $d3 = _request('fonciere');
    $d4 = _request('habitation');
    $e  = _request('apl');
    $f  = _request('charge');
    $g  = _request('conjoint');

	$aah = 790.18; // Valeur a changer toutes les années.

    $b = $b1 + (($b2 + $b3 + $b4 + $b5 + $b6) / 12);

    $x = $b * 0.1;
    
    if (!$f && !$g) {
        if ($x <= ($aah * 0.3)) {
            $x = $aah * 0.3;
        }
    } else if (!$g && $f) {
        if ($x <= ($aah * 0.6)) { 
            $x = $aah * 0.6;
        }
    } else if ($g && !$f) {
        if ($x <= ($aah * 0.65)) { 
            $x = $aah * 0.65;
        }
    } else if ($g && $f) {
        if ($x <= ($aah * 0.95)) { 
            $x = $aah * 0.95;
        }
    }

    $y = $c + (($d1 + $d2 + $d3 + $d4) / 12);

    if (($x + $y) < $b) {
        $z = $b - $x - $y + $e;
    } else {  
        $z = $e;
    }

    $cms = $pj * 30.5;

    if ($z > $cms) {
        $emp = $cms;
    } else {
        $emp = $z;
    }

    $retour =   '<h3>Estimation l\'A.S.H. en foyer de vie ou FAM</h3><br /><br />'.
                'Le montant mensuel moyen de vos ressoureces s\'élève à <strong>'.number_format($b, 2, ',', ' ').' &euro;</strong> par mois<br />'.
                'Le coût mensuel de votres séjour s\'élève à <strong>'.number_format(($cms), 2, ',', ' ').'  &euro;</strong> par mois<br />'.
                'L\'estimation moyenne de votre participation mensuelle s\'élève à <strong>'.number_format(($emp), 2, ',', ' ').'  &euro;</strong> par mois<br />'.
                'Le montant moyen de l\'ASH versée par mois par le Département s\'élève à <strong>'.(($cms - $z) > 0 ? number_format(($cms - $z), 2, ',', ' ') : 0).'  &euro;</strong> par mois<br /><br />'.
                'Ceci est <strong>une estimation</strong> qui ne peut être opposée au Département de la Seine-Saint-Denis. Seule la décision de prise en charge à l\'aide sociale à l\'hébergement du Président du Conseil Départemental engage le Département.';
    return $retour;
}
?>