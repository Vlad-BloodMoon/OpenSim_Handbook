<?php
require_once __DIR__.'/inc/site.php';
begin_page('Commandes utilisateurs et services ROBUST','User and ROBUST service commands','Distinguer création de comptes, niveau de connexion, présence et commandes du simulateur.','Separate account creation, login level, presence and simulator-specific user commands.');
callout('Version de référence : OpenSimulator 0.9.3.1. Comparaison avec le PDF officiel historique ; une commande indiquée comme historique doit être confirmée avec help sur le processus concerné. Ne pas lancer de commande destructive sans sauvegarde.','Reference version: OpenSimulator 0.9.3.1. Compared with the historical official PDF; historical commands require checking help on the relevant process. Never run destructive operations without backups.');
sec('Les comptes se gèrent côté service','Account management belongs to services');p('En Grid, create user, reset user password et set user level sont enregistrées par UserAccountService : elles modifient les comptes gérés par ROBUST. Les commandes kick user, show users et reset user cache appartiennent au simulateur. Une commande n\'a pas le même effet selon le processus.','In Grid mode, create user, reset user password and set user level are registered by UserAccountService, modifying ROBUST-managed accounts. kick user, show users and reset user cache belong to simulators. Process location matters.');
sec('Distinguer le mot de passe et le cache','Password and cache are different');p('reset user password écrit un nouveau secret d\'authentification ; reset user cache vide seulement les associations utilisateur/nom connues du module UserManagement d\'un simulateur. Aucune des deux n\'est une commande de réparation universelle des relations Hypergrid.','reset user password writes a new authentication secret; reset user cache only clears user/name mappings held by a simulator\'s UserManagement module. Neither is a universal repair operation for Hypergrid friendships.');
sec('Sécurité des consoles','Console security');p('Ne copiez jamais de mots de passe réels dans une capture de console ou un script partagé. Les commandes de niveau d\'utilisateur ou de désactivation de connexion peuvent affecter une grille entière. Un niveau élevé peut donner des privilèges suivant la configuration.','Never disclose real passwords in screenshots or shared command files. User-level and login-gating operations may affect the whole grid. Elevated user levels can grant privileges depending on configuration.');
sec('ROBUST : comptes','ROBUST accounts');options_table([
['create user','Créer un compte en mode interactif','Create an account interactively','Code UserAccountService vérifié ; production sensible','Verified in UserAccountService; sensitive in production'],
['create user <prénom> <nom> <motdepasse> ...','Créer un compte avec paramètres','Create account with parameters','Options variables ; ne pas publier le mot de passe','Options vary; do not disclose passwords'],
['show account <prénom> <nom>','Afficher les informations d\'un compte','Inspect an account','Informations personnelles ; limiter la diffusion','Personal data; redact output'],
['reset user password','Changer le mot de passe d\'un compte','Change an account password','Écriture effective dans l\'authentification','Writes authentication data'],
['reset user email','Changer l\'email du compte','Change account email','Ajout vérifié dans le code 0.9.3.1','Verified 0.9.3.1 addition'],
['set user level','Modifier le niveau d\'un utilisateur','Change user privilege level','Potentiellement élévation de privilèges','Potential privilege escalation'],
]);
sec('Simulateur : utilisateurs','Simulator users');options_table([
['show users [full]','Afficher les utilisateurs connectés','Inspect connected users','full inclut les agents enfants','full includes child agents'],
['kick user <prénom> <nom> [message]','Expulser un utilisateur du simulateur','Disconnect a user from simulator','Affecte immédiatement la session','Immediately affects session'],
['show name <UUID>','Afficher la liaison UUID / nom','Inspect UUID/name mapping','Code UserManagement vérifié','Verified in UserManagement'],
['show names','Afficher les noms connus du module','List known user names','Ne correspond pas à tous les comptes de ROBUST','Not all ROBUST accounts'],
['reset user cache','Effacer le cache du module UserManagement','Clear UserManagement user cache','Ne purge pas tous les autres caches de comptes','Does not clear other account caches'],
['alert <message>','Afficher un avis aux utilisateurs','Show a notice to users','Commande du PDF ; vérifier help','From PDF; verify help'],
['login status','Examiner l\'autorisation des connexions','Inspect login allowance','Commande du PDF ; vérifier disponibilité','From PDF; verify availability'],
['login disable','Bloquer les nouvelles connexions au simulateur','Disable simulator login','Peut gêner les utilisateurs ; confirmer la portée','May affect users; verify scope'],
['login enable','Autoriser les nouvelles connexions','Enable simulator login','Vérifier la configuration réelle','Check actual policy'],
]);
sec('ROBUST : connexion','ROBUST login service');options_table([
['login level <niveau>','Définir le niveau minimum autorisé à se connecter','Set minimum user level for login','Historique PDF ; vérifier aide et droits','Historical PDF; verify help and permissions'],
['login reset','Réinitialiser le niveau de restriction','Reset login restriction','Historique PDF ; vérifier aide','Historical PDF; verify help'],
['login text <message>','Configurer un message de connexion','Configure login message','Historique PDF ; vérifier la syntaxe réelle','Historical PDF; verify actual syntax'],
]);
sec('Références','References');p('Document de départ : PDF de la page officielle « Server Commands/fr », édition du 19 mars 2025 ; indications historiques à recouper. Code OpenSimulator 0.9.3.1 vérifié pour les exemples cités ci-dessous.','Source document: PDF print of official Server Commands/fr page, last edited 19 March 2025; older entries need verification. OpenSimulator 0.9.3.1 source checked for the listed examples.');echo '<ul>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Services/UserAccountService/UserAccountService.cs" target="_blank" rel="noopener">'.e('UserAccountService.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/Application/OpenSim.cs" target="_blank" rel="noopener">'.e('OpenSim.cs').'</a></li>';
echo '<li><a href="https://github.com/Vlad-BloodMoon/opensim/blob/master/OpenSim/Region/CoreModules/Framework/UserManagement/UserManagementModule.cs" target="_blank" rel="noopener">'.e('UserManagementModule.cs').'</a></li>';
echo '<li><a href="https://opensimulator.org/wiki/Server_Commands/fr" target="_blank" rel="noopener">Server Commands / fr</a></li>';echo '</ul>';end_page();
