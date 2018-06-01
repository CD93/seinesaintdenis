<?php
/*
 * Carte de voeux 2016
 * (c) 2006-2010 Fil
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/filtres');
include_spip('base/abstract_sql');

/**
 * Charger les valeurs du formulaire recommander
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_carte_voeux_2017_charger_dist($acteur){
	$valeurs = array(
		'email'=> isset($GLOBALS['visiteur_session']['email']) ? $GLOBALS['visiteur_session']['email'] :'',
		'imageLoader'=> '',
		'imageCanevas'=> '',
		'imagePhoto'=> '',
		'base64'=> '',
		'interne' =>'',
		'autho'=>'',
		'x1'=> '',
		'x2'=> '',
		'y1'=> '',
		'y2'=> '',
		'w'=> '',
		'h'=> ''		
	);
	return $valeurs;
}

/**
 * Verifier les valeurs du formulaire recommander
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function formulaires_carte_voeux_2017_verifier_dist($acteur){
	$erreurs = array();
	foreach(array('autho') as $obli) {
			if (!_request($obli))
			$erreurs[$obli] = (isset($erreurs[$obli])?$erreurs[$obli]:'') . "Vous devez accepter les conditions d'utilisation pour participer à la mosa&iuml;que";
				
	}
	return $erreurs;
}


/**
 * Envoyer le mail
 * @param string $titre
 * @param string $url
 * @param string $texte
 * @param string $subject
 * @return array
 */
function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
        break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
        break;
        case 3 :
            $im = imageCreateFromPng($filepath);
        break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
        break;
    }   
    return $im; 
} 
function formulaires_carte_voeux_2017_traiter_dist($acteur){
	$random_key = strtotime(date('Y-m-d H:i:s')).rand(100,999); 
	$email = _request('email');
	$base64 = _request('base64');
	$interne = isset($acteur) ? $acteur : 'n';
	$chemin = $random_key.".jpg";
	$x1 = _request('x1');
	$x2 = _request('x2');
	$y1 = _request('y1');
	$y2 = _request('y2');
	$w = _request('w');
	$h = _request('h');
	
	$jpeg_quality = 90;
	//$src = base64_decode($base64);
	//$img_r = imagecreatefromjpeg($base64);
	$img_r = imageCreateFromAny($base64);
	$dst_r = ImageCreateTrueColor( 500, 500 );
	imagecopyresampled($dst_r,$img_r,0,0,$x1,$y1,500,500,$w,$h);
	header('Content-type: image/jpeg');
	imagejpeg($dst_r,"mosaic/".$chemin,$jpeg_quality);
	imagedestroy($dst_r);
	if (lire_config('mosaic/apriori')=='oui') {
		$publication = 'encours';
	} else {
		$publication = 'publie';
	}
	if($img_r){
	sql_insertq('spip_mosaics', array(
			'fichier' => $chemin, 
			'interne' => $interne,
			'mail' => $email,
			'statut' => $publication
			));
	}
	$int = 60000;
	setcookie("chemin",$chemin,time()+$int);
	$rdir ='/?page=mosaic';
	if($acteur=='o'){
		$rdir .="&acteur=o";
		}
	return array(
		'redirect' => $rdir
	);
}

?>