<?php
require_once __DIR__.'/inc/site.php';
begin_page('Commandes terrain, objets et scènes','Terrain, object and scene console commands','Gestion des terrains et des objets, diagnostic et commandes destructives.','Terrain and object management, diagnostics and destructive actions.');
callout('Référence OpenSimulator 0.9.3.1. Les commandes du PDF historique (notamment 0.7.x) ne sont pas toutes garanties : vérifier help et les modules réellement chargés. Les commandes d\'écriture et de suppression exigent une sauvegarde préalable.','Reference: OpenSimulator 0.9.3.1. Historical PDF commands (including 0.7.x) are not all guaranteed: check help and loaded modules. Write/delete operations require backups.');
sec('Sauvegarder avant toute transformation','Back up before transformations');p('Une commande sur un terrain, des objets ou une scène peut affecter définitivement un grand nombre d\'éléments. Sauvegardez un OAR de la région et vérifiez son nom. Les paramètres terrain modify peuvent restreindre une zone avec des masques de type rectangle ou ellipse.','Terrain, object and scene commands can permanently alter many items. Back up a region OAR and confirm its name. terrain modify supports restricting effects using rectangular or elliptical masks.');
sec('Région sélectionnée et coordonnées','Selected region and coordinates');p('Les changements de hauteur, la rotation et le déplacement de scène s\'appliquent au contexte du simulateur. Vérifiez la sélection de région et les unités : un décalage mal calculé peut déplacer beaucoup d\'objets hors du terrain.','Terrain height changes, scene rotation and translation operate in simulator context. Verify region selection and units: incorrect offsets can move many objects outside their intended area.');
sec('Terrains','Terrain commands');options_table([
['terrain load <fichier>','Importer une heightmap','Import a heightmap','Peut remplacer le relief','May overwrite terrain'],
['terrain save <fichier>','Exporter le relief courant','Export current heightmap','Sauvegarde ciblée du terrain','Terrain-only backup'],
['terrain fill <hauteur>','Appliquer une hauteur uniforme','Apply uniform terrain height','Destructeur','Destructive'],
['terrain elevate <valeur>','Relever le terrain','Raise the terrain','Destructeur','Destructive'],
['terrain lower <valeur>','Abaisser le terrain','Lower terrain','Destructeur','Destructive'],
['terrain multiply <facteur>','Multiplier les altitudes','Scale terrain heights','Impact massif possible','May alter whole terrain'],
['terrain bake','Conserver une référence de restauration du terrain','Save a baked terrain reference','Comprendre l\'état préalable avant modification','Understand current state first'],
['terrain revert','Revenir au terrain baké','Revert to baked terrain','Écrase des changements récents','Overwrites recent changes'],
['terrain stats','Lire des statistiques du terrain','Read terrain statistics','Diagnostic sans modification','Read-only diagnostics'],
['terrain show','Lire une hauteur à un point','Inspect terrain height at a point','Historique PDF ; vérifier help','PDF historical; check help'],
['terrain modify ...','Modifier une zone / ajouter un masque','Modify an area with optional mask','Tester les paramètres avant usage général','Test parameters first'],
['terrain flip','Inverser le terrain selon un axe','Flip terrain on an axis','Historique PDF ; vérifier disponibilité','Historical PDF; verify availability'],
['terrain rescale','Recaler les hauteurs du terrain','Rescale terrain heights','Modifie la topographie','Changes topography'],
]);
sec('Objets et scènes','Objects and scenes');options_table([
['backup','Forcer la persistance d\'objets non sauvés','Flush pending object persistence','Ne remplace pas OAR ni dump SQL','Does not replace OAR or SQL backup'],
['show object id <UUID|localID>','Examiner un objet','Inspect an object','Lecture seule','Read-only'],
['show object name <nom>','Chercher des objets par nom','Find objects by name','Option --regex suivant syntaxe','--regex option as supported'],
['show object owner <UUID>','Lister des objets d\'un propriétaire','Find objects by owner','Ajout confirmé dans le code','Verified source addition'],
['show object pos ...','Chercher des objets dans un volume','Find objects in a spatial volume','Ajout confirmé dans le code','Verified source addition'],
['delete object id <UUID|localID>','Supprimer un objet précis','Delete a specific object','Irréversible sans sauvegarde','Irreversible without backup'],
['delete object owner <UUID>','Supprimer les objets d\'un propriétaire','Delete objects by owner','Très dangereux : sauvegarde et confirmation','Very dangerous: backup and confirmation'],
['delete object creator <UUID>','Supprimer les objets d\'un créateur','Delete objects by creator','Très dangereux','Very dangerous'],
['delete object outside','Supprimer les objets hors frontières','Delete out-of-bounds objects','Contrôler les objets concernés','Check affected objects'],
['dump object id <UUID>','Exporter une sérialisation de diagnostic','Dump object serialization for diagnosis','N\'est pas une sauvegarde régionale','Not a region backup'],
['force update','Forcer l\'envoi d\'informations d\'objets aux viewers','Force viewer object updates','Charge réseau temporaire','Temporary network load'],
['rotate scene <degrés>','Pivoter la scène','Rotate the scene','Sauvegarder OAR avant','Back up OAR first'],
['scale scene <facteur>','Redimensionner la scène','Scale the scene','Affecte potentiellement tous les objets','Potentially affects all objects'],
['translate scene <x> <y> <z>','Translater les objets de la scène','Translate scene objects','Ne déplace pas la région sur GridStore','Does not move region on GridStore'],
]);
sec('Sources et vérification','Sources and verification');p('La structure initiale vient du PDF « Server Commands/fr » transmis par le contributeur (page officielle, édition du 19 mars 2025, contenant des instructions parfois plus anciennes). Des commandes supplémentaires et certaines syntaxes ont été vérifiées dans le code 0.9.3.1 lié ci-dessous.','The initial outline comes from the contributor-provided Server Commands/fr PDF (official wiki, 19 March 2025 revision, including older guidance). Additional commands and some syntax were checked in the linked 0.9.3.1 code.');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/World/Terrain/TerrainModule.cs" target="_blank" rel="noopener">'.e('TerrainModule.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/World/Objects/Commands/ObjectCommandsModule.cs" target="_blank" rel="noopener">'.e('ObjectCommandsModule.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/Application/OpenSim.cs" target="_blank" rel="noopener">'.e('OpenSim.cs').'</a></li>';
echo '<li><a href="https://opensimulator.org/wiki/Server_Commands/fr" target="_blank" rel="noopener">Server Commands / fr</a></li>';echo '</ul>';end_page();
