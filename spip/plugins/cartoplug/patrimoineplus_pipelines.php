<?php
/**
 * Utilisations de pipelines par Patrimoineplus
 *
 * @plugin     Patrimoineplus
 * @copyright  2015
 * @author     damien
 * @licence    GNU/GPL
 * @package    SPIP\Patrimoineplus\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

function cartoplug_insert_head_css($flux){
	$flux .= "\n".'<link rel="stylesheet" href="'. find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.css') .'" />';
	return $flux;
}
/**

 * Ajouter le script leaflet snogyloop au script gis.js appelé par les cartes
 *
 * @param $flux
 * @return mixed
 */
function cartoplug_recuperer_fond($flux) {
	if ($flux['args']['fond'] == 'javascript/gis.js') {
		if (!function_exists('lire_config')) {
			include_spip('inc/config');
		}
		if (lire_config('auto_compress_js') == 'oui' && function_exists('compacte')) {
			$ajouts = "\n". compacte(spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.FeatureGroup.SubGroup/subgroup.js')), 'js');
			$ajouts .= "\n". compacte(spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.js')), 'js');
		} else {
			$ajouts = "\n". spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.FeatureGroup.SubGroup/subgroup.js'));
			$ajouts .= "\n". spip_file_get_contents(find_in_path('lib/leaflet/plugins/Leaflet.defaultextent/leaflet.defaultextent.js'));
		}
		$flux['data']['texte'] .= $ajouts;
	}
	return $flux;
}

?>
