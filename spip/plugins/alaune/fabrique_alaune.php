<?php

/**
 *  Fichier généré par la Fabrique de plugin v5
 *   le 2013-12-10 12:35:10
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
    'nom' => 'gestion une',
    'slogan' => '',
    'description' => 'gestion de la une de l\'emag',
    'prefixe' => 'alaune',
    'version' => '1.0.2',
    'auteur' => 'samuel et damien',
    'auteur_lien' => '',
    'licence' => 'GNU/GPL',
    'categorie' => 'navigation',
    'etat' => 'dev',
    'compatibilite' => '[3.0.13;3.0.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => 'on',
    'formulaire_config_titre' => 'alaune',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'options',
      3 => 'pipelines',
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
      'nom' => 'unes',
      'nom_singulier' => 'une',
      'genre' => 'feminin',
      'logo_variantes' => '',
      'table' => 'spip_unes',
      'cle_primaire' => 'id_une',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'une',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Dossier',
          'champ' => 'id_dossier',
          'sql' => 'bigint(21) NOT NULL DEFAULT 0',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '',
          'saisie' => 'input',
          'explication' => 'numero du dossier (rubrique)',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Titre',
          'champ' => 'titres',
          'sql' => 'mediumtext NOT NULL DEFAULT \'\'',
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
      'champ_titre' => 'titres',
      'champ_date' => 'date',
      'statut' => 'on',
      'chaines' => 
      array (
        'titre_objets' => 'Unes',
        'titre_objet' => 'Une',
        'info_aucun_objet' => 'Aucune une',
        'info_1_objet' => 'Une une',
        'info_nb_objets' => '@nb@ unes',
        'icone_creer_objet' => 'Créer une une',
        'icone_modifier_objet' => 'Modifier cette une',
        'titre_logo_objet' => 'Logo de cette une',
        'titre_langue_objet' => 'Langue de cette une',
        'titre_objets_rubrique' => 'Unes de la rubrique',
        'info_objets_auteur' => 'Les unes de cet auteur',
        'retirer_lien_objet' => 'Retirer cette une',
        'retirer_tous_liens_objets' => 'Retirer toutes les unes',
        'ajouter_lien_objet' => 'Ajouter cette une',
        'texte_ajouter_objet' => 'Ajouter une une',
        'texte_creer_associer_objet' => 'Créer et associer une une',
        'texte_changer_statut_objet' => 'Cette une est :',
      ),
      'table_liens' => '',
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
        'objet_creer' => 'administrateur',
        'objet_voir' => '',
        'objet_modifier' => 'administrateur',
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