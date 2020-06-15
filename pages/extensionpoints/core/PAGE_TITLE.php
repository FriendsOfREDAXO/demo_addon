<?php

rex_extension::register('PAGE_TITLE', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    // Der Seitentitel kann hier per setSubject angepasst werden
    $title = $ep->getSubject();
    demo_addon_logger::log('Seitentitel: ' . $title, $ep->getName());
});
