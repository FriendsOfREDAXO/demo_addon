# Changelog

## Version 1.2.0beta1 // 31.01.2020

Neu

* Addon-Struktur, Navigation komplett überarbeitet/erweitert
* Addon-Einstellungen erweitert
* Addon-Einstellungen mit rex_config_form
* Demo-Tabelle in install.php und uninstall.php
* Verwaltung der Demo-Tabelle mit rex_list und rex_form
* Demo-Seite für die Abfrage von Addon-Properties hinzugefügt

Änderungen

* REDAXO-Version auf 5.8 gesetzt
* PHP-Version auf 7.0 gesetzt
* README geändert und Sprachversion .de hinzugefügt
* package.yml erweitert und kommentiert
* de_de.lang-Datei erweitert/angepasst/dokumentiert
* $this->i18n geändert in $addon->i18n

## Version 1.1.0 // xx.xx.2018

Neu

* Übersetzung es_es (Danke an @2062nandes)
* CHANGELOG.md hinzugefügt
* CSRF-Schutz Einstellungen-Seite (pages/config.php)

Änderungen

* REDAXO-Version auf 5.5 gesetzt (CSRF-Schutz)
* README.md angepasst
* documentation-plugin
  * Link-Handling optimiert, URL-Änderung jetzt über pushState (vorher window.location), Anpassungen CSS
  * Sprachwähler bei mehreren vorhanden Sprachen der Dokumentationen anzeigen. Position oben rechts in der Navigation.
  * Image-Handling
    * Images in Unterordner assets
    * Intgegration von Images aus dem Unterordner möglich
  * Externe Links in der Navigation möglich
  * Dokumentation Texte angepasst, Beispiel Images in _vorlage.md, Bilder in Unterordner assets

Bugfixes

* keine

## Version 1.0.0 // 28.11.2017

* Erste Veröffentlichung des Addons
