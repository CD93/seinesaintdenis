<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');


function formulaires_quiz_choix_multiple_charger_dist($id_document)
{
	$valeurs = array
	(
		'editform' => 'oui',
		'id_document' => $id_document,
		'debut_artquiz' => _request('debut_artquiz'),
		'checkboxCsv' => ''
	);
	return $valeurs;
}

function formulaires_quiz_choix_multiple_verifier_dist($id_document)
{
}

function formulaires_quiz_choix_multiple_traiter_dist($id_document)
{
	$reponse=0;
	if (is_array(_request('checkboxCsv'))) $reponse = array_sum(_request('checkboxCsv'));
    $row = sql_fetsel("fichier", "spip_documents", "id_document=$id_document");
    $handle = fopen("IMG/".$row['fichier'], "r");
    $goodscore = 0;
    $gagner = "0";
    while (($cols = fgetcsv($handle, 4096, ";")) !== FALSE) {
    	$goodscore+=$cols[2]*pow(2,$cols[0]);
    }
    if ($goodscore==$reponse) $gagner = "1";
    $GLOBALS['visiteur_session']["quiz".$id_document] = $gagner;
    ajouter_session($GLOBALS['visiteur_session']);
    return array(
		"editform" => false,
		"message_ok" => ""
	);
}
?>