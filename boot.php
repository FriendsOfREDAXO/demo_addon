<?php

/** @var rex_addon $this */

// Yorm ORM Klasse registrieren
rex_yform_manager_dataset::setModelClass(rex::getTable('product'), Product::class);
rex_yform_manager_dataset::setModelClass(rex::getTable('product_category'), ProductCategory::class);
rex_yform_manager_dataset::setModelClass(rex::getTable('product_rating'), ProductRating::class);

// Addonrechte (permissions) registieren
if (rex::isBackend() && is_object(rex::getUser())) {
    rex_perm::register('demo_yorm[]');
    rex_perm::register('demo_yorm[config]');
}

// Assets werden bei der Installation des Addons in den assets-Ordner kopiert und stehen damit
// öffentlich zur Verfügung. Sie müssen dann allerdings noch eingebunden werden:

// Assets im Backend einbinden
if (rex::isBackend() && rex::getUser()) {

    // Die style.css überall im Backend einbinden
    rex_view::addCssFile($this->getAssetsUrl('css/style.css'));

    // Die script.js nur auf der Unterseite »config« des Addons einbinden
    if (rex_be_controller::getCurrentPagePart(2) == 'main') {
        rex_view::addJsFile($this->getAssetsUrl('js/script.js'));
    }
}
