<?php

/** @var rex_addon $this */

// Diese Datei ist keine Pflichdatei mehr.

// Daten wie Autor, Version, Subpages etc. sollten wenn möglich in der package.yml notiert werden.
// Sie können aber auch weiterhin hier gesetzt werden:
$this->setProperty('author', 'Friends Of REDAXO');

// Die Datei sollte keine veränderbare Konfigurationen mehr enthalten, um die Updatefähigkeit zu erhalten.
// Stattdessen sollte dafür die rex_config verwendet werden (siehe install.php)

// Klassen und lang-Dateien müssen hier nicht mehr eingebunden werden, sie werden nun automatisch gefunden.

// Addonrechte (permissions) registieren
if (rex::isBackend() && is_object(rex::getUser())) {
    rex_perm::register('demo_addon[]');
    rex_perm::register('demo_addon[config]');
}

// Assets werden bei der Installation des Addons in den assets-Ordner kopiert und stehen damit
// öffentlich zur Verfügung. Sie müssen dann allerdings noch eingebunden werden:

// Assets im Backend einbinden
if (rex::isBackend() && rex::getUser()) {

    // Die style.css überall im Backend einbinden
    // Es wird eine Versionsangabe angehängt, damit nach einem neuen Release des Addons die Datei nicht
    // aus dem Browsercache verwendet, sondern frisch geladen wird
    rex_view::addCssFile($this->getAssetsUrl('css/style.css?v=' . $this->getVersion()));

    // Die script.js nur auf der Unterseite »config« des Addons einbinden
    if (rex_be_controller::getCurrentPagePart(2) == 'config') {
        rex_view::addJsFile($this->getAssetsUrl('js/script.js?v=' . $this->getVersion()));
    }
}