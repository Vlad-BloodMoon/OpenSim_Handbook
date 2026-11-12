<?php require_once __DIR__.'/inc/site.php';begin_page('Fichiers INI et connexions SQL','INI files and SQL connections','Explications détaillées pour OpenSimulator 0.9.3.1, basées sur les fichiers INI et le code source.','Detailed OpenSimulator 0.9.3.1 explanations based on INI templates and source code.');
callout('Les bases et fichiers de votre installation peuvent être organisés autrement. Vérifiez toujours les paramètres réellement chargés. Ne modifiez pas directement les données SQL sans sauvegarde.','Your deployment may organize schemas and files differently. Always inspect actual loaded settings. Never edit SQL data directly without a backup.');
echo '<nav class="install-toc"><strong>'.e(t('Dans ce chapitre','In this chapter')).'</strong><ul>';
echo '<li><a href="#db-1">'.e(t('Quel processus lit quel INI ?','Which process reads which INI?')).'</a></li>';
echo '<li><a href="#db-2">'.e(t('DatabaseService, StorageProvider, ConnectionString','DatabaseService, StorageProvider, ConnectionString')).'</a></li>';
echo '<li><a href="#db-3">'.e(t('EstateConnectionString','EstateConnectionString')).'</a></li>';
echo '<li><a href="#db-4">'.e(t('SQLite et inclusions','SQLite and includes')).'</a></li>';
echo '<li><a href="#db-5">'.e(t('Attention aux modifications','Editing precautions')).'</a></li>';
echo '</ul></nav>';
echo '<section class="install-entry" id="db-1">';sec('Quel processus lit quel INI ?','Which process reads which INI?');p('ROBUST utilise notamment Robust.ini ou Robust.HG.ini. Chaque simulateur lit OpenSim.ini avec son GridCommon.ini ou StandaloneCommon.ini inclus. Modifier un INI de ROBUST ne change pas automatiquement ceux des simulateurs.','ROBUST commonly uses Robust.ini or Robust.HG.ini. Each simulator reads OpenSim.ini and its included GridCommon.ini or StandaloneCommon.ini. Editing a ROBUST INI does not automatically change simulator settings.');echo '</section>';
echo '<section class="install-entry" id="db-2">';sec('DatabaseService, StorageProvider, ConnectionString','DatabaseService, StorageProvider, ConnectionString');p('La section [DatabaseService] sélectionne le fournisseur de stockage et sa chaîne de connexion. Data Source pointe vers le serveur MySQL, Database vers le schéma SQL. Un même serveur peut héberger plusieurs bases distinctes. Certains modules peuvent surcharger la connexion par défaut.','[DatabaseService] selects a storage provider and connection string. Data Source names the MySQL server; Database names the SQL schema. One server can host several independent schemas. Some modules may override the default connection.');echo '</section>';
echo '<section class="install-entry" id="db-3">';sec('EstateConnectionString','EstateConnectionString');p('Dans GridCommon.ini.example, EstateConnectionString permet de choisir un schéma destiné aux estates. L\'autre possibilité est un connecteur [EstateDataStore] EstateDataRemoteConnector associé à [EstateService] EstateServerURI et à un service EstateDataRobustConnector explicitement activé côté ROBUST.','GridCommon.ini.example provides EstateConnectionString for a separate estate schema. Another option uses [EstateDataStore] EstateDataRemoteConnector with [EstateService] EstateServerURI and an explicitly enabled EstateDataRobustConnector on ROBUST.');echo '</section>';
echo '<section class="install-entry" id="db-4">';sec('SQLite et inclusions','SQLite and includes');p('Les modèles contiennent des exemples SQLite et MySQL. Attention aux lignes commentées, aux inclusions actives et aux surcharges des modules : c\'est la configuration effectivement chargée qui décide de l\'emplacement des données.','Templates include SQLite and MySQL examples. Watch commented lines, active includes and module overrides: effective loaded configuration determines data locations.');echo '</section>';
echo '<section class="install-entry" id="db-5">';sec('Attention aux modifications','Editing precautions');p('Changer le champ Database n\'effectue aucune migration. Si la nouvelle base est vide, les modules peuvent initialiser de nouvelles tables, donnant l\'impression que les données ont disparu. Sauvegardez les schémas et INI avant toute intervention ; ne diffusez jamais les vrais mots de passe SQL.','Changing Database does not migrate data. Empty targets may be initialized with new tables, making records appear lost. Back up schemas and INI files before changes; never publish real SQL passwords.');echo '</section>';
sample('; Robust.HG.ini du service central
[DatabaseService]
StorageProvider = "OpenSim.Data.MySQL.dll"
ConnectionString = "Data Source=localhost;Database=central_services;User ID=grid_user;Password=EXEMPLE;"

; GridCommon.ini d\'un simulateur (autre fichier)
[DatabaseService]
StorageProvider = "OpenSim.Data.MySQL.dll"
ConnectionString = "Data Source=localhost;Database=region_data;User ID=region_user;Password=EXEMPLE;"
; EstateConnectionString = "Data Source=localhost;Database=estate_data;User ID=estate_user;Password=EXEMPLE;"','Exemples pédagogiques de fichiers distincts. Vérifiez les inclusions et les options du pilote avant de les adapter.','Teaching examples from separate files. Verify includes and driver options before adapting.');
sec('Autres guides du dossier','Other guides in this section');echo '<ul>';
echo '<li><a href="database-overview.php?lang='.e($lang).'">'.e(t('Comprendre les bases de données OpenSimulator','Understanding OpenSimulator databases')).'</a></li>';
echo '<li><a href="database-regions.php?lang='.e($lang).'">'.e(t('Regions.ini et tables des régions','Regions.ini and region tables')).'</a></li>';
echo '<li><a href="database-estates.php?lang='.e($lang).'">'.e(t('OpenSim.ini, Estates.ini et stockage des estates','OpenSim.ini, Estates.ini and estate storage')).'</a></li>';
echo '<li><a href="database-tables.php?lang='.e($lang).'">'.e(t('Tables SQL OpenSimulator 0.9.3.1','OpenSimulator 0.9.3.1 SQL tables')).'</a></li>';
echo '<li><a href="database-backups.php?lang='.e($lang).'">'.e(t('Sauvegarder et migrer les bases OpenSimulator','Backing up and migrating OpenSimulator databases')).'</a></li>';
echo '<li><a href="database-admin.php?lang='.e($lang).'">'.e(t('Administrer MySQL / MariaDB','Administer MySQL / MariaDB')).'</a></li>';
echo '<li><a href="install-grid.php?lang='.e($lang).'">'.e(t('Installer une grille ROBUST','Install a ROBUST grid')).'</a></li>';
echo '<li><a href="fsassets.php?lang='.e($lang).'">'.e(t('Comprendre FSAssets','Understanding FSAssets')).'</a></li>';
echo '</ul>';sec('Fichiers sources OpenSimulator 0.9.3.1','OpenSimulator 0.9.3.1 source files');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/bin/Robust.HG.ini.example" target="_blank" rel="noopener">'.e('Robust.HG.ini.example').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/bin/config-include/GridCommon.ini.example" target="_blank" rel="noopener">'.e('GridCommon.ini.example').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/bin/config-include/StandaloneCommon.ini.example" target="_blank" rel="noopener">'.e('StandaloneCommon.ini.example').'</a></li>';
echo '</ul>';end_page();
