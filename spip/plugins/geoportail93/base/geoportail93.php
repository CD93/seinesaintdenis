<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     Geoportail93
 * @copyright  2015
 * @author     damien
 * @licence    GNU/GPL
 * @package    SPIP\Geoportail93\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function geoportail93_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['geoportail93s'] = 'geoportail93s';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function geoportail93_declarer_tables_objets_sql($tables) {

	$tables['spip_geoportail93s'] = array(
		'type' => 'geoportail93',
		'principale' => "oui",
		'field'=> array(
			"id_geoportail93"    => "bigint(21) NOT NULL",
			"id_couche_geoportail" => "bigint(21) NOT NULL DEFAULT 0",
			"id_element_couche_geoportail" => "bigint(21) NOT NULL DEFAULT 0",
			"date"               => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'", 
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_geoportail93",
		),
		'titre' => "id_element_couche_geoportail AS titre, '' AS lang",
		'date' => "date",
		'champs_editables'  => array('id_couche_geoportail', 'id_element_couche_geoportail'),
		'champs_versionnes' => array('id_couche_geoportail', 'id_element_couche_geoportail'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array('spip_geoportail93s_liens'),
		

	);

	return $tables;
}


/**
 * Déclaration des tables secondaires (liaisons)
 *
 * @pipeline declarer_tables_auxiliaires
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function geoportail93_declarer_tables_auxiliaires($tables) {

	$tables['spip_geoportail93s_liens'] = array(
		'field' => array(
			"id_geoportail93"    => "bigint(21) DEFAULT '0' NOT NULL",
			"id_objet"           => "bigint(21) DEFAULT '0' NOT NULL",
			"objet"              => "VARCHAR(25) DEFAULT '' NOT NULL",
			"vu"                 => "VARCHAR(6) DEFAULT 'non' NOT NULL"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_geoportail93,id_objet,objet",
			"KEY id_geoportail93" => "id_geoportail93"
		)
	);

	return $tables;
}


?>