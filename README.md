# OpenSimulator Handbook — Encyclopédie OpenSimulator (FR / EN)

**FR —** Encyclopédie communautaire et bilingue pour installer, configurer, administrer et dépanner OpenSimulator : Standalone, ROBUST, Hypergrid, FSAssets et inodes, MySQL/MariaDB, OAR/IAR, LSL/OSSL, WebRTC et restauration d'une grille.

**EN —** Bilingual community handbook for installing, configuring, operating and troubleshooting OpenSimulator: Standalone, ROBUST, Hypergrid, FSAssets and inodes, MySQL/MariaDB, OAR/IAR, LSL/OSSL, WebRTC and grid recovery.

**Projet / Repository :** https://github.com/Vlad-BloodMoon/OpenSim_Handbook

**Démo en ligne / Live demo :** https://bloodmoonpack.com/OpenSim_Handbook/

Explore the complete bilingual handbook online, including installation, FSAssets, ROBUST, troubleshooting and administration guides.

Découvrez l'encyclopédie directement sur le site de démonstration, en français et en anglais.

## Deployment / Installation

1. Back up your existing web directory.
2. Clone or download the `main` branch of **Vlad-BloodMoon/OpenSim_Handbook**.
3. Copy the **contents of this repository root** (PHP pages, `assets/`, `inc/`, `data/`, and `INI.CSV`) into the existing web directory, e.g. `/var/www/BloodMoon/OpenSim_Handbook/`. Do not upload `.github/` or `tests/` to the public web directory.
4. Keep **`INI.CSV` beside `dictionary.php`**; the INI catalog pages require this file.
5. Open **`https://YOUR-DOMAIN/OpenSim_Handbook/index.php`**.
6. If you still have an older `index.html` in the target web directory, **rename it to `index.html.backup`** after saving a backup. Otherwise the folder URL may continue to show the old HTML version depending on your web server.
7. Check these direct URLs: `oar.php`, `iar.php`, `regions.php`, `scripts.php` and `dictionary.php`.

Required layout:
```
OpenSim_Handbook/ (deployed site; repository root)
    index.php
    installation.php
    install-platforms.php
    install-standalone.php
    install-grid.php
    install-first-login.php
    install-checklist.php
    install-logs.php         <- OpenSim / ROBUST log analysis first
    install-network.php
    install-hypergrid.php
    oar.php
    iar.php
    regions.php
    configuration.php
    sections.php            <- browsable alphabetical INI sections
    ini-parameters.php      <- INI references, categorized by source files
    inc/ini-origin.php      <- source-file classifier for INI entries
    console.php
    procedures.php
    troubleshooting.php
    performance.php
    database-admin.php
    robust-services.php
    disaster-recovery.php
    operations-monitoring.php
    fsassets.php
    fsassets-inodes.php
    fsassets-migration.php
    fsassets-backup.php
    fsassets-hot-backup.php
    fsassets-troubleshooting.php
    displaynames.php
    voice.php
    voice-install.php
    voice-config.php
    voice-conferences.php
    voice-troubleshooting.php
    scripts.php
    dictionary.php
    sources.php
    INI.CSV                  <- included in repository root
    inc/site.php
    assets/site.css
    assets/site.js
    data/ossl-functions.json
```
Requires PHP 8+ and a conventional HTTP(S) web server. No database, framework or JS build. Recommended deployment check: PHP syntax validation, HTTP smoke tests for every page in both languages, and confirmation that `INI.CSV` returns HTTP 200.

**Deploy changes to the existing URL:** copying the repository root contents into the site's `/OpenSim_Handbook/` directory preserves existing public bookmarks and links. Do not change the public URL unless you also configure redirects.

## Repository independence and data provenance

The Handbook is independent of the original `Opensim-Variables` fork. The reference file `INI.CSV` is a **committed snapshot**, not generated at PHP runtime. The site reads it directly from the repository root. **`build_ini_csv.py` is intentionally not shipped**: it is not needed to run or deploy the handbook. Updating the snapshot later requires a separately reviewed import/generation process and checking the result against the installed OpenSimulator source version. It may contain settings from optional or older modules and is not a representation of any live grid's active secrets.

