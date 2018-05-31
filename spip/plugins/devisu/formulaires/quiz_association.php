<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/actions');
include_spip('inc/editer');
include_spip('inc/session');


function formulaires_quiz_association_charger_dist($id_document,$type_assoc)
{
	$valeurs = array
	(
		'editform' => 'oui',
		'totalAssoc' => '20',
		'type_assoc' => $type_assoc,
		'debut_artquiz' => _request('debut_artquiz'),
		'id_document' => $id_document
	);
	$totalAssoc = 20;
	for ($i=1;$i<=$totalAssoc;$i++) {
		$valeurs["g".$i] = ${"g".$i};
		$valeurs["d".$i] = ${"d".$i};
	} 
	return $valeurs;
}

function formulaires_quiz_association_verifier_dist($id_document,$type_assoc)
{
}

function formulaires_quiz_association_traiter_dist($id_document,$type_assoc)
{
	$type_assoc = _request('type_assoc');
	$totalAssoc = _request('totalAssoc');
	for ($i=1;$i<=$totalAssoc;$i++) {
		${"g".$i} = _request('g'.$i);
		${"d".$i} = _request('d'.$i);
	} 
    $row = sql_fetsel("fichier", "spip_documents", "id_document=$id_document");
    $handle = fopen("IMG/".$row['fichier'], "r");
    //$goodscore = 0;
    $gagner = "0";
    $j=0;
    while (($cols = fgetcsv($handle, 4096, ";")) !== FALSE) {
    	$goodscore[$j]=0;
    	if ($cols[1]==${"d".$j}) $goodscore[$j]=1;
    	$j++;
    }
    fclose($handle);
    if (array_sum($goodscore)==$totalAssoc) $gagner = "1";
    $GLOBALS['visiteur_session']["quiz".$id_document] = $gagner;
    ajouter_session($GLOBALS['visiteur_session']);
    return array(
		"editform" => false,
		"message_ok" => ""
	);
}
?>