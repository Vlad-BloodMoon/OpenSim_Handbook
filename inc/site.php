<?php
declare(strict_types=1);
$lang = (($_GET['lang']??'fr')==='en')?'en':'fr';
$page=basename($_SERVER['SCRIPT_NAME'],'.php');
function t($fr,$en){global $lang;return $lang==='fr'?$fr:$en;}
function e($s){return htmlspecialchars((string)$s,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
function sec($fr,$en){echo '<h2>'.e(t($fr,$en)).'</h2>';}
function p($fr,$en){echo '<p>'.e(t($fr,$en)).'</p>';}
function callout($fr,$en){echo '<div class="callout">'.e(t($fr,$en)).'</div>';}
function sample($code,$fr,$en){echo '<section class="sample"><p>'.e(t($fr,$en)).'</p><pre>'.e($code).'</pre><button class="copy" data-code="'.e($code).'">'.e(t('Copier','Copy')).'</button></section>';}
function diagnostic_steps(array $d): void {
    $fields=[
      'logs'=>['Journaux à examiner','Logs to examine'],
      'search'=>['Messages à rechercher (indices, pas erreurs garanties)','Messages to search (clues, not guaranteed errors)'],
      'verify'=>['Vérifications avant de modifier','Checks before changing anything'],
      'fix'=>['Correction possible après confirmation','Possible fix after confirmation']
    ];
    echo '<div class="diagnostic-steps">';
    foreach($fields as $key=>$labels){
      if(!isset($d[$key])||!is_array($d[$key])||count($d[$key])<2)continue;
      echo '<p><strong>'.e(t($labels[0],$labels[1])).' :</strong> '.e(t($d[$key][0],$d[$key][1])).'</p>';
    }
    echo '</div>';
}
function voice_resources(): void {
    $items=[
        [
          'BloodMoon Voice — serveur vocal','BloodMoon Voice — voice server',
          'Release v1.0.0 et installateur','Release v1.0.0 and installer',
          'https://github.com/Vlad-BloodMoon/BloodMoon-Voice/releases/tag/v1.0.0',
          'https://github.com/Vlad-BloodMoon/BloodMoon-Voice/releases/download/v1.0.0/BloodMoon-Voice-installer-v1.0.0.tar.gz',
          'https://github.com/Vlad-BloodMoon/BloodMoon-Voice/releases/download/v1.0.0/BloodMoon-Voice-installer-v1.0.0.tar.gz.sha256'
        ],
        [
          'Modules WebRTC OpenSimulator','OpenSimulator WebRTC modules',
          'Release v0.9.3.1-webrtc.3, ZIP DLL/PDB','Release v0.9.3.1-webrtc.3, DLL/PDB ZIP',
          'https://github.com/Vlad-BloodMoon/opensim/releases/tag/v0.9.3.1-webrtc.3',
          'https://github.com/Vlad-BloodMoon/opensim/releases/download/v0.9.3.1-webrtc.3/WebRTC_Modules_BloodMoon_0.9.3.1-webrtc.3.zip',
          'https://github.com/Vlad-BloodMoon/opensim/releases/download/v0.9.3.1-webrtc.3/WebRTC_Modules_BloodMoon_0.9.3.1-webrtc.3.zip.sha256'
        ],
        [
          'OpenSimulator AdHoc Conferences','OpenSimulator AdHoc Conferences',
          'Dépôt PHP/MySQL et guide d’installation','PHP/MySQL source and installation guide',
          'https://github.com/Vlad-BloodMoon/OpenSimulator-AdHocConferences',
          'https://github.com/Vlad-BloodMoon/OpenSimulator-AdHocConferences/blob/main/docs/INSTALLATION.fr.md',
          'https://github.com/Vlad-BloodMoon/OpenSimulator-AdHocConferences/blob/main/docs/INSTALLATION.md'
        ]
    ];
    echo '<section class="download-panel voice-resources">';
    echo '<h2>'.e(t('Dépôts et téléchargements officiels','Official repositories and downloads')).'</h2>';
    echo '<p>'.e(t('Trois composants distincts : serveur vocal, modules simulateur, et conférences ad hoc optionnelles. Choisis les versions compatibles avec ton installation.','Three distinct components: voice server, simulator modules, and optional ad hoc conferences. Use versions compatible with your installation.')).'</p>';
    echo '<div class="voice-resource-list">';
    foreach($items as $i=>$item){
        echo '<div class="voice-resource">';
        echo '<strong>'.e(t($item[0],$item[1])).'</strong>';
        echo '<span>'.e(t($item[2],$item[3])).'</span>';
        echo '<div class="voice-resource-links">';
        echo '<a href="'.e($item[4]).'" target="_blank" rel="noopener">'.e(t('Dépôt / release','Repository / release')).'</a>';
        echo '<a href="'.e($item[5]).'" target="_blank" rel="noopener">'.e($i===2?t('Installation FR','Installation FR'):t('Télécharger','Download')).'</a>';
        echo '<a href="'.e($item[6]).'" target="_blank" rel="noopener">'.e($i===2?t('Installation EN','Installation EN'):t('SHA-256','SHA-256')).'</a>';
        echo '</div></div>';
    }
    echo '</div>';
    echo '</section>';
}
function subheading($fr,$en){echo '<h3>'.e(t($fr,$en)).'</h3>';}
function options_table($rows){echo '<div class="overflow"><table><thead><tr><th>'.e(t('Option','Option')).'</th><th>'.e(t('Signification','Meaning')).'</th><th>'.e(t('Attention','Caution')).'</th></tr></thead><tbody>';foreach($rows as $r)echo '<tr><td><code>'.e($r[0]).'</code></td><td>'.e(t($r[1],$r[2])).'</td><td>'.e(t($r[3],$r[4])).'</td></tr>';echo '</tbody></table></div>';}
function handbook_groups(): array {
return [
['start','Installation et premiers pas','Installation and getting started',[
['installation','Présentation','Overview'],
['install-platforms','Windows, Linux et macOS','Windows, Linux and macOS'],
['install-standalone','Installer Standalone','Install Standalone'],
['install-grid','Installer une grille ROBUST','Install ROBUST grid'],
['install-first-login','Première connexion','First login'],
['install-network','Ports et réseau','Ports and networking'],
['install-hypergrid','Hypergrid','Hypergrid'],
]],
['hosting','Héberger sa grille','Hosting your grid',[
['hosting-choose','Choisir son hébergement','Choose your hosting'],
['hosting-home','Héberger chez soi','Host at home'],
['hosting-router','Box, NAT et loopback','Router, NAT and loopback'],
['hosting-firewall','Ports et pare-feu','Ports and firewall'],
['hosting-providers','VPS, AWS et serveurs dédiés','VPS, AWS and dedicated hosts'],
['hosting-proxmox','Virtualisation et Proxmox','Virtualization and Proxmox'],
['hosting-architecture','Standalone, ROBUST et régions','Standalone, ROBUST and regions'],
['hosting-examples','Exemples d\'architectures','Hosting examples'],
['hosting-monitoring','Supervision et sauvegardes','Monitoring and backups'],
['hosting-troubleshooting','Dépannage réseau et hébergement','Hosting and network troubleshooting'],
]],
['config','Configuration et régions','Configuration and regions',[
['configuration','Comprendre les fichiers INI','Understanding INI files'],
['sections','Sections INI','INI sections'],
['ini-parameters','Paramètres INI','INI parameters'],
['dictionary','Variables hors INI','Non-INI variables'],
['regions','Régions et varregions','Regions and varregions'],
['console','Console et commandes','Console and commands'],
]],
['services','ROBUST et bases de données','ROBUST and databases',[
['robust-services','Services centraux ROBUST','ROBUST central services'],
['database-admin','MySQL et MariaDB','MySQL and MariaDB'],
]],
['displaynames-addon','Module Display Names','Display Names module',[
['displaynames','Présentation, installation et dépannage','Overview, installation and troubleshooting'],
]],
['storage','FSAssets : stockage','FSAssets: storage',[
['fsassets','Architecture et configuration','Architecture and configuration'],
['fsassets-inodes','Inodes et performances','Inodes and performance'],
['fsassets-migration','Migration et déplacement','Migration and relocation'],
['fsassets-backup','Sauvegarde et restauration','Backup and restore'],
['fsassets-hot-backup','Sauvegarde à chaud et rsync','Hot backups and rsync'],
['fsassets-troubleshooting','Dépannage FSAssets','FSAssets troubleshooting'],
]],
['archives','Archives et restauration','Archives and restoration',[
['oar','Archives OAR','OAR archives'],
['iar','Archives IAR','IAR archives'],
['procedures','Procédures complètes','Full procedures'],
['disaster-recovery','Reprise après sinistre','Disaster recovery'],
]],
['ops','Administration et performances','Operations and performance',[
['operations-monitoring','Supervision quotidienne','Daily monitoring'],
['performance','Performances détaillées','Performance tuning'],
]],
['viewers','Viewers et performances graphiques','Viewers and graphics performance',[
['firestorm-optimization','Comprendre le lag et optimiser Firestorm','Understand lag and optimize Firestorm'],
]],
['voice','Voix WebRTC','WebRTC voice',[
['voice','Présentation','Overview'],
['voice-install','Installation','Installation'],
['voice-config','Configuration','Configuration'],
['voice-conferences','Conférences','Conferences'],
['voice-troubleshooting','Dépannage vocal','Voice troubleshooting'],
]],
['tools','Outils pratiques','Practical tools',[
['practical-tools','Générateur UUID et convertisseur timestamp','UUID generator and timestamp converter'],
]],
['help','Dépannage et références','Troubleshooting and references',[
['install-logs','Lire les logs','Read logs'],
['install-checklist','Dépannage d\'installation','Installation troubleshooting'],
['troubleshooting','Dépannage régions et archives','Region and archive troubleshooting'],
['scripts','LSL / OSSL','LSL / OSSL'],
['sources','Sources et références','Sources and references'],
]],
];
}
function begin_page($fr,$en,$frsub,$ensub){global $page,$lang;
$groups=handbook_groups();
echo '<!doctype html><html lang="'.e($lang).'"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>'.e(t($fr,$en)).' | OpenSimulator Handbook</title><meta name="description" content="OpenSimulator handbook: INI, OAR, IAR, regions, performance, LSL and OSSL in French and English."><link rel="icon" type="image/svg+xml" href="assets/opensimulator-favicon.svg"><link rel="stylesheet" href="assets/site.css"></head><body><header class="top"><div class="top-inner"><a class="logo" href="index.php?lang='.e($lang).'">OpenSimulator <strong>Handbook</strong><small>'.e(t('Encyclopédie communautaire','Community handbook')).'</small></a><div class="lang"><a class="'.($lang==='fr'?'active':'').'" href="'.e($page).'.php?lang=fr">FR</a><a class="'.($lang==='en'?'active':'').'" href="'.e($page).'.php?lang=en">EN</a></div></div></header><div class="layout"><aside><strong class="sidehead">'.e(t('SOMMAIRE','CONTENTS')).'</strong><nav>';
echo '<a class="sidebar-home'.($page==='index'?' selected':'').'" href="index.php?lang='.e($lang).'">'.e(t('Accueil · toutes les pages','Home · all pages')).'</a>';
foreach($groups as $g){
 $isActive=false;
 foreach($g[3] as $entry)if($entry[0]===$page){$isActive=true;break;}
 echo '<details class="sidebar-group"'.($isActive?' open':'').'><summary>'.e(t($g[1],$g[2])).'<span class="sidebar-count">'.count($g[3]).'</span></summary><div class="sidebar-links">';
 foreach($g[3] as $entry)echo '<a'.($page===$entry[0]?' class="selected" aria-current="page"':'').' href="'.e($entry[0]).'.php?lang='.e($lang).'">'.e(t($entry[1],$entry[2])).'</a>';
 echo '</div></details>';
}
echo '</nav></aside><main><div class="hero"><span class="overline">OpenSimulator · '.strtoupper(e($lang)).'</span><h1>'.e(t($fr,$en)).'</h1><p>'.e(t($frsub,$ensub)).'</p></div><div class="body">';
}
function end_page(){echo '</div><footer>OpenSimulator Handbook · <a href="https://opensimulator.org/wiki/Main_Page">OpenSimulator Wiki</a> · <a href="https://github.com/Vlad-BloodMoon/opensim">OpenSimulator source</a><p>'.e(t('Documentation communautaire non officielle. Tester les restaurations et vérifier les options selon la version.','Unofficial community documentation. Test restores and verify options for your version.')).'</p></footer></main></div><script src="assets/site.js"></script></body></html>';}
