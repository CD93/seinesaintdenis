<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('base/abstract_sql');

function formulaires_creches_charger_dist()
{
	$valeurs = array
	(
		'ville' 			=> ''
			
	);
	return $valeurs;
}

function formulaires_creches_verifier_dist(){}

function formulaires_creches_traiter_dist()
{
	$ville = _request('ville');
	
	$tab_reponse = sql_allfetsel('*', 'spip_articles', "titre LIKE '%".$ville."' AND  id_rubrique=138");
	return array("message_ok" => $tab_reponse);
}
?>