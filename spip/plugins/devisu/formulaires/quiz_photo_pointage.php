<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');


function formulaires_quiz_photo_pointage_charger_dist($id_document,$id_image)
{
	$valeurs = array
	(
		'editform' => 'oui',
		'id_document' => $id_document,
		'id_image' => $id_image,
		'position_x_public_'.$id_image => '',
		'debut_artquiz' => _request('debut_artquiz'),
		'position_y_public_'.$id_image => '',
		'taille_x_img_'.$id_image => '',
		'taille_y_img_'.$id_image => ''
		
	);
	return $valeurs;
}

function formulaires_quiz_photo_pointage_verifier_dist($id_document,$id_image)
{
}

function formulaires_quiz_photo_pointage_traiter_dist($id_document,$id_image)
{
	$position_x_public = _request('position_x_public_'.$id_image);
	$position_y_public = _request('position_y_public_'.$id_image);
	$taille_x_img = _request('taille_x_img_'.$id_image);
	$taille_y_img = _request('taille_y_img_'.$id_image);
	$rowimg = sql_fetsel("fichier", "spip_documents", "id_document=$id_image");
	$img_size = getimagesize("IMG/".$rowimg['fichier']);
    $row = sql_fetsel("fichier", "spip_documents", "id_document=$id_document");
    $handle = fopen("IMG/".$row['fichier'], "r");
    $gagner = "0";
    while (($cols = fgetcsv($handle, 4096, ";")) !== FALSE) {
    	$position_x=$cols[0];
    	$position_y=$cols[1];
    	$delta_x=$cols[2];
    	$delta_y=$cols[3];
    }
    $position_x_public_corrige = $position_x_public*$img_size[0]/$taille_x_img;
    $position_y_public_corrige = $position_y_public*$img_size[1]/$taille_y_img;
    if ($position_x-$delta_x<=$position_x_public_corrige AND $position_x+$delta_x>=$position_x_public_corrige AND $position_y-$delta_y<=$position_y_public_corrige AND $position_y+$delta_y>=$position_y_public_corrige) $gagner = "1";
    $GLOBALS['visiteur_session']["quiz".$id_document] = $gagner;
    ajouter_session($GLOBALS['visiteur_session']);
    return array(
		"editform" => false,
		"message_ok" => ""
	);
}
?>