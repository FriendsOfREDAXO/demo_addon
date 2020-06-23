<?php

rex_extension::register('PAGE_TITLE', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    $title = $ep->getSubject();
    $url = $_SERVER['REQUEST_URI'];

    demo_addon_logger::log('Seitentitel: ' . $title . '<br>URL: ' . $url, $ep->getName());

    // Der Seitentitel kann hier per setSubject() angepasst werden
    //$ep->setSubject($title . ' - ' . $meintext);
});
