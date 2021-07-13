<?php

// Die `update.php` wird ausgeführt, wenn eine Aktualisierung über den Installer erfolgt.
// Die` update.php` wird nicht bei einem manuellen Update ausgeführt.
// Hier können zum Beispiel DB-Tabellen angepasst werden

$addon = rex_addon::get('demo_addon');

// getVersion() liefert die noch aktuell installierte Version
if (rex_version::compare($addon->getVersion(), '1.1', '<')) {
    // Änderungen für Nutzer die von Versionen kleiner 1.1 kommen
}

if (rex_version::compare($addon->getVersion(), '1.2', '<')) {
    // Änderungen für Nutzer die von Versionen kleiner 1.2 kommen
}

// DB-Anpassungen:
// rex_sql_table::get(rex::getTable('demo_addon'))
//     ->ensureColumn(new rex_sql_column('new_column', 'varchar(255)'))
//     ->alter()
// ;

// Update kann abgebrochen werden:
// throw new rex_functional_exception('Fehlermeldung');
