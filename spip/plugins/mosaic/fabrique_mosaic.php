<?php

/**
 *  Fichier généré par la Fabrique de plugin v5
 *   le 2015-11-30 15:14:05
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
    'nom' => 'mosaique',
    'slogan' => '',
    'description' => '',
    'prefixe' => 'mosaic',
    'version' => '1.0.0',
    'auteur' => 'samuel',
    'auteur_lien' => '',
    'licence' => 'GNU/GPL',
    'categorie' => 'multimedia',
    'etat' => 'dev',
    'compatibilite' => '[3.0.19;3.0.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => '',
    'formulaire_config_titre' => '',
    'fichiers' => 
    array (
      0 => 'fonctions',
      1 => 'options',
      2 => 'pipelines',
    ),
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
      'nom' => 'mosaics',
      'nom_singulier' => 'mosaic',
      'genre' => 'feminin',
      'logo_variantes' => '',
      'table' => 'spip_mosaics',
      'cle_primaire' => 'id_mosaic',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'mosaic',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'mail',
          'champ' => 'mail',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'fichier',
          'champ' => 'fichier',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '',
          'saisie' => '',
          'explication' => '',
          'saisie_options' => '',
        ),
        2 => 
        array (
          'nom' => 'interne',
          'champ' => 'interne',
          'sql' => 'varchar(1) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
          ),
          'recherche' => '',
          'saisie' => '',
          'explication' => '',
          'saisie_options' => '',
        ),
      ),
      'champ_titre' => '',
      'champ_date' => 'date',
      'statut' => 'on',
      'chaines' => 
      array (
        'titre_objets' => 'Mosaics',
        'titre_objet' => 'Mosaic',
        'info_aucun_objet' => 'Aucune mosaic',
        'info_1_objet' => 'Une mosaic',
        'info_nb_objets' => '@nb@ mosaics',
        'icone_creer_objet' => 'Créer une mosaic',
        'icone_modifier_objet' => 'Modifier cette mosaic',
        'titre_logo_objet' => 'Logo de cette mosaic',
        'titre_langue_objet' => 'Langue de cette mosaic',
        'texte_definir_comme_traduction_objet' => 'Cette mosaic est une traduction de la mosaic numéro :',
        'titre_objets_rubrique' => 'Mosaics de la rubrique',
        'info_objets_auteur' => 'Les mosaics de cet auteur',
        'retirer_lien_objet' => 'Retirer cette mosaic',
        'retirer_tous_liens_objets' => 'Retirer toutes les mosaics',
        'ajouter_lien_objet' => 'Ajouter cette mosaic',
        'texte_ajouter_objet' => 'Ajouter une mosaic',
        'texte_creer_associer_objet' => 'Créer et associer une mosaic',
        'texte_changer_statut_objet' => 'Cette mosaic est :',
      ),
      'table_liens' => '',
      'roles' => '',
      'auteurs_liens' => '',
      'vue_auteurs_liens' => '',
      'echafaudages' => 
      array (
        0 => 'prive/squelettes/contenu/objets.html',
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