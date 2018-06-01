<?php

/**
 *  Fichier généré par la Fabrique de plugin v5
 *   le 2015-10-30 17:20:16
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

$data = array (
  'fabrique' => 
  array (
    'version' => 5,
  ),
  'paquet' => 
  array (
    'nom' => 'Geoportail93',
    'slogan' => '',
    'description' => '',
    'prefixe' => 'geoportail93',
    'version' => '1.0.0',
    'auteur' => 'damien',
    'auteur_lien' => '',
    'licence' => 'GNU/GPL',
    'categorie' => 'divers',
    'etat' => 'dev',
    'compatibilite' => '[3.0.19;3.0.*]',
    'documentation' => '',
    'administrations' => '',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => '',
  ),
  'objets' => 
  array (
    0 => 
    array (
      'nom' => 'Geoportail93s',
      'nom_singulier' => 'Geoportail93',
      'genre' => 'masculin',
      'logo_variantes' => '',
      'table' => 'spip_geoportail93s',
      'cle_primaire' => 'id_geoportail93',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'geoportail93',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'id_couche_geoportail',
          'champ' => 'id_couche_geoportail',
          'sql' => 'bigint(21) NOT NULL DEFAULT 0',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'élément couche geoportail',
          'champ' => 'id_element_couche_geoportail',
          'sql' => 'bigint(21) NOT NULL DEFAULT 0',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => 'id_element_couche_geoportail',
      'champ_date' => 'date',
      'statut' => '',
      'chaines' => 
      array (
        'titre_objets' => 'Geoportail93s',
        'titre_objet' => 'Geoportail93',
        'info_aucun_objet' => 'Aucun geoportail93',
        'info_1_objet' => 'Un geoportail93',
        'info_nb_objets' => '@nb@ geoportail93s',
        'icone_creer_objet' => 'Créer un geoportail93',
        'icone_modifier_objet' => 'Modifier ce geoportail93',
        'titre_logo_objet' => 'Logo de ce geoportail93',
        'titre_langue_objet' => 'Langue de ce geoportail93',
        'texte_definir_comme_traduction_objet' => 'Ce geoportail93 est une traduction du geoportail93 numéro :',
        'titre_objets_rubrique' => 'Geoportail93s de la rubrique',
        'info_objets_auteur' => 'Les geoportail93s de cet auteur',
        'retirer_lien_objet' => 'Retirer ce geoportail93',
        'retirer_tous_liens_objets' => 'Retirer tous les geoportail93s',
        'ajouter_lien_objet' => 'Ajouter ce geoportail93',
        'texte_ajouter_objet' => 'Ajouter un geoportail93',
        'texte_creer_associer_objet' => 'Créer et associer un geoportail93',
        'texte_changer_statut_objet' => 'Ce geoportail93 est :',
      ),
      'table_liens' => 'on',
      'vue_liens' => 
      array (
        0 => 'spip_articles',
      ),
      'roles' => '',
      'auteurs_liens' => '',
      'vue_auteurs_liens' => '',
      'echafaudages' => 
      array (
        0 => 'prive/squelettes/contenu/objets.html',
        1 => 'prive/objets/infos/objet.html',
        2 => 'prive/squelettes/contenu/objet.html',
      ),
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
        1 => 'outils_rapides',
      ),
      'saisies' => 
      array (
        0 => 'objets',
      ),
    ),
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => '',
          'contenu' => '',
        ),
      ),
    ),
    'objets' => 
    array (
      0 => 
      array (
      ),
    ),
  ),
);

?>