The original variables catalogue came from the Outworldz/Opensim-Variables lineage; retain original source attribution and check upstream license terms when redistributing derivatives. This repository contains explanatory material written for the community and is not affiliated with the OpenSimulator project.

## Display Names addon / Module Display Names

The bilingual chapter [`displaynames.php`](displaynames.php) covers architecture, Firestorm compatibility, the simulator module, PHP/MySQL backend, `robust.UserAccounts` read-only SQL access, backend configuration, integration, testing and log-first troubleshooting. The original project and its authoritative installation instructions are hosted at https://github.com/Vlad-BloodMoon/OpenSimulator-DisplayNames . **Security note:** the sample backend's `allow_all_ips=true` is not authentication; evaluate controls on the write endpoints before deploying to untrusted networks.

## Free web utilities / Outils web gratuits

- UUID generator / Générateur UUID : https://bloodmoonpack.com/uuid/
- Timestamp converter / Convertisseur timestamp : https://bloodmoonpack.com/timestamp/

Both are linked in the bilingual [`practical-tools.php`](practical-tools.php) chapter and listed on the home page and in the expandable table of contents. Before changing account creation timestamps directly in SQL, check the real schema, timestamp units and database backups.

## Existing content
- OAR: load/save, assets, merge, terrain/parcels, displacement, rotation, filtering and safeguards.
- IAR: full and no-asset backups, permissions and exclusions, --merge, creator information.
- Regions and varregions: region INI syntax, size rules, ports and placement.
- Console, configuration precedence, complete backup/restore walkthroughs and troubleshooting.
- Performance: measuring CPU, memory, disk, physics, scripts and service bottlenecks.
- Independent self-hosted voice chapter: installation, two-key configuration, matching modules, AdHoc API and troubleshooting. This chapter is based on BloodMoon-Voice v1.0.0 and OpenSimulator v0.9.3.1-webrtc.3.
- OSSL: **266 unique public os-prefixed methods** extracted from `OSSL_Api.cs` (297 declarations including overloads), with code references and wiki search links. Not all source methods necessarily map to callable/safe functions.
- INI section browser: filters the CSV to entries with INI file references and omits unresolved section names; some example-only or optional module entries remain.
- INI parameters: only records with a non-empty IniFiles reference (including examples and optional modules).
- Code-only variables (dictionary.php): only records with an empty IniFiles reference. The two result sets do not overlap.

## Editorial safeguards
The documentation is **not yet exhaustive** and is not affiliated with the OpenSimulator project.
Source verification is from the inspected `Vlad-BloodMoon/opensim` master branch as of November 2026. Confirm commands against your installed version before running them. Never publish passwords or tokens. Treat all archive imports as potentially destructive.

## Primary sources
- https://opensimulator.org/wiki/Main_Page
- https://opensimulator.org/wiki/OpenSim_Archives/fr
- https://opensimulator.org/wiki/Inventory_Archives
- https://opensimulator.org/wiki/Performance
- https://opensimulator.org/wiki/OSSL_Implemented
- https://github.com/Vlad-BloodMoon/opensim

## Contribution policy
Submit documentation corrections with exact source references, target version and a reproducible example. Include both English and French when possible.

## INI provenance / Origine des références

On `ini-parameters.php`, users can filter entries by section and source-file category: OpenSimDefaults.ini, example/prototype/test templates, config-include architecture files, ROBUST files, optional module configs, OpenSim.ini and other INI files. One entry can have several source categories; category totals overlap.

On `sections.php`, each listed parameter also shows its file references and category. These references describe **where the parameter was found in the CSV**, NOT which files are loaded or which parameter value is active on your installation. Consult simulator `config show` and the active ROBUST configuration to establish effective settings. No live grid configuration is accessed by this site.

## Installation learning path (FR / EN)

