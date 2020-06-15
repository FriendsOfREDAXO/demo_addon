# AddOn-Tabellen

## Demo-Tabelle

Bei der Installation des `demo_addon` wird automatisch die Tabelle `%%demo_addon` angelegt und mit Testdaten gefüllt (siehe `install.php`).
**%%** steht hier für den REDAXO Table Prefix für Datenbanktabellen und ist standardmäßig auf `rex_` eingestellt (table_prefix in der config.yml).

Die Tabellenverwaltung wurde mit den REDAXO-Klassen `rex_list` und `rex_form` umgesetzt.
Die Klasse `rex_form` wird in dem Beispiel durch die Klasse `demo_addon_rex_form` erweitert (`demo_addon_rex_form.php` im lib-Verzeichnis des AddOns). Hier wird die Funktion `preSave()` zum speichern des Feldes Geburtsdatum (`birthdate`) im richtigen Format verwendet.

<a href="?page=demo_addon/tables/updatetable" class="btn btn-primary">zur Tabellenverwaltung</a>

> **Hinweis:** In AddOns und Modulen **immer** die REDAXO-Funktion `rex::getTable()` verwenden!
> Dadurch wird der richtige Tabellen-Prefix zum Tabellen-Namen hinzugefügt.
> Beispiel: `rex::getTable('adressen')` => rex_adressen

## Tabellendefinitionen

AddOn-Eigene Tabellen sollten in der `install.php` mit Hilfe der Klasse `rex_sql_table` angelegt bzw. geändert werden.
Beispiel in der `install.php` dieses AddOns. Versionsabhängige Änderungen am besten in der `update.php` (siehe Kommentare). Löschen der eigenen Tabellen in der `uninstall.php`.

> **Hinweis:** Mit dem AddOn `adminer` kann eine Tabelle definiert werden und danach der PHP-Quellcode für die eigene install.php generiert werden. (Tabelle auswählen und dann auf den Link `rex_sql_table code` klicken)

- [Datenbanktabellen in der REDAXO-Dokumentation](https://redaxo.org/doku/master/datenbank-tabellen)

## Best Practices

- Tabellen mit der Klasse `rex_sql_table` anlegen bzw. updaten
- Für Tabellenzugriffe in AddOns/Templates/Modulen **immer** die REDAXO-Funktion `getTable()` verwenden! Den Tabellen-Namen nicht fest codieren da es sonst bei Updates oder Portierungen Probleme geben kann!
Beispiel: `rex::getTable('adressen')` => rex_adressen
- Eindeutige Tabellen-Namen durch Verwendung des AddOn-Namens. Beispiel: rex_demo_addon, rex_demo_addon_preise usw.
