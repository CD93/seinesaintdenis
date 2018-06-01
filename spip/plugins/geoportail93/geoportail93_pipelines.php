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
 * Ajout de contenu sur certaines pages,
 * notamment des formulaires de liaisons entre objets
 *
 * @pipeline affiche_milieu
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function geoportail93_affiche_milieu($flux) {
	$texte = "";
	$e = trouver_objet_exec($flux['args']['exec']);



	// geoportail93s sur les articles
	if (!$e['edition'] AND in_array($e['type'], array('article'))) {
		$texte .= recuperer_fond('prive/objets/editer/liens', array(
			'table_source' => 'geoportail93s',
			'objet' => $e['type'],
			'id_objet' => $flux['args'][$e['id_table_objet']]
		));
	}

	if ($texte) {
		if ($p=strpos($flux['data'],"<!--affiche_milieu-->"))
			$flux['data'] = substr_replace($flux['data'],$texte,$p,0);
		else
			$flux['data'] .= $texte;
	}

	return $flux;
}



/**
 * Optimiser la base de données en supprimant les liens orphelins
 * de l'objet vers quelqu'un et de quelqu'un vers l'objet.
 *
 * @pipeline optimiser_base_disparus
 * @param  array $flux Données du pipeline
 * @return array       Données du pipeline
 */
function geoportail93_optimiser_base_disparus($flux){
	include_spip('action/editer_liens');
	$flux['data'] += objet_optimiser_liens(array('geoportail93'=>'*'),'*');
	return $flux;
}

function geoportail93_jqueryui_plugins($scripts){
   $scripts[] = "jquery.ui.slider";
   return $scripts;
}
?>