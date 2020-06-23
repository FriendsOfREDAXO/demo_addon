<?php

rex_extension::register('RESPONSE_SHUTDOWN', static function (rex_extension_point $ep) {
    // Modus und URL für die Logfile-Ausgabe
    $rxmode = (rex::isBackend() && rex::getUser()) ? 'Backend' : 'Frontend';
    $url = $_SERVER['REQUEST_URI'];

    // Ausgabe der Anzahl Bytes, Modus und URL im Logfile
    demo_addon_logger::log('Subject: '. strlen($ep->getSubject()) . ' Bytes - Mode: ' . $rxmode . '<br>URL: ' . $url, $ep->getName());
});
