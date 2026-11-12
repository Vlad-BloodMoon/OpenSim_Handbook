<?php require_once __DIR__.'/inc/site.php';begin_page('Comprendre les bases de données OpenSimulator','Understanding OpenSimulator databases','Explications détaillées pour OpenSimulator 0.9.3.1, basées sur les fichiers INI et le code source.','Detailed OpenSimulator 0.9.3.1 explanations based on INI templates and source code.');
callout('Les bases et fichiers de votre installation peuvent être organisés autrement. Vérifiez toujours les paramètres réellement chargés. Ne modifiez pas directement les données SQL sans sauvegarde.','Your deployment may organize schemas and files differently. Always inspect actual loaded settings. Never edit SQL data directly without a backup.');
echo '<nav class="install-toc"><strong>'.e(t('Dans ce chapitre','In this chapter')).'</strong><ul>';
echo '<li><a href="#db-1">'.e(t('La grille n\'a pas forcément une base unique','A grid does not necessarily have one database')).'</a></li>';
echo '<li><a href="#db-2">'.e(t('ROBUST et les services centraux','ROBUST and central services')).'</a></li>';
echo '<li><a href="#db-3">'.e(t('Les données de scène','Scene persistence')).'</a></li>';
echo '<li><a href="#db-4">'.e(t('Les estates','Estates')).'</a></li>';
echo '<li><a href="#db-5">'.e(t('FSAssets et la séparation des données','FSAssets and separate data layers')).'</a></li>';
echo '</ul></nav>';
echo '<section class="install-entry" id="db-1">';sec('La grille n\'a pas forcément une base unique','A grid does not necessarily have one database');p('En version 0.9.3.1, chaque processus ROBUST ou simulateur lit sa propre configuration. Plusieurs schémas SQL sur une même instance MySQL, un seul schéma partagé ou des serveurs SQL différents sont possibles. Le nombre de régions n\'impose pas le nombre de bases.','In 0.9.3.1 each ROBUST or simulator process reads its own configuration. Multiple schemas on one MySQL server, one shared schema, or different SQL servers are possible. Region count does not determine database count.');echo '</section>';
echo '<section class="install-entry" id="db-2">';sec('ROBUST et les services centraux','ROBUST and central services');p('ROBUST héberge typiquement les services de comptes, authentification, inventaire, assets, amis, présence et répertoire de régions. GridStore est le domaine de stockage du répertoire des régions, pas des scènes. Certains modules additionnels emploient encore d\'autres bases.','ROBUST typically runs accounts, authentication, inventory, assets, friends, presence and grid-region directory services. GridStore holds region directory records, not scenes. Optional add-ons may use further databases.');echo '</section>';
echo '<section class="install-entry" id="db-3">';sec('Les données de scène','Scene persistence');p('Chaque simulateur conserve des objets, parcelles, terrains et réglages régionaux via un fournisseur de stockage tel que MySQLSimulationData et ses tables RegionStore. Plusieurs régions peuvent partager les mêmes tables, leurs données étant distinguées par RegionUUID.','A simulator persists objects, parcels, terrain and region settings through a provider such as MySQLSimulationData and RegionStore tables. Several regions can share those tables, with RegionUUID distinguishing records.');echo '</section>';
echo '<section class="install-entry" id="db-4">';sec('Les estates','Estates');p('EstateStore rassemble les paramètres des estates, propriétaires, gestionnaires, restrictions et relations entre regions et estates. Le stockage peut utiliser la connexion du simulateur, une EstateConnectionString dédiée ou un service central ROBUST activé explicitement.','EstateStore contains estate settings, owners, managers, restrictions and region-to-estate mappings. It can use the simulator connection, a dedicated EstateConnectionString or an explicitly configured central ROBUST service.');echo '</section>';
echo '<section class="install-entry" id="db-5">';sec('FSAssets et la séparation des données','FSAssets and separate data layers');p('La base de métadonnées FSAssets et ses fichiers d\'assets ne contiennent pas les prims et terrains à la place de RegionStore. Déplacer les assets vers un disque dédié ne déplace pas la base des régions ni les estates.','FSAssets metadata and asset files do not replace RegionStore scene records. Moving assets to a dedicated disk does not move region or estate databases.');echo '</section>';
sample('ROBUST -> [DatabaseService] -> SQL services centraux / central services
SIMULATEUR -> [DatabaseService] -> SQL RegionStore / scenes
ESTATES -> connexion locale / EstateConnectionString / ROBUST distant

Un même schéma peut réunir plusieurs fonctions.
One SQL schema can serve several roles.','Schéma logique simplifié : les connexions réelles sont définies dans vos INI.','Simplified logical diagram: real connections depend on your INI settings.');
sec('Autres guides du dossier','Other guides in this section');echo '<ul>';
echo '<li><a href="database-ini.php?lang='.e($lang).'">'.e(t('Fichiers INI et connexions SQL','INI files and SQL connections')).'</a></li>';
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
echo '</ul>';end_page();
