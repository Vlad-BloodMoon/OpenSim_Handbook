<?php
require_once __DIR__.'/inc/site.php';
begin_page('Commandes scripts, statistiques et débogage','Script, statistics and debugging commands','Surveiller la charge et gérer YEngine ou les scripts, en évitant les opérations coûteuses.','Inspect performance and operate YEngine or scripts while avoiding heavy interventions.');
callout('Version de référence : OpenSimulator 0.9.3.1. Comparaison avec le PDF officiel historique ; une commande indiquée comme historique doit être confirmée avec help sur le processus concerné. Ne pas lancer de commande destructive sans sauvegarde.','Reference version: OpenSimulator 0.9.3.1. Compared with the historical official PDF; historical commands require checking help on the relevant process. Never run destructive operations without backups.');
sec('Le moteur de scripts doit être identifié','Identify the active script engine');p('Les commandes yeng sont disponibles lorsque YEngine est chargé. Le PDF présente quelques syntaxes anciennes et des sous-commandes qui ne correspondent pas toutes à l\'aide actuelle du code ; utilisez d\'abord yeng help. Suspendre le moteur ne revient pas à effacer les fichiers d\'état des scripts.','yeng commands are available when YEngine is loaded. The PDF contains some older syntax and commands not all present in current source help; start with yeng help. Suspending scripts does not delete script-state files.');
sec('Interpréter les statistiques','Interpreting statistics');p('show stats et monitor report servent au diagnostic : FPS du simulateur, coût physique, temps de frame, scripts et trafic. Leur présence et leur format dépendent du module et de la version. Une valeur isolée, sans contexte d\'utilisation, ne prouve pas une saturation du serveur.','show stats and monitor report help diagnose simulator FPS, physics cost, frame timing, scripts and traffic. Availability and output depend on module and version. A single isolated number is not proof of server saturation.');
sec('Le débogage peut coûter cher','Debugging has overhead');p('Les journaux HTTP ou paquets peuvent produire beaucoup de lignes, ralentir l\'analyse et exposer des adresses de services ou des données de session. Activez-les uniquement le temps nécessaire, limitez leur diffusion et restaurez le niveau de logs ensuite.','HTTP or packet debug logs can generate high volume, slow analysis and expose service endpoints or session data. Enable only as needed, limit sharing and restore logging afterward.');
sec('YEngine : code vérifié','YEngine: verified code');options_table([
['yeng help','Afficher l\'aide du moteur','Show script-engine help','Première étape recommandée','Recommended first'],
['yeng ls','Examiner les scripts selon les filtres disponibles','Inspect scripts using available filters','Utiliser yeng ls -help sur la version','Use yeng ls -help in current version'],
['yeng reset','Réinitialiser des scripts selon la portée','Reset scripts according to scope','Action lourde, vérifier arguments et régions','Potentially heavy; check args and regions'],
['yeng resume','Reprendre l\'exécution des scripts','Resume script execution','Peut libérer une charge en attente','Can unleash pending work'],
['yeng suspend','Suspendre l\'exécution des scripts','Suspend script execution','Arrête temporairement les scripts concernés','Temporarily halts affected scripts'],
['yeng cvv','Afficher la version du compilateur','Show compiler version','Lecture seule','Read-only'],
['yeng mvv','Afficher la version de migration','Show migration version','Code actuel affiche la valeur','Current code displays current value'],
['yeng tracecalls yes|no','Activer/désactiver les traces d\'appels','Toggle call tracing','Logs potentiellement volumineux','Potentially high log volume'],
['yeng verbose yes|no','Modifier les traces détaillées','Toggle verbose output','Préférer un diagnostic temporaire','Use temporarily'],
]);
sec('Scripts et statistiques','Scripts and metrics');options_table([
['scripts show','Afficher des informations de scripts','Show script information','Commande du PDF ; vérifier moteur','From PDF; check engine'],
['scripts stop','Arrêter des scripts ciblés','Stop scripts','Peut interrompre le fonctionnement d\'objets','May break object functions'],
['scripts start','Démarrer des scripts ciblés','Start scripts','Peut augmenter la charge','May increase load'],
['scripts suspend','Suspendre les scripts concernés','Suspend scripts','Portée de commande à confirmer','Confirm scope'],
['scripts resume','Reprendre des scripts suspendus','Resume scripts','Portée de commande à confirmer','Confirm scope'],
['show stats','Afficher statistiques système/simulateur','Display simulator/server stats','Lire plusieurs échantillons','Check multiple samples'],
['monitor report','Afficher la surveillance disponible','Display monitoring report','Dépend du module de monitoring','Depends on monitoring module'],
['stats record start|stop','Enregistrer périodiquement des statistiques','Record periodic statistics','Vérifier emplacement et I/O du fichier','Check file location and I/O'],
['stats save <fichier>','Sauvegarder un instantané de statistiques','Save statistics snapshot','PDF ancien ; vérifier help','Older PDF; verify help'],
]);
sec('Diagnostic','Debug commands');options_table([
['debug packet <niveau>','Tracer les paquets réseau du simulateur','Trace simulator packets','Débit de logs élevé, données sensibles','Large logs and sensitive data'],
['debug http ...','Tracer des requêtes HTTP','Trace HTTP calls','Syntaxe varie ; ne pas exposer les tokens','Syntax varies; redact tokens'],
['debug threadpool level <niveau>','Diagnostiquer le pool de threads','Diagnose the threadpool','PDF historique ; vérifier help','Historical PDF; verify help'],
['get log level','Lire le niveau courant de console','Read current console log level','Confirmer console et version','Check process and version'],
['set log level <niveau>','Modifier le niveau de journalisation','Change logging level','Réduire la verbosité après diagnostic','Restore normal verbosity afterward'],
['show pending-objects','Voir les objets en attente d\'envoi','Inspect pending object updates','Code simulateur vérifié','Verified simulator source'],
['show pqueues [full]','Examiner les files prioritaires','Inspect priority queues','PDF historique ; vérifier présence','Historical PDF; verify presence'],
['show queues','Voir les files des connexions','Inspect connection queues','PDF historique ; vérifier présence','Historical PDF; verify presence'],
['show throttles [full]','Examiner les limites réseau des clients','Inspect client throttles','Ne pas publier de données de sessions','Redact session data'],
]);
subheading('Indicateurs de performance fréquents','Common performance indicators');options_table([
['SimFPS','Fréquence effective du simulateur','Simulator tick rate','À interpréter avec les temps de frame','Interpret with frame times'],
['PhyFPS','Fréquence de simulation physique','Physics simulation rate','Dépend du moteur','Engine-dependent'],
['RootAg / ChldAg','Agents principaux et enfants','Root and child agents','Éviter de confondre visiteurs et agents voisins','Do not confuse root and neighbor child agents'],
['AtvScr','Scripts actifs','Active scripts','Ne mesure pas à lui seul le temps CPU','Not CPU time by itself'],
['PhysFt / TotlFt','Temps physique et temps total de frame','Physics and total frame time','Comparer plusieurs observations','Compare multiple samples'],
['PktOut / PktsIn','Débit de paquets réseau','Network packet rates','N\'indique pas seul un goulot d\'étranglement','Not proof of bottleneck by itself'],
]);
sec('Références','References');p('Document de départ : PDF de la page officielle « Server Commands/fr », édition du 19 mars 2025 ; indications historiques à recouper. Code OpenSimulator 0.9.3.1 vérifié pour les exemples cités ci-dessous.','Source document: PDF print of official Server Commands/fr page, last edited 19 March 2025; older entries need verification. OpenSimulator 0.9.3.1 source checked for the listed examples.');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/ScriptEngine/YEngine/XMREngine.cs" target="_blank" rel="noopener">'.e('XMREngine.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/Application/OpenSim.cs" target="_blank" rel="noopener">'.e('OpenSim.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/Framework/Monitoring/MonitorModule.cs" target="_blank" rel="noopener">'.e('MonitorModule.cs').'</a></li>';
echo '<li><a href="https://opensimulator.org/wiki/Server_Commands/fr" target="_blank" rel="noopener">Server Commands / fr</a></li>';echo '</ul>';end_page();
