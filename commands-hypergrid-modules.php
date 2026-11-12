<?php
require_once __DIR__.'/inc/site.php';
begin_page('Commandes Hypergrid, modules et configuration','Hypergrid, modules and configuration commands','Diagnostic des régions Hypergrid liées, modules, paramètres effectifs et amitiés.','Troubleshoot linked Hypergrid regions, modules, effective configuration and friendships.');
callout('Version de référence : OpenSimulator 0.9.3.1. Les commandes héritées d\'anciennes versions doivent être confirmées avec help sur le processus concerné. Ne pas lancer de commande destructive sans sauvegarde.','Reference version: OpenSimulator 0.9.3.1. Commands from older releases must be checked with help on the relevant process. Never run destructive operations without backups.');
sec('La connexion Hypergrid n\'est pas un simple raccourci','Hypergrid linking is more than a shortcut');p('link-region et unlink-region modifient la manière dont des régions distantes sont représentées ou reliées localement. Ne les utilisez pas pour réparer à l\'aveugle un problème DNS ou Gatekeeper. Leur disponibilité dépend de la configuration Hypergrid et du code réellement activé.','link-region and unlink-region change how remote regions are represented or linked locally. Do not use them blindly to repair DNS or Gatekeeper failures. Availability depends on Hypergrid configuration and loaded modules.');
sec('La configuration actuelle n\'est pas toujours rechargée','Effective configuration is not always reloaded');p('config get permet d\'inspecter certains paramètres et config save de les sauvegarder. Les modifications faites par config set ne sont pas systématiquement répercutées aux modules déjà initialisés. Vérifiez les INI et la documentation des composants avant de supposer qu\'un réglage devient actif immédiatement.','config get can inspect settings and config save can write them to a file. config set changes are not automatically applied to already initialized modules. Check INI settings and component behavior before assuming hot reload.');
sec('Amitiés et état de cache','Friends and cached data');p('Le module optionnel FriendsCommandsModule enregistre friends show [--cache] <first> <last>. L\'option --cache affiche des informations mises en cache localement ; elle ne modifie ni les relations dans FriendsStore ni celles des grilles Hypergrid distantes.','Optional FriendsCommandsModule registers friends show [--cache] <first> <last>. The --cache option displays locally cached friendship information; it does not alter FriendsStore relationships or remote Hypergrid grids.');
sec('Hypergrid','Hypergrid');options_table([
['show hyperlinks','Lister les régions Hypergrid liées','List linked Hypergrid regions','Ancien wiki ; vérifier module actif','Older wiki; check module'],
['link-region <x> <y> <URI> [nom]','Lier une région étrangère à des coordonnées locales','Link a foreign region to local coordinates','Modifier avec prudence ; valider URI publique','Use cautiously; validate public URI'],
['unlink-region <nom>','Supprimer un lien vers une région étrangère','Remove a linked foreign region','Peut casser des landmarks liés localement','May affect local linked landmarks'],
['link-mapping <x> <y>','Adapter des coordonnées de liens Hypergrid','Adjust Hypergrid link mapping','Syntaxe ancienne à confirmer','Legacy syntax; verify'],
]);
sec('Modules','Modules');options_table([
['show modules','Afficher les modules connus du simulateur','Inspect installed/loaded modules','Lecture seule','Read-only'],
['modules list','Lister les modules gérables','List manageable modules','Dépend du gestionnaire de modules','Depends on module manager'],
['modules load <nom>','Charger un module','Load a module','Ne fonctionne pas pour tous les modules','Not supported for every module'],
['modules unload <nom>','Décharger un module','Unload a module','Peut interrompre des services actifs','May interrupt active services'],
['config get [section] [clé]','Afficher une valeur de configuration','Inspect a configuration value','À consulter sur le processus adéquat','Use correct process'],
['config show [section] [clé]','Autre accès à la configuration','Alternative configuration inspection','Wiki historique ; vérifier présence','Historical wiki; verify'],
['config save <chemin>','Sauvegarder la configuration courante','Save effective configuration','Écrit un fichier, vérifier les secrets','Writes a file; protect secrets'],
['config set <section> <clé> ...','Changer une valeur dans la configuration','Change a configuration value','Pas de rechargement garanti des modules','No guaranteed module hot reload'],
]);
sec('Amitiés et textures','Friends and textures');options_table([
['friends show <prénom> <nom>','Afficher les relations connues d\'un avatar','Show known friendships for an avatar','FriendsCommandsModule optionnel, source vérifiée','Optional FriendsCommandsModule; verified'],
['friends show --cache <prénom> <nom>','Examiner uniquement les informations mises en cache','Show locally cached friendship information','Ne change rien dans FriendsStore','Does not modify FriendsStore'],
['reset user cache','Effacer le cache du module UserManagement','Clear UserManagement cache','Console simulateur ; pas tous les caches de compte','Simulator only; not all account caches'],
['j2k decode <UUID>','Tester le décodage d\'une texture JPEG2000','Test JPEG2000 texture decoding','Module optionnel ; diagnostic','Optional module; diagnostic'],
]);
sec('Références','References');p('Références : documentation officielle des commandes console et code source OpenSimulator. Les indications anciennes sont à recouper avec la version installée. Code OpenSimulator 0.9.3.1 vérifié pour les exemples cités ci-dessous.','References: official console command documentation and OpenSimulator source code. Check older entries against your installed version. OpenSimulator 0.9.3.1 source checked for the listed examples.');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Services/GridService/HypergridLinker.cs" target="_blank" rel="noopener">'.e('HypergridLinker.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/OptionalModules/Avatar/Friends/FriendsCommandsModule.cs" target="_blank" rel="noopener">'.e('FriendsCommandsModule.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/Framework/UserManagement/UserManagementModule.cs" target="_blank" rel="noopener">'.e('UserManagementModule.cs').'</a></li>';
echo '<li><a href="https://opensimulator.org/wiki/Server_Commands/fr" target="_blank" rel="noopener">Server Commands / fr</a></li>';echo '</ul>';end_page();
