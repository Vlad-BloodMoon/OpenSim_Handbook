<?php
declare(strict_types=1);
require_once __DIR__.'/inc/site.php';
begin_page('Outils pratiques pour OpenSimulator','Practical tools for OpenSimulator',
'Outils web gratuits pour générer des UUID et convertir les dates utilisées dans les bases OpenSimulator.',
'Free web tools for generating UUIDs and converting dates used in OpenSimulator databases.');

sec('Générateur UUID','UUID generator');
p('Génère des identifiants UUID à utiliser quand une application ou un développement OpenSimulator demande un identifiant unique. Avant d’enregistrer un UUID dans une base, vérifie les contraintes et les références entre tables.','Generate UUID identifiers when an OpenSimulator application or development task needs a unique identifier. Before inserting a UUID into a database, verify schema constraints and relationships between tables.');
echo '<p><a class="download-link" href="https://bloodmoonpack.com/uuid/" target="_blank" rel="noopener">'.e(t('Ouvrir le générateur UUID','Open UUID generator')).'</a></p>';
echo '<p><code>https://bloodmoonpack.com/uuid/</code></p>';

sec('Convertisseur de timestamps','Timestamp converter');
p('Convertit les valeurs temporelles en dates lisibles et inversement. Il peut aider à interpréter ou préparer une valeur de date dans une base OpenSimulator, notamment pour les champs utilisés pour la date de création d’un avatar, selon le schéma réellement installé.','Convert timestamp values to readable dates and back. This can help inspect or prepare date values in OpenSimulator databases, including fields used for avatar account creation dates, depending on the database schema in use.');
echo '<p><a class="download-link" href="https://bloodmoonpack.com/timestamp/" target="_blank" rel="noopener">'.e(t('Ouvrir le convertisseur timestamp','Open timestamp converter')).'</a></p>';
echo '<p><code>https://bloodmoonpack.com/timestamp/</code></p>';

sec('Attention avant toute modification SQL','Precautions before making SQL changes');
callout('Un timestamp Unix est généralement exprimé en secondes depuis le 1er janvier 1970 à 00:00 UTC ; certaines applications utilisent des millisecondes. Vérifiez le type de la colonne et sa signification avant toute modification. Ne modifie jamais une date de création en production sans sauvegarde, sans identifier la table et la colonne concernées et sans vérifier les effets sur les services.','Unix timestamps are generally expressed as seconds since 1970-01-01 00:00 UTC; some applications use milliseconds. Verify the column type and meaning before modifying any value. Never change a production account creation date without a backup, identifying the exact table and column, and reviewing service impact.');
p('Un champ affiché comme « date de naissance » dans un viewer ne correspond pas nécessairement à une date de naissance civile : dans OpenSimulator, il peut représenter la date de création du compte. Utilisez le format et le fuseau horaire attendus par votre installation.','A viewer field described as an avatar’s “birthday” does not necessarily represent a person’s real birth date: in OpenSimulator it may refer to account creation. Use the value and time zone expected by your installation.');

sec('Autres guides liés','Related guides');
echo '<p><a href="database-admin.php?lang='.e($lang).'">'.e(t('Administrer MySQL et MariaDB','MySQL and MariaDB administration')).'</a> · <a href="scripts.php?lang='.e($lang).'">'.e(t('Référence LSL et OSSL','LSL and OSSL reference')).'</a></p>';
end_page();
