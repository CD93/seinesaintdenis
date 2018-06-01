<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     mosaique
 * @copyright  2015
 * @author     samuel
 * @licence    GNU/GPL
 * @package    SPIP\Mosaic\Pipelines
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
function mosaic_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['mosaics'] = 'mosaics';

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
function mosaic_declarer_tables_objets_sql($tables) {

	$tables['spip_mosaics'] = array(
		'type' => 'mosaic',
		'principale' => "oui",
		'field'=> array(
			"id_mosaic"          => "bigint(21) NOT NULL",
			"mail"               => "varchar(255) NOT NULL DEFAULT ''",
			"fichier"            => "varchar(255) NOT NULL DEFAULT ''",
			"interne"            => "varchar(1) NOT NULL DEFAULT ''",
			"date"               => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'", 
			"statut"             => "varchar(20)  DEFAULT '0' NOT NULL", 
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_mosaic",
		),
		'titre' => "'' AS titre, '' AS lang",
		'date' => "date",
		'champs_editables'  => array('mail', 'fichier', 'interne','statut'),
		'champs_versionnes' => array('fichier'),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),
		'statut_textes_instituer' => array(
			'prepa'    => 'texte_statut_en_cours_redaction',
			'prop'     => 'texte_statut_propose_evaluation',
			'publie'   => 'texte_statut_publie',
			'refuse'   => 'texte_statut_refuse',
			'poubelle' => 'texte_statut_poubelle',
		),
		'statut'=> array(
			array(
				'champ'     => 'statut',
				'publie'    => 'publie',
				'previsu'   => 'publie,prop,prepa',
				'post_date' => 'date', 
				'exception' => array('statut','tout')
			)
		),
		'texte_changer_statut' => 'mosaic:texte_changer_statut_mosaic', 
		

	);

	return $tables;
}



?>