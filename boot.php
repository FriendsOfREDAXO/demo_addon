<?php

// Diese Datei ist keine Pflichdatei mehr.

$addon = rex_addon::get('demo_addon');

// Daten wie Autor, Version, Subpages etc. sollten wenn möglich in der package.yml notiert werden.
// Sie können aber auch weiterhin hier gesetzt werden:
$addon->setProperty('author', 'Friends Of REDAXO');

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

// Assets im Backend einbinden, nur beim demo_addon
if (rex::isBackend() && rex::getUser() && 'demo_addon' == rex_be_controller::getCurrentPagePart(1)) {
    // Die style.css bei allen Pages und Subpages des Addons im Backend einbinden
    rex_view::addCssFile($addon->getAssetsUrl('css/style.css'));

    // Die script.js nur auf der Unterseite `config` des Addons einbinden
    if ('config' == rex_be_controller::getCurrentPagePart(2)) {
        rex_view::addJsFile($addon->getAssetsUrl('js/script.js'), [rex_view::JS_IMMUTABLE => true]);
    }

    // Die eps.js nur auf der Unterseite `eplist` des Addons einbinden
    if ('eps' == rex_be_controller::getCurrentPagePart(2) && 'eplist' == rex_be_controller::getCurrentPagePart(3)) {
        rex_view::addJsFile($addon->getAssetsUrl('js/eps.js'), [rex_view::JS_IMMUTABLE => true]);
    }

    // JavaScript-Variable für das Backend im Head-Bereich setzen (var rex[])
    rex_view::setJsProperty('demo_addon_js', 'JS-Value demo_addon ...');
}
