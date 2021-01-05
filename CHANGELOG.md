# Changelog

## Version 1.2.0 // 05.01.2021

Neu

- AddOn-Struktur, Navigation komplett überarbeitet/erweitert
- AddOn-Einstellungen
  - klassisch Einstellungs-Seite erweitert
  - Einstellungen mit rex_config_form
- Demo-Tabelle in install.php und uninstall.php
- Verwaltung der Demo-Tabelle mit rex_list und rex_form
  - Klasse demo_addon_rex_form extends rex_form
- Demo-Seite für die Abfrage von AddOn-Properties hinzugefügt
- EP-Sammlung mit Beispielen im Verzeichnis pages/extensionpoints
- Logfile für Protokollierung von EP's
- Quelltexte usw. kommentiert und verlinkt auf die REDAXO-Dokumentation
- Einbinden von style.css, script.js und eps.js in der boot.php

Änderungen

- REDAXO-Version auf min. 5.10 gesetzt
- PHP-Version auf min. 7.3 gesetzt
- README geändert und Sprachversion .de hinzugefügt
- package.yml erweitert und kommentiert
- de_de.lang-Datei erweitert/angepasst/dokumentiert
- $this-> geändert in $addon->
  - siehe [https://github.com/redaxo/redaxo/pull/2482](https://github.com/redaxo/redaxo/pull/2482)
- documentation-plugin entfernt

## Version 1.1.0 // xx.xx.2018

Neu

- Übersetzung es_es (Danke an @2062nandes)
- CHANGELOG.md hinzugefügt
- CSRF-Schutz Einstellungen-Seite (pages/config.php)

Änderungen

- REDAXO-Version auf 5.5 gesetzt (CSRF-Schutz)
- README.md angepasst
- documentation-plugin
  - Link-Handling optimiert, URL-Änderung jetzt über pushState (vorher window.location), Anpassungen CSS
  - Sprachwähler bei mehreren vorhanden Sprachen der Dokumentationen anzeigen. Position oben rechts in der Navigation.
  - Image-Handling
    - Images in Unterordner assets
    - Intgegration von Images aus dem Unterordner möglich
  - Externe Links in der Navigation möglich
  - Dokumentation Texte angepasst, Beispiel Images in _vorlage.md, Bilder in Unterordner assets

Bugfixes

- keine

## Version 1.0.0 // 28.11.2017

- Erste Veröffentlichung des AddOns
