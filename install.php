<?php

/** @var rex_addon $this */

// Diese Datei ist keine Pflichtdatei mehr.

// SQL-Anweisungen können auch weiterhin über die install.sql ausgeführt werden.
// Empfohlen wird aber die SQL-Anweisungen in der install.php auszuführen
// Siehe auch https://redaxo.org/doku/master/datenbank-tabellen
// Hier wird die Tabelle des Demo-Addons erstellt falls noch nicht vorhanden
rex_sql_table::get(rex::getTable('demo_addon'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('anrede', 'tinyint(1)'))
    ->ensureColumn(new rex_sql_column('vorname', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('name', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('strasse', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('plz', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('ort', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('birthdate', 'date', true))
    ->ensureColumn(new rex_sql_column('status', 'tinyint(1)'))
    ->ensure();

// Abhängigkeiten (PHP-Version, PHP-Extensions, Redaxo-Version, andere Addons/Plugins) sollten in die package.yml eingetragen werden.
// Sie brauchen hier dann nicht mehr überprüft werden!

// Hier können zum Beispiel Konfigurationswerte in der rex_config initialisiert werden.
// Das if-Statement ist notwendig, um bei einem reinstall die Konfiguration nicht zu überschreiben.
if (!$this->hasConfig()) {
    $this->setConfig('url', 'https://friendsofredaxo.github.io/');
}

// Mit einer rex_functional_exception kann die Installation mit einer Fehlermeldung abgebrochen werden.
$somethingIsWrong = false;
if ($somethingIsWrong) {
    throw new rex_functional_exception('Something is wrong');
}

// Alternativ kann ähnlich wie in R4 mit den Properties "install" und "installmsg" die Installation als nicht erfolgreich markiert werden.
// Im Gegensatz zu R4 muss für eine erfolgreiche Installation keine Property mehr gesetzt werden.
if ($somethingIsWrong) {
    $this->setProperty('installmsg', 'Something is wrong');
    $this->setProperty('install', false);
}
