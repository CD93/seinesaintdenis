<?php
/**
 * Gestion du formulaire de suppression de mosaic
 *
 * @plugin     mosaique
 * @copyright  2015
 * @author     samuel
 * @licence    GNU/GPL
 * @package    SPIP\Mosaic\Formulaires
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('base/abstract_sql');


/**
 * Chargement du formulaire d'édition de mosaic
 *
 * Déclarer les champs postés et y intégrer les valeurs par défaut
 *
 * @param int|string $id_mosaic
 *     Identifiant du mosaic. 'new' pour un nouveau mosaic.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un mosaic source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du mosaic, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Environnement du formulaire
 */
function formulaires_valider_mosaic_charger_dist($id_mosaic){
	$valeurs = array(
		'id_mosaic' => $id_mosaic
	);
	return $valeurs;
}

/**
 * Vérifications du formulaire d'édition de mosaic
 *
 * Vérifier les champs postés et signaler d'éventuelles erreurs
 *
 * @param int|string $id_mosaic
 *     Identifiant du mosaic. 'new' pour un nouveau mosaic.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un mosaic source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du mosaic, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Tableau des erreurs
 */
function formulaires_valider_mosaic_verifier_dist($id_mosaic){
	$erreurs = array(
	);
	return $erreurs;
}

/**
 * Traitement du formulaire d'édition de mosaic
 *
 * Traiter les champs postés
 *
 * @param int|string $id_mosaic
 *     Identifiant du mosaic. 'new' pour un nouveau mosaic.
 * @param string $retour
 *     URL de redirection après le traitement
 * @param int $lier_trad
 *     Identifiant éventuel d'un mosaic source d'une traduction
 * @param string $config_fonc
 *     Nom de la fonction ajoutant des configurations particulières au formulaire
 * @param array $row
 *     Valeurs de la ligne SQL du mosaic, si connu
 * @param string $hidden
 *     Contenu HTML ajouté en même temps que les champs cachés du formulaire.
 * @return array
 *     Retours des traitements
 */
function formulaires_valider_mosaic_traiter_dist($id_mosaic){
	$statut= "publie";
	sql_updateq('spip_mosaics', array('statut' => $statut),'id_mosaic='.intval($id_mosaic));

	//sql_updateq('spip_mosaics', array('statut' => $statut),"id_mosaic=$id");
	//if($id_mosaic){
	/*
	sql_delete('spip_mosaics', array(
		
		'id_mosaic' => $id_mosaic, 
		));
	}
	*/
	//sql_updateq($spip_table_objet, $champs, "$id_table_objet=$id", $serveur);
	//sql_updateq('table', array('colonne' => $valeur), 'id_table=' . intval($id_table));
	return array(
		'message_ok' => 'image '.$id_mosaic.' avec statut : '.$statut
	);
}


?>