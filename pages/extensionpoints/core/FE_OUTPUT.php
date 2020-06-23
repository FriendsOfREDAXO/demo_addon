<?php

rex_extension::register('FE_OUTPUT', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //(demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    $content = $ep->getSubject();
    $url = " - $_SERVER[REQUEST_URI]";

    demo_addon_logger::log('Subject: ' . strlen($content) . ' Bytes<br>URL: ' . $url, $ep->getName());
});
