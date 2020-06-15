# Über das demo_addon

Das `demo_addon` soll den Einstieg in die AddOn-Entwicklung erleichtern und dient als Inspiration :)
Der Quellcode (PHP), package.yml und z.B. die .lang-Dateien sind so gut wie möglich dokumentiert und werden von den Friends Of REDAXO geprüft.

Im `demo_addon` werden Lösungswege am praktischen Beispiel und "Best practice" gezeigt, unterstützend zur REDAXO-Dokumentation.

- [REDAXO 5 Dokumentation](https://redaxo.org/doku/master)
- [Aufbau und Struktur von AddOns](https://redaxo.org/doku/master/addon-struktur)
- [Package (package.yml)](https://redaxo.org/doku/master/addon-package)

> **Hinweis:** Die Verwendung von REDAXO-Standards hilft Probleme mit den eigenen AddOns bei REDAXO-Updates zu vermeiden :)

## Einstellungen

Oft benötigen AddOns eigene Einstellungen. Hier werden zwei Methoden für die Umsetzung zum speichern der AddOn-Einstellungen gezeigt.

Einmal die "klassiche" Methode mit Hilfe von `rex_form`, `rex_list` und Fragmenten.
Und zum anderen die aktuelle Methote mit der Verwendung der Klasse `rex_config_form`.

Hier am besten mal einen Blick in den Quellcode der beiden Dateien `pages/config.rex_config_form.php` und `pages/config.classic_form.php` werfen.

<a href="?page=demo_addon/config/rex_config_form" class="btn btn-primary">Zu den Einstellungen</a>

- [Formulare mit rex_form](https://redaxo.org/doku/master/formulare)
- [Listen mit rex_list](https://redaxo.org/doku/master/listen)
- [Konfigurations-Formulare für AddOns](https://redaxo.org/doku/master/konfiguration_form)

## Tabellen

Das `demo_addon` zeigt wie mit REDAXO Standards (rex_sql_table) eine Tabelle erstellt, mit Beispiel-Daten gefüllt wird (rex_sql::addRecord), und bringt die dazugehörige dokumentierte Verwaltungsfunktion (rex_list/rex_form) zu dieser Tabelle mit.
Am besten einen Blick in die `install.php` und `pages/tables.updatetable.php` riskieren.

<a href="?page=demo_addon/tables/tables" class="btn btn-primary">Zu den Tabellen</a>

- [Datenbanktabellen in der REDAXO-Dokumentation](https://redaxo.org/doku/master/datenbank-tabellen)

## Extension Points

[Extension Points](https://redaxo.org/doku/master/extension-points) sind Stellen im REDAXO-Programmcode, an denen eigener Code eingeklinkt und ausgeführt werden kann. Dadurch lässt sich auch das Core-System erweitern und anpassen, ohne den Core selbst zu verändern.

Im Verzeichnis `pages/extensionpoints/` des Demo-AddOns gibt es viele Beispiele für Extension Points und wie diese EP's verwendet werden können.

<a href="?page=demo_addon/eps/eps" class="btn btn-primary">Zu den Extension Points</a>

- [Extension Points in der REDAXO-Dokumentation](https://www.redaxo.org/doku/master/extension-points)

## Quellcode

Der Quellcode des AddOns ist weitgehend dokumentiert und mit hilfreichen Links versehen. Es lohnt sich einen Blick darauf zu werfen!
z.B.

- package.yml
- boot.php
- install.php
- uninstall.php
- Markdown-Texte wie README.md und README.de.md
- PHP-Dateien im Verzeichnis ./pages/
- Verzeichnisse ./lib/ und ./functions/

Alles ist natürlich auch in der [REDAXO-Dokumentation](https://redaxo.org/doku/master) zu finden und kann dort detailliert nachgeschlagen werden.
Im Quellcode sind an den entsprechenden Stellen direkte Links auf die REDAXO-Dokumentation vorhanden.

## Credits

[Contributors auf github](https://github.com/FriendsOfREDAXO/demo_addon/graphs/contributors) und alle sonstigen Helfer!
