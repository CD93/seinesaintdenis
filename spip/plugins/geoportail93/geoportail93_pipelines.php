<?php
/**
 * Utilisations de pipelines par Geoportail93
 *
 * @plugin     Geoportail93
 * @copyright  2015
 * @author     damien
 * @licence    GNU/GPL
 * @package    SPIP\Geoportail93\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
	

/**
 * Insertion des css du plugin dans les pages publiques
 *
 * @param $flux
 * @return mixed
 */
function geoportail93_insert_head_css($flux) {
	$flux .= "\n".'<link rel="stylesheet" href="'. find_in_path('css/cartetrav.css') .'" />';
	//$flux .= "\n".'<link rel="stylesheet" href="'. find_in_path('lib/leaflet/plugins/leaflet-search/leaflet-search.src.css') .'" />';
	//$flux .= "\n".'<link rel="stylesheet" href="'. find_in_path('lib/leaflet/plugins/leaflet-search/leaflet-search.mobile.src.css') .'" />';
	$flux .= "\n".'<link rel="stylesheet" href="'. find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.css') .'" />';
	return $flux;
}

/**
 * Insertion des scripts et css du plugin dans les pages de l'espace privé
 * @param $flux
 * @return mixed
 */
function geoportail93_header_prive($flux) {
	$flux .= geoportail93_insert_head_css('');
	return $flux;
}

/**

 * Ajouter le script leaflet snogyloop au script gis.js appelé par les cartes
 *
 * @param $flux
 * @return mixed
 */
function geoportail93_recuperer_fond($flux) {
	if ($flux['args']['fond'] == 'javascript/gis.js') {
		if (!function_exists('lire_config')) {
			include_spip('inc/config');
		}
		if (lire_config('auto_compress_js') == 'oui' && function_exists('compacte')) {
			$ajouts = "\n". compacte(spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.FeatureGroup.SubGroup/subgroup.js')), 'js');
//			$ajouts .= "\n". compacte(spip_file_get_contents(find_in_path('lib/leaflet/plugins/leaflet-search/leaflet-search.src.js')), 'js');
			$ajouts .= "\n". compacte(spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.js')), 'js');
		} else {
			$ajouts = "\n". spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.FeatureGroup.SubGroup/subgroup.js'));
//			$ajouts .= "\n". spip_file_get_contents(find_in_path('lib/leaflet/plugins/leaflet-search/leaflet-search.src.js'));
			$ajouts .= "\n". spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.js'));			
		}
		$flux['data']['texte'] .= $ajouts;
	}
	return $flux;
}

function geoportail93_jqueryui_plugins($scripts){
   $scripts[] = "jquery.ui.slider";
   return $scripts;
}
?>