# Über das demo_addon

Das `demo_addon` soll den Einstieg in die Addon-Entwicklung erleichtern und dient als Inspiration :)
Der Quellcode (PHP), package.yml und z.B. die .lang-Dateien sind so gut wie möglich dokumentiert und werden von den Friends Of REDAXO geprüft.

Im `demo_addon` werden Lösungswege am praktischen Beispiel und "Best practice" gezeigt, unterstützend zur REDAXO-Dokumentation.

* [REDAXO 5 Dokumentation](https://redaxo.org/doku/master)
* [Aufbau und Struktur von Addons](https://redaxo.org/doku/master/addon-struktur)
* [Package (package.yml)](https://redaxo.org/doku/master/addon-package)

> **Hinweis:** Die Verwendung von REDAXO-Standards hilft Probleme mit den eigenen Addons bei REDAXO-Updates zu vermeiden :)

## Einstellungen

Oft benötigen Addons eigene Einstellungen. Hier werden zwei Methoden für die Umsetzung zum speichern der Addon-Einstellungen gezeigt. Einmal die "klassiche" Methode mit Hilfe von REDAXO-Funktionen und Fragmenten. Und zum anderen die aktuelle Methote mit der Verwendung der Klasse `rex_config_form`.
Hier am besten mal einen Blick in den Quellcode der beiden Dateien `pages/config.rex_config_form.php` und `pages/config.classic_form.php` werfen.

* [Zu den Einstellungen](?page=demo_addon/config/rex_config_form)

## Tabellen

Das `demo_addon` zeigt wie mit REDAXO Standards (rex_sql_table) eine Tabelle erstellt, mit Beispiel-Daten gefüllt wird (rex_sql::addRecord), und bringt die dazugehörige dokumentierte Verwaltungsfunktion (rex_list/rex_form) zu dieser Tabelle mit.

* [Zu den Tabellen](?page=demo_addon/tables/tables)

## Quellcode

Der Quellcode des Addons ist dokumentiert und es lohnt sich einen Blick darauf zu werfen!
z.B.
* package.yml
* boot.php
* install.php
* uninstall.php
* Markdown-Texte wie README.md und README.de.md
* PHP-Dateien im Verzeichnis ./pages/
* Verzeichnis ./lib/

Alles ist natürlich auch in der [REDAXO-Dokumentation](https://redaxo.org/doku/master) zu finden und kann dort detailliert nachgeschlagen werden.
Im Quellcode sind an den entsprechenden Stellen direkte Links auf die REDAXO-Dokumentation vorhanden.

## Extension Points

 [Extension Points](https://redaxo.org/doku/master/extension-points) sind Stellen im REDAXO-Programmcode, an denen eigener Code eingeklinkt und ausgeführt werden kann. Dadurch lässt sich auch das Core-System erweitern und anpassen, ohne den Core selbst zu verändern.

Im Verzeichnis pages/extensionpoints/ gibt es viele Beispiele für Extension Points und wie diese EP's verwendet werden können.

* [Zu den Extension-Points](?page=demo_addon/eps/eps)

## Sonstiges

**TODO**

. Validierungen bei den Einstellungen (klassisch und rex_config_form)
. zusätzlichen Menüpunkt einbinden wenn Addon xy installiert ist (siehe auch https://github.com/redaxo/docs/issues/136)
. Beschreibung und Anwendung Permission-Check rex::getUser()->hasPerm('meinaddon[delete]')
. Tabellenverwaltung aktivieren/deaktivieren von Datensätzen per Ajax
. Hinweise bzw. Verbesserungen gerne als [Issue](https://github.com/FriendsOfREDAXO/demo_addon/issues) auf github.

## Credits

[Contributors auf github](https://github.com/FriendsOfREDAXO/demo_addon/graphs/contributors) und alle sonstigen Helfer!
