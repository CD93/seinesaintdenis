<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');


function formulaires_quiz_choix_simple_charger_dist($id_document)
{
	$valeurs = array
	(
		'reponse' 	=> '',
		'editform' => 'oui',
		'id_document' => $id_document,
		'debut_artquiz' => _request('debut_artquiz'),
		'optionsRadios' => ''
	);
	return $valeurs;
}

function formulaires_quiz_choix_simple_verifier_dist($id_document)
{
}

function formulaires_quiz_choix_simple_traiter_dist($id_document)
{
	$reponse = _request('optionsRadios');
    $row = sql_fetsel("fichier", "spip_documents", "id_document=$id_document");
    $handle = fopen("IMG/".$row['fichier'], "r");
    $gagner="0";
	while (($cols = fgetcsv($handle, 1000, ";")) !== FALSE) {
    	if ($cols[0]==$reponse) $gagner=$cols[2];
    }
    $GLOBALS['visiteur_session']["quiz".$id_document] = $gagner;
    ajouter_session($GLOBALS['visiteur_session']);
    return array(
		"editform" => false,
		"message_ok" => ""
	);
}
?>