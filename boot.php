<?php

// Diese Datei ist keine Pflichdatei mehr.
// Die `boot.php` wird bei jeder Aktion in REDAXO ausgeführt (Frontend und Backend). Hier können beliebige Befehle ausgeführt werden.
// Dokumentation AddOn Aufbau und Struktur https://redaxo.org/doku/master/addon-struktur

$addon = rex_addon::get('demo_addon');

// Daten wie Autor, Version, Subpages etc. sollten wenn möglich in der `package.yml` notiert werden.
// https://redaxo.org/doku/master/eigenschaften#eigene_properties
// Sie können aber auch weiterhin hier gesetzt werden:
$addon->setProperty('author', 'Friends Of REDAXO');

// Die Datei sollte keine veränderbare Konfigurationen mehr enthalten, um die Updatefähigkeit zu erhalten.
// Stattdessen sollte dafür die `rex_config` verwendet werden (siehe `install.php`).
// Dokumentation Konfiguration https://www.redaxo.org/doku/master/konfiguration

// Klassen und lang-Dateien müssen hier nicht mehr eingebunden werden, sie werden nun automatisch gefunden.

// AddOn-Rechte (permissions) registieren
// Hinweis: In der `de_de.lang`-Datei sind Text-Einträge für das Backend vorhanden (z.B. perm_general_demo_addon[])
if (rex::isBackend() && is_object(rex::getUser())) {
    rex_perm::register('demo_addon[]');
    rex_perm::register('demo_addon[config]');
}

// Assets werden bei der Installation des AddOns in den assets-Ordner kopiert und stehen damit
// öffentlich zur Verfügung. Sie müssen dann allerdings noch eingebunden werden:

// Assets im Backend nur beim `demo_addon` einbinden.
// CSS und JavaScript-Dateien sollten nur im Backend eingebunden werden wenn sie benötigt werden.
// AddOn-Assets https://redaxo.org/doku/master/addon-assets
if (rex::isBackend() && rex::getUser() && 'demo_addon' == rex_be_controller::getCurrentPagePart(1)) {
    // Die `style.css` bei allen Pages und Subpages des AddOns im Backend einbinden
    rex_view::addCssFile($addon->getAssetsUrl('css/style.css'));

    // Die `script.js` bei allen Pages und Subpages des AddOns im Backend einbinden
    rex_view::addJsFile($addon->getAssetsUrl('js/script.js'), [rex_view::JS_IMMUTABLE => true]);

    // Die `eps.js` nur auf der Unterseite `eplist` des AddOns einbinden
    if ('eps' == rex_be_controller::getCurrentPagePart(2) && 'eplist' == rex_be_controller::getCurrentPagePart(3)) {
        rex_view::addJsFile($addon->getAssetsUrl('js/eps.js'), [rex_view::JS_IMMUTABLE => true]);
    }

    // JavaScript-Variable für das Backend im Head-Bereich setzen (var rex[])
    rex_view::setJsProperty('demo_addon_js', 'JS-Value demo_addon ...');
}

// Eigene PHP-Funktionen im Backend und Frontend einbinden
// PHP-Dateien mit eigenen Funktionen sollten im Ordner `functions` abgelegt werden
$addon->includeFile('functions/ep_functions.php');

// Include der Extensionpoint-PHP's im Verzeichnis `pages/extensionpoints/`
demo_addon_includeExtensionPoints();

// Eigene PHP-Funktionen einbinden, nur wenn im Backend eingeloggt
if (rex::isBackend() && rex::getUser()) {
    // Include der AddOn-Eigenen Dateien für das Backend
    //$addon->includeFile('functions/backend_functions.php');
}

// Falls eigene PHP-Funktionen nur für das Frontend benötigt werden, können diese hier eingebunden werden
if (rex::isFrontend()) {
    // Include der AddOn-Eigenen Dateien für das Frontend
    //$addon->includeFile('functions/frontend_functions.php');
}
