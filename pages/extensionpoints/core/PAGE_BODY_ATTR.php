<?php

rex_extension::register('PAGE_BODY_ATTR', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    $attributes = $ep->getSubject();
    $log = '';
    foreach ($attributes as $attr => $values) {
        $log .= $attr . ': ' . implode(' ', $values) . PHP_EOL;
    }
    demo_addon_logger::log('Subject:<br><pre>' . $log . '</pre>', $ep->getName());

    // BODY-Attribute ändern
    //$attributes['id'][] = 'demo-addon'; # zusätzliche Id
    //$attributes['class'][] = 'demo-addon'; # zusätzliche Klasse
    //$ep->setSubject($attributes);
});