- `installation.php`: target version, architecture decision, SDK/build and prerequisites. Ubuntu is an example, NOT a requirement.
- `install-platforms.php`: operating-system-specific paths for Windows, Linux distributions and macOS.
- `install-standalone.php`: minimal single-process setup, SQLite default, first region.
- `install-grid.php`: MySQL, ROBUST, GridCommon.ini, distributed regions.
- `install-first-login.php`: create a user, login URI and viewer checks.
- `install-checklist.php`: troubleshooting by symptom.

Reference base: `Vlad-BloodMoon/opensim` `BUILDING.md`, `bin/OpenSim.ini.example`, `bin/config-include/StandaloneCommon.ini.example`, `bin/config-include/GridCommon.ini.example` and `bin/Robust.ini.example`. These are guided example procedures, not claims of tested production deployment. Do not treat the README in the fork as current voice-release documentation: review the dedicated BloodMoon-Voice repository for that.

## Hypergrid and network expansion

- `install-hypergrid.php`: StandaloneHypergrid, GridHypergrid, ROBUST HG public connectors, HomeURI, GatekeeperURI, traveller inventory and cross-grid tests.
- `install-network.php`: reference port roles, public/private separation, region TCP/UDP, DNS/NAT, example UFW firewall and testing.
- Both chapters cite the matching 0.9.3.1 / .NET 8 fork source config files. Wiki primary pages could not be read directly when authored (website timeout); do not assert an exhaustive wiki transcription.

## Log-first troubleshooting

- `install-logs.php` covers OpenSim.log and Robust.log, the actual log4net configuration in `bin/OpenSim.exe.config` and `bin/Robust.exe.config`, live Linux and Windows reading, systemd journals, event correlation, MySQL service logs and safe sharing of extracts.
- Install and general troubleshooting pages now point to log analysis before blind changes or restarts.
- Paths and service unit names are illustrative; inspect each installation's working directory, log4net appender and service manager.

## Structured troubleshooting style

Every incident description in installation checks, archive/region troubleshooting, and WebRTC voice troubleshooting now follows a structured order: symptom and background → relevant logs → likely search terms (not guaranteed exact log messages) → read-only verification → conditional fix. Generic diagnostic markup is implemented in `inc/site.php`.

OpenSim.log and Robust.log are distinct and often both relevant; read `install-logs.php` before modifying configuration. Back up logs and redact sensitive details before sharing.

## FSAssets hot backup and staged migration / Sauvegarde à chaud

The bilingual `fsassets-hot-backup.php` chapter explains low-impact online pre-copy (`nice`/`ionice`/`rsync`), persistent `screen` sessions, `rsync -a --dry-run`, final synchronization under a verified no-write window, SQL/filesystem consistency, retention and actual restoration tests. All shell paths are generic. It distinguishes staged disk migration from a strictly no-pause hot backup requiring coordinated snapshots and explicit consistency verification.

## FSAssets deep-dive / Guide FSAssets approfondi

Five bilingual PHP chapters cover storage architecture and configuration, inode/byte capacity, SQL-to-FS migration and disk relocation, backups/restores, and log-first diagnostics. Source citations include `FSAssetService.cs`, `MySQLFSAssetData.cs`, schema migrations, `HGFSAssetService.cs` and ROBUST templates. Operational examples are not a substitute for testing on a staging grid.

## Independent operations chapters

- MySQL/MariaDB: service database topology, privileges, InnoDB evidence, backups, connectivity and diagnostics. Asset payload mechanics remain in FSAssets.
- ROBUST services: central service reference, public/private ports, service responsibilities and incident tracing. Installation steps remain in install-grid and install-hypergrid.
- Disaster recovery: entire grid inventory, coordinated restore points, restore order and drills. Per-archive OAR/IAR options remain in their dedicated chapters.
- Operations monitoring: observability and alerting, separate from detailed physics/script tuning in performance.php.

## Site navigation (2026-11)

The single bilingual registry `handbook_groups()` in `inc/site.php` drives both the collapsible sidebar and **all** home-page links. Each of the 36 technical pages appears exactly once in one of eight topic groups; `index.php` is always accessible separately. All five FSAssets chapters and the four newest SQL/ROBUST/recovery/monitoring guides are listed as individual entries. The active group opens natively through HTML `<details>` without requiring JavaScript.

