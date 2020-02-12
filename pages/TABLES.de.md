# Addon-Tabellen

## Demo-Tabelle
Bei der Installation des `demo_addon` wird automatisch die Tabelle `%%demo_addon` angelegt und mit Testdaten gefüllt (siehe `install.php`).
**%%** steht hier für den REDAXO Table Prefix für Datenbanktabellen und ist standardmäßig auf `rex_` eingestellt (table_prefix in der default.config.yml).

Die Tabellenverwaltung wurde mit den REDAXO-Klassen `rex_list` und `rex_form` umgesetzt.

* [zur Tabellenverwaltung](?page=demo_addon/tables/updatetable)

> **Hinweis** In Addons und Modulen **immer** die REDAXO-Funktion `rex::getTable()` verwenden!
> Beispiel: `rex::getTable('adressen')` => rex_adressen

## Tabellendefinitionen

Addon-Eigene Tabellen sollten in der `install.php` mit Hilfe der Klasse `rex_sql_table` angelegt bzw. geändert werden.
Beispiel in der `install.php` dieses Addons. Versionsabhängige Änderungen am besten in der `update.php` (siehe Kommentare). Löschen der eigenen Tabellen in der `uninstall.php`.

> **Hinweis** Mit dem Addon `adminer` kann eine Tabelle definiert werden und danach der PHP-Quellcode für die eigene install.php generiert werden. (Tabelle auswählen und dann auf den Link `rex_sql_table code` klicken)

* [Datenbanktabellen in der REDAXO-Dokumentation](https://redaxo.org/doku/master/datenbank-tabellen)

## Best Practices

* Tabellen mit der Klasse `rex_sql_table` anlegen bzw. updaten
* Für Tabellenzugriffe in Addons/Templates/Modulen **immer** die REDAXO-Funktion `getTable()` verwenden! Den Tabellen-Namen nicht fest codieren da es sonst bei Updates oder Portierungen Probleme geben kann!
Beispiel: `rex::getTable('adressen')` => rex_adressen
* Eindeutige Tabellen-Namen durch Verwendung des Addon-Namens. Beispiel: rex_demo_addon, rex_demo_addon_preise usw.
