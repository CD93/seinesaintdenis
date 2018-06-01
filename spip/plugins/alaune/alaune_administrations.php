<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin gestion une
 *
 * @plugin     gestion une
 * @copyright  2013
 * @author     samuel et damien
 * @licence    GNU/GPL
 * @package    SPIP\Alaune\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'installation et de mise à jour du plugin gestion une.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function alaune_upgrade($nom_meta_base_version, $version_cible) {
	$maj = array();

	$maj['create'] = array(array('maj_tables', array('spip_unes')));

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin gestion une.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function alaune_vider_tables($nom_meta_base_version) {

	sql_drop_table("spip_unes");

	# Nettoyer les versionnages et forums
	sql_delete("spip_versions",              sql_in("objet", array('une')));
	sql_delete("spip_versions_fragments",    sql_in("objet", array('une')));
	sql_delete("spip_forum",                 sql_in("objet", array('une')));

	effacer_meta($nom_meta_base_version);
}

?>