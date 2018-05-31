<?php
function formulaires_ashfhth_charger_dist()
{
	$valeurs = array
	(
		'travailleur'     => '',
		'reside93'        => '',
		'heberge'         => '',
		'jour'            => '',
		'salaires'        => '',
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

function formulaires_ashfhth_verifier_dist()
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

	if(_request('salaires')) {
		if(is_numeric(_request('salaires'))) {
			if(_request('salaires') <= 0) {
				$erreurs['salaires'] = 'Vous devez entrer une valeur positive';
			}
		} else {
			$erreurs['salaires'] = 'Vous devez entrer une valeur numérique';
		}
	} else {
		$erreurs['salaires'] = 'Ce champ est obligatoire';
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

function formulaires_ashfhth_traiter_dist()
{
    $pj = _request('jour');
    $a  = _request('salaires');
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

    $x = ($a / 3) + ($b * 0.1);

    if (!$f && !$g) {
        if ($x <= ($aah * 0.7)) {
            $x = $aah * 0.7;
			$toto = $x;
        }
    } else if (!$g && $f) {
        if ($x <= $aah) { 
            $x = $aah;
        }
    } else if ($g && !$f) {
        if ($x <= ($aah * 1.05)) { 
            $x = $aah * 1.05;
        }
    } else if ($g && $f) {
        if ($x <= ($aah * 1.35)) { 
            $x = $aah * 1.35;
        }
    }

    $y = $c + (($d1 + $d2 + $d3 + $d4) / 12);

    if (($x + $y) < ($a + $b)) {
        $z = $a + $b - $x - $y + $e;
    } else {  
        $z = $e;
    }

    $cms = $pj * 30.5;

    if ($z > $cms) {
        $emp = $cms;
    } else {
        $emp = $z;
    }

    $retour =   '<h3>Estimation l\'A.S.H. en foyer d’hebergement pour travailleurs handicapés</h3><br /><br />'.
                'Le montant mensuel moyen de vos ressoureces s\'élève à <strong>'.number_format(($a + $b), 2, ',', ' ').' &euro;</strong> par mois<br />'.
                'Le coût mensuel de votres séjour s\'élève à <strong>'.number_format(($cms), 2, ',', ' ').'  &euro;</strong> par mois<br />'.
                'L\'estimation moyenne de votre participation mensuelle s\'élève à <strong>'.number_format(($emp), 2, ',', ' ').'  &euro;</strong> par mois<br />'.
                'Le montant moyen de l\'ASH versée par mois par le Département s\'élève à <strong>'.(($cms - $z) > 0 ? number_format(($cms - $z), 2, ',', ' ') : 0).'  &euro;</strong> par mois<br /><br />'.
                'Ceci est <strong>une estimation</strong> qui ne peut être opposée au Département de la Seine-Saint-Denis. Seule la décision de prise en charge à l\'aide sociale à l\'hébergement du Président du Départemental engage le Département.';
    return $retour;
}
?>