<?php
/**
 * Fonctions utiles au plugin mosaique
 *
 * @plugin     mosaique
 * @copyright  2015
 * @author     samuel
 * @licence    GNU/GPL
 * @package    SPIP\Mosaic\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

function balise_CREER_DANS_BD($p){
	$var = interprete_argument_balise(1,$p);
    $p->code = "calculer_balise_CREER_DANS_BD($var)";
	$p->interdire_scripts = false;
	return $p;
}

function calculer_balise_CREER_DANS_BD($id_document) {
	$fp = fopen ("donnees.txt", "a+");
	// Définition du chemin à explorer (adaptez a votre environnement)
	$homedir = dirname($_SERVER["DOCUMENT_ROOT"])."/mosaic";
	// "ouverture" du répertoire
	$dir = @opendir($homedir);
	// Récupération d'un pointeur sur le premier
	// fichier (ou sous-répertoire) du répertoire grâce à readdir.
	// Lorsque nous aurons atteint la fin de répertoire
	// readdir retournera faux par conséquent
	// la boucle s'arrêtera
	while ($file = readdir($dir)) {
	    // Affichage du nom du fichier (ou sous-répertoire)
	    // sauf "." et ".."
	    if (($file != ".") && ($file != "..") && (substr($file,-4) == ".jpg")) {
			$timestamp = substr($file,0,10);
	    	$maj = date("Y-m-d h:i:s",$timestamp);
			$sel = sql_select('id_mosaic','spip_mosaics',array('fichier="'.$file.'"'));
			echo $file." : ".sql_count($sel)." : ".$maj."<br/>";
			if (!sql_count($sel)) {
				sql_insertq(
					'spip_mosaics',
					array(
						'fichier' => $file,
						'statut' => "poubelle",
						'maj' => $maj
					)
				);
			}
	    }
	}
	// C'est fini. On ferme !
	closedir($dir);
	// Instruction 2
	$contenu_du_fichier = fgets ($fp, 255);
	// Instruction 3
	fclose ($fp);
	// Instruction 4
	echo 'Notre fichier contient : '.$contenu_du_fichier;	
}


?>