## Voice resources / Téléchargements vocaux

Every WebRTC chapter displays the three canonical project links from the shared `voice_resources()` component in `inc/site.php`:

- Voice server and installer (BloodMoon Voice v1.0.0): https://github.com/Vlad-BloodMoon/BloodMoon-Voice/releases/tag/v1.0.0
- OpenSimulator simulator modules (v0.9.3.1-webrtc.3): https://github.com/Vlad-BloodMoon/opensim/releases/tag/v0.9.3.1-webrtc.3
- Ad hoc multi-user conferencing API and documentation: https://github.com/Vlad-BloodMoon/OpenSimulator-AdHocConferences

Release downloads and SHA-256 checksum files are linked directly, and the AdHoc project links to FR/EN installation instructions. Do not use unrelated Janus binaries for this stack.

## Hosting your grid / Héberger sa grille

Ten beginner-friendly bilingual hosting chapters explain home desktops and servers, VPS and VMs, NAT loopback, dynamic IP and CGNAT, firewall rules, TCP/UDP, OVHcloud, AWS EC2 and Lightsail, Proxmox/KVM/LXC, Standalone and distributed ROBUST architectures, monitoring and troubleshooting. All example hosts, IP addresses and file paths are illustrative and not tied to any private grid.

OpenSim documentation: https://opensimulator.dev/wiki/Network_Settings
AWS EC2: https://docs.aws.amazon.com/AWSEC2/latest/UserGuide/
AWS Lightsail: https://docs.aws.amazon.com/lightsail/latest/userguide/
Proxmox VE: https://www.proxmox.com/en/products/proxmox-virtual-environment/features

## Viewers and graphics performance / Viewers et performances graphiques

The bilingual [`firestorm-optimization.php`](firestorm-optimization.php) chapter teaches client-side FPS, draw distance, shadows, avatar complexity, cache and Hypergrid behavior, Ping SIM/Packet Loss, and simulator-versus-network diagnosis. It is general-purpose OpenSimulator guidance, without references to any specific grid or host.

### Favicon OpenSimulator

The whole Handbook uses `assets/opensimulator-favicon.svg`, a small vector adaptation of the public-domain OpenSimulator symbol, registered in the shared `inc/site.php` HTML head. Upload this asset along with the PHP pages to make the icon visible in browser tabs.

## Community contributions / Contributions communautaires

**FR :** Le lien « Proposer une correction / un ajout » dans l'en-tête commun ouvre le sélecteur de demandes GitHub : https://github.com/Vlad-BloodMoon/OpenSim_Handbook/issues/new/choose . Sélectionnez « Correction » pour signaler une erreur ou « Ajout de contenu » pour proposer un guide, un module ou un outil. Les demandes sont examinées avant modification du Handbook ; aucune mise à jour n'est publiée automatiquement. Pour soumettre directement des fichiers corrigés, utilisez une pull request : https://github.com/Vlad-BloodMoon/OpenSim_Handbook/pulls .

**EN:** The shared header link “Suggest a correction / addition” opens GitHub's issue chooser. Select “Correction” to report a mistake, or “New content” to propose a guide, module or tool. Suggestions are reviewed before changes are made; nothing publishes automatically. Contributors familiar with GitHub can instead submit code through pull requests: https://github.com/Vlad-BloodMoon/OpenSim_Handbook/pulls .

## Comprendre Hypergrid / Understanding Hypergrid

Huit nouveaux guides bilingues (FR/EN) expliquent le fonctionnement fédéré de Hypergrid : architecture, identité et services de résidence, téléportations, réseau/DNS/NAT/ports, inventaire/suitcase/assets, amitiés intergrilles et table FriendsStore, sécurité et dépannage. Le guide d'installation existant `install-hypergrid.php` reste disponible.

Eight bilingual guides explain Hypergrid federation, home identity, teleport flow, networking, inventory and assets, distributed friendship records, security and troubleshooting. The existing `install-hypergrid.php` installation guide remains available.
