<?php
/**
 * Fichier gérant l'installation et désinstallation du plugin travaux
 *
 * @plugin     travaux
 * @copyright  2016
 * @author     samuel
 * @licence    GNU/GPL
 * @package    SPIP\Travaux\Installation
 */

if (!defined('_ECRIRE_INC_VERSION')) return;


/**
 * Fonction d'installation et de mise à jour du plugin travaux.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @param string $version_cible
 *     Version du schéma de données dans ce plugin (déclaré dans paquet.xml)
 * @return void
**/
function travaux_upgrade($nom_meta_base_version, $version_cible) {
	$maj = array();

	include_spip('base/upgrade');
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}


/**
 * Fonction de désinstallation du plugin travaux.
 *
 * @param string $nom_meta_base_version
 *     Nom de la meta informant de la version du schéma de données du plugin installé dans SPIP
 * @return void
**/
function travaux_vider_tables($nom_meta_base_version) {


	effacer_meta($nom_meta_base_version);
}

?>