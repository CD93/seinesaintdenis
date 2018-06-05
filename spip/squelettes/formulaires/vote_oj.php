<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/session');

function formulaires_vote_oj_charger_dist($id_projet)
{
	$valeurs = array(
		'id_projet' => $id_projet
	);
	return $valeurs;
}
function formulaires_vote_oj_verifier_dist($id_projet)
{
}

function formulaires_vote_oj_traiter_dist($id_projet)
{
	$nbr_vote = (sql_getfetsel("nbr_vote", "spip_oj", "id_projet=" . intval($id_projet))) +1;
	sql_updateq('spip_oj', array('nbr_vote' => $nbr_vote ), 'id_projet=' . intval($id_projet));
	return array(
        "editable" => true,
        "message_ok" => " ",
    );
}
?>
