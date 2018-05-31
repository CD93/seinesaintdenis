<?php
/**
 * Utilisations de pipelines par evenementiel
 *
 * @plugin     evenementiel
 * @copyright  2015
 * @author     damien
 * @licence    GNU/GPL
 * @package    SPIP\Eve\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
	
function eve_insert_head_css($flux) {
	$flux .= "<link rel='stylesheet' type='text/css' media='all' href='".generer_url_public('eve.css')."' />\n";
	return $flux;
}

?>