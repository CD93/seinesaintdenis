<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     gestion une
 * @copyright  2013
 * @author     samuel et damien
 * @licence    GNU/GPL
 * @package    SPIP\Alaune\Pipelines
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
function alaune_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['unes'] = 'unes';

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
function alaune_declarer_tables_objets_sql($tables) {

	$tables['spip_unes'] = array(
		'type' => 'une',
		'principale' => "oui",
		'field'=> array(
			"id_une"             => "bigint(21) NOT NULL",
			"id_dossier"         => "bigint(21) NOT NULL DEFAULT 0",
			"titres"             => "mediumtext NOT NULL DEFAULT ''",
			"date"               => "datetime NOT NULL DEFAULT '0000-00-00 00:00:00'", 
			"statut"             => "varchar(20)  DEFAULT '0' NOT NULL", 
			"maj"                => "TIMESTAMP"
		),
		'key' => array(
			"PRIMARY KEY"        => "id_une",
			"KEY statut"         => "statut", 
		),
		'titre' => "titres AS titre, '' AS lang",
		'date' => "date",
		'champs_editables'  => array('id_dossier', 'titres'),
		'champs_versionnes' => array('id_dossier', 'titres'),
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
		'texte_changer_statut' => 'une:texte_changer_statut_une', 
		

	);

	return $tables;
}



?>