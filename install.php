<?php

// Diese Datei ist keine Pflichtdatei mehr.
// Wird automatisch bei der Installation ausgeführt
// (z.B. Anlegen von Datenbanken, Installation von Modulen, bestimmte Prüfungen, Festlegen erster Konfigurationswerte)

$addon = rex_addon::get('demo_addon');

// SQL-Anweisungen können auch weiterhin über die `install.sql` ausgeführt werden.
// Empfohlen wird aber die SQL-Anweisungen in der `install.php` mit der Klasse `rex_sql_table` auszuführen.
// Siehe auch https://redaxo.org/doku/master/datenbank-tabellen

// Hier wird die Beispiel-Tabelle `rex_demo_addon` des Demo-AddOns erstellt falls noch nicht vorhanden.
// Hinweis: rex::getTable() erweitert den Tabellennamen um den Tabellen-Prefix aus der `config.yml`
// Hinweis: rex::getTablePrefix() liefert den Tabellen-Prefix aus der `config.yml`, https://redaxo.org/doku/master/eigenschaften#get-table-prefix
rex_sql_table::get(rex::getTable('demo_addon'))
    ->ensurePrimaryIdColumn()
    ->ensureColumn(new rex_sql_column('anrede', 'tinyint(1)', true, 1))
    ->ensureColumn(new rex_sql_column('vorname', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('name', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('strasse', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('plz', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('ort', 'varchar(60)', true))
    ->ensureColumn(new rex_sql_column('birthdate', 'date', true))
    ->ensureColumn(new rex_sql_column('status', 'tinyint(1)', true, 1))
    ->ensure();

// Bei AddOn-Installation/Reinstallation folgende Beispiel-Daten importieren
$demodata = [
    ['id' => 1, 'anrede' => 1, 'vorname' => 'Max', 'name' => 'Muster', 'strasse' => 'Schönstr. 1', 'plz' => '81333', 'ort' => 'München', 'birthdate' => '1966-01-01', 'status' => 1],
    ['id' => 2, 'anrede' => 1, 'vorname' => 'Mario', 'name' => 'Neumann', 'strasse' => 'Waldweg 11a', 'plz' => '84405', 'ort' => 'Dorfen', 'birthdate' => '1968-06-06', 'status' => 1],
    ['id' => 3, 'anrede' => 1, 'vorname' => 'Fredl', 'name' => 'Fesl', 'strasse' => 'Holzweg 33', 'plz' => '94227', 'ort' => 'Zwiesel', 'birthdate' => '1965-08-26', 'status' => 1],
    ['id' => 4, 'anrede' => 2, 'vorname' => 'Monika', 'name' => 'Gruber', 'strasse' => 'Schnattergasse 1', 'plz' => '94469', 'ort' => 'Deggendorf', 'birthdate' => '1970-04-01', 'status' => 1],
    ['id' => 5, 'anrede' => 1, 'vorname' => 'Helmut', 'name' => 'Schleich', 'strasse' => 'Birkenweg 36', 'plz' => '94469', 'ort' => 'Deggendorf', 'birthdate' => '1970-04-01', 'status' => 1],
    ['id' => 6, 'anrede' => 2, 'vorname' => 'Lisa', 'name' => 'Fitz', 'strasse' => 'Deggendorfer Straße 33', 'plz' => '82152', 'ort' => 'Krailling', 'birthdate' => '1951-09-15', 'status' => 1],
    ['id' => 7, 'anrede' => 1, 'vorname' => 'Donald', 'name' => 'Duck', 'strasse' => 'Hauptstraße 1', 'plz' => '88888', 'ort' => 'Entenhausen', 'birthdate' => '1934-06-09', 'status' => 1],
];

$sql = rex_sql::factory();
$sql->setTable(rex::getTable('demo_addon'));

foreach ($demodata as $row) {
    $sql->addRecord(static function (rex_sql $record) use ($row) {
        $record
            ->setValues($row);
    });
}
$sql->insertOrUpdate();

// Abhängigkeiten (PHP-Version, PHP-Extensions, Redaxo-Version, andere AddOns/Plugins) sollten in die `package.yml` eingetragen werden.
// Sie brauchen hier dann nicht mehr überprüft werden!

// Hier können zum Beispiel Konfigurationswerte in der `rex_config` initialisiert werden.
// Dokumentation Konfiguration https://www.redaxo.org/doku/master/konfiguration
// Das if-Statement ist notwendig, um bei einem reinstall die Konfiguration nicht zu überschreiben, oder bei Erstinstallation Standardwerte zu setzen.
if (!$addon->hasConfig()) {
    $addon->setConfig('url', 'https://friendsofredaxo.github.io/');
    $addon->setConfig('text', 'Beispieltext ...');
}

// Mit einer `rex_functional_exception` kann die Installation mit einer Fehlermeldung abgebrochen werden.
$somethingIsWrong = false;
if ($somethingIsWrong) {
    throw new rex_functional_exception('Something is wrong');
}

// Alternativ kann ähnlich wie in R4 mit den Properties `install` und `installmsg` die Installation als nicht erfolgreich markiert werden.
// Im Gegensatz zu R4 muss für eine erfolgreiche Installation keine Property mehr gesetzt werden.
if ($somethingIsWrong) {
    $addon->setProperty('installmsg', 'Something is wrong');
    $addon->setProperty('install', false);
}
