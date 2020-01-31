# Über das demo_addon

Das `demo_addon` soll den Einstieg in die Addon-Entwicklung erleichtern und dient als Inspiration :)
Der Quellcode (PHP), package.yml und z.B. die .lang-Dateien sind so gut wie möglich dokumentiert und werden vom REDAXO-Team geprüft.

Im `demo_addon` werden Lösungswege am praktischen Beispiel und "Best practice" gezeigt, unterstützend zur REDAXO-Dokumentation.

* [REDAXO 5 Dokumentation](https://redaxo.org/doku/master)
* [Aufbau und Struktur von Addons](https://redaxo.org/doku/master/addon-struktur)
* [Package (package.yml)](https://redaxo.org/doku/master/addon-package)

## Einstellungen

Oft benötigen Addons eigene Einstellungen. Hier werden zwei Methoden für die Umsetzung zum speichern der Addon-Einstellungen gezeigt. Einmal die "klassiche" Methode mit Hilfe von REDAXO-Funktionen und Fragmenten. Und zum anderen die aktuelle Methote mit der Verwendung der Klasse `rex_config_form`.
Hier am besten mal einen Blick in den Quellcode der beiden Dateien `config.rex_config_form.php` und `config.classic_form.php` werfen.

* [Zu den Einstellungen](?page=demo_addon/config/rex_config_form)

## Tabellen

TODO
. Beschreibungsseite Tabellen in TABLES.md
. Tabellenverwaltung mit rex_list/rex_form, Adressverwaltung, Cusotm-Format für z.B. Geburtsdatum
. YForm einbinden im Addon?

* [Zu den Tabellen](?page=demo_addon/tables/tables)

## Extension-Points

TODO
. Beschreibungsseite Extension-Points in EXTENSIONPOINTS.md
. Beispiele und Übersicht der Extension-Poits
. Weiterverarbeitung der EP Parameter
. Ausgabe der EP's z.B. im Systemlog

* [Zu den Extension-Points](?page=demo_addon/eps/eps)

## Quelltexte

TODO
. Beschreibung in die Quelltexte des demo_addons zu schauen!

## Sonstiges

TODO
. install.php und Anlegen von Tabellen mit ensure usw.
. uninstall.php
. zusätzlichen Menüpunkt einbinden wenn Addon xy installiert ist
. Beschreibung und Anwendung Permission-Check
