<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');


function formulaires_quiz_libre_charger_dist($id_document)
{
	$valeurs = array
	(
		'reponse' 	=> '',
		'editform' => 'oui',
		'debut_artquiz' => _request('debut_artquiz'),
		'id_article' => $id_document
	);
	return $valeurs;
}

function formulaires_quiz_libre_verifier_dist($id_document)
{
}

function formulaires_quiz_libre_traiter_dist($id_document)
{
	$reponse = _request('reponse');
    $row = sql_fetsel("fichier", "spip_documents", "id_document=$id_document");
    $handle = fopen("IMG/".$row['fichier'], "r");
    $gagner="0";
    $reponse = strtr($reponse,
    "ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜàâãäåçèéêëìíîïòóôõöùúûüÿ",
    "aaaaaaceeeeiiiiooooouuuuaaaaaceeeeiiiioooooouuuy");
	while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
    	foreach( $cols as $key => $val ) {
    		if (strtolower($val)==strtolower($reponse)) $gagner="1";
    		$tableau[] = $val;
    	}
    }
    $GLOBALS['visiteur_session']["quiz".$id_document] = $gagner;
    ajouter_session($GLOBALS['visiteur_session']);
    return array(
		"editform" => false,
		"message_ok" => ""
	);
}
?>