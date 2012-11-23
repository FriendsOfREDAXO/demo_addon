<?php

// Diese Datei ist keine Pflichdatei mehr.

// Daten wie Autor, Version, Subpages etc. sollten wenn möglich in der package.yml notiert werden.
// Sie können aber auch weiterhin hier gesetzt werden:
$this->setProperty('author', 'Gregor Harlan');

// Die Datei sollte keine veränderbare Konfigurationen mehr enthalten, um die Updatefähigkeit zu erhalten.
// Stattdessen sollte dafür die rex_config verwendet werden (siehe install.inc.php)

// Klassen und lang-Dateien müssen hier nicht mehr eingebunden werden, sie werden nun automatisch gefunden.


// Addonrechte (permissions) registieren
if (rex::isBackend() && is_object(rex::getUser())) {
  rex_perm::register('dummy[]');
  rex_perm::register('dummy[config]');
}