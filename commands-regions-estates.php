<?php
require_once __DIR__.'/inc/site.php';
begin_page('Commandes de régions et d\'estates','Region and estate console commands','Créer, déplacer, enregistrer ou gérer des régions et estates sans confondre ROBUST et simulateur.','Manage regions and estates without confusing ROBUST\'s Grid service with simulator storage.');
callout('Référence OpenSimulator 0.9.3.1. Les commandes du PDF historique (notamment 0.7.x) ne sont pas toutes garanties : vérifier help et les modules réellement chargés. Les commandes d\'écriture et de suppression exigent une sauvegarde préalable.','Reference: OpenSimulator 0.9.3.1. Historical PDF commands (including 0.7.x) are not all guaranteed: check help and loaded modules. Write/delete operations require backups.');
sec('Deux commandes show regions différentes','Two different show regions commands');p('La console du simulateur dispose de show regions pour ses régions locales. Le service Grid de ROBUST peut également exposer show regions mais il interroge son registre GridStore. Des résultats différents ne prouvent pas une perte de scène.','The simulator provides show regions for its local regions. ROBUST\'s Grid service can also offer show regions but queries its GridStore registry. Different results do not prove scene data loss.');
sec('Sélection et redémarrage','Selection and restarting');p('Dans un simulateur hébergeant plusieurs régions, change region <nom> doit précéder une opération qui ne doit toucher qu\'une région. La commande restart peut agir sur la région sélectionnée ou sur plusieurs suivant le contexte. Effectuez les opérations perturbatrices pendant une fenêtre planifiée.','On a multi-region simulator, select change region <name> before operations intended for only one region. The restart command can affect the selected region(s) depending on console context. Schedule disruptive changes.');
sec('La gestion des estates est persistante','Estate changes persist');p('estate create, estate set owner et estate link region modifient des relations et des autorisations stockées par EstateDataService. Ils ne se limitent pas à des valeurs temporaires d\'OpenSim.ini. Sauvegardez la base EstateStore et vérifiez les UUID avant de les lancer.','estate create, estate set owner and estate link region change relationships and access controls stored through EstateDataService. They are not just temporary OpenSim.ini changes. Back up EstateStore and verify UUIDs first.');
sec('Console du simulateur','Simulator console');options_table([
['show region','Voir les paramètres de la région sélectionnée','Inspect selected region settings','Code confirmé','Confirmed in source'],
['region get','Afficher les réglages de contrôle courants','Show current region control settings','Lecture seule','Read-only'],
['region set','Modifier certains réglages de région','Set selected region settings','Consulter help : valeurs et persistance variables','Check help: settings and persistence differ'],
['show neighbours','Afficher les voisins locaux','Show local neighbors','Lecture seule','Read-only'],
['show regionsinview','Voir les régions visibles autour d\'une région','Show regions in view','Code 0.9.3.1 confirmé, absent du PDF','Verified 0.9.3.1 addition'],
['create region [nom] <fichier.ini>','Créer une région depuis un fichier de configuration','Create region from an INI file','Vérifier UUID, port, nom, estate et emplacement','Check UUID, port, name, estate and position'],
['remove-region <nom>','Retirer une région du simulateur','Remove a region from the simulator','Peut couper immédiatement les utilisateurs','May disconnect users'],
['delete-region <nom>','Supprimer la définition de région sur disque','Delete a region definition on disk','Destructeur : distinguer scène, fichier et registre','Destructive: distinguish scene, file and registry'],
['restart','Redémarrer la ou les régions sélectionnées','Restart selected region(s)','Confirmer change region','Confirm change region first'],
['region restart notice ...','Programmer un redémarrage avec avis','Schedule restart with notice','Syntaxe du PDF, vérifier help de la version','PDF syntax; verify version help'],
['estate show','Afficher les estates associés au moteur','Show simulator estates','N\'affiche pas forcément tous les estates SQL','May not show every SQL estate'],
]);
sec('Administration des estates','Estate management');options_table([
['estate create <ownerUUID> <nom>','Créer un estate','Create a new estate','Modifie EstateStore ; nom unique requis','Writes EstateStore; unique name required'],
['estate set name <id> <nom>','Renommer un estate','Rename an estate','Persistance et impact sur régions associées','Persistent change affects linked regions'],
['estate set owner <id> <UUID>','Changer le propriétaire de l\'estate','Change estate owner','Confirmer UUID et droits','Double-check UUID and permissions'],
['estate link region <estateID> <regionID>','Associer une région à un estate','Attach a region to an estate','Modifie estate_map ; faire une sauvegarde','Changes estate_map; back up first'],
['reload estate','Rafraîchir les données d\'estate','Reload estate settings','Historique PDF ; vérifier son enregistrement','PDF historical; verify registration'],
['set terrain texture <n> <UUID>','Changer une texture de terrain','Change terrain texture','Fonctionnel selon module estate','Estate-module dependent'],
['set terrain pbr <n> <UUID>','Changer un asset PBR du terrain','Change a terrain PBR asset','Ajout confirmé 0.9.3.1','Verified 0.9.3.1 addition'],
['set water height <hauteur>','Modifier la hauteur de l\'eau','Change water height','Peut modifier les régions ciblées','Can affect targeted regions'],
]);
sec('Service Grid de ROBUST','ROBUST Grid service');options_table([
['show region name <nom>','Afficher un enregistrement GridStore','Show a GridStore region record','Lecture seule ; différent de la scène','Read-only; not scene data'],
['show region at <x> <y>','Trouver une région à des coordonnées','Find region at coordinates','Code confirmé','Source verified'],
['show regions','Afficher le registre des régions de la grille','List registered grid regions','Peut inclure enregistrements hors ligne','May include offline records'],
['show grid size','Afficher la taille de grille connue','Show registered grid size','Commande ajoutée dans le code vérifié','Confirmed in reviewed source'],
['set region flags <nom> <flags>','Modifier les indicateurs du registre','Change region registry flags','Altère GridStore ; risque d\'accès','Modifies GridStore; affects access'],
['deregister region id <UUID>','Désenregistrer une région manuellement','Manually deregister a region','Ne pas lancer sur une région active','Do not run on an active region'],
]);
sec('Sources et vérification','Sources and verification');p('La structure initiale vient du PDF « Server Commands/fr » transmis par le contributeur (page officielle, édition du 19 mars 2025, contenant des instructions parfois plus anciennes). Des commandes supplémentaires et certaines syntaxes ont été vérifiées dans le code 0.9.3.1 lié ci-dessous.','The initial outline comes from the contributor-provided Server Commands/fr PDF (official wiki, 19 March 2025 revision, including older guidance). Additional commands and some syntax were checked in the linked 0.9.3.1 code.');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/Application/OpenSim.cs" target="_blank" rel="noopener">'.e('OpenSim.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/World/Region/RegionCommandsModule.cs" target="_blank" rel="noopener">'.e('RegionCommandsModule.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/World/Estate/EstateManagementCommands.cs" target="_blank" rel="noopener">'.e('EstateManagementCommands.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Services/GridService/GridService.cs" target="_blank" rel="noopener">'.e('GridService.cs').'</a></li>';
echo '<li><a href="https://opensimulator.org/wiki/Server_Commands/fr" target="_blank" rel="noopener">Server Commands / fr</a></li>';echo '</ul>';end_page();
