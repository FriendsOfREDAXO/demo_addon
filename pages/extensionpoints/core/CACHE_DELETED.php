<?php

rex_extension::register('CACHE_DELETED', static function (rex_extension_point $ep) {
    // Meldung im Logfile ausgeben
    // Mit setSubject kann die Meldung geändert werden
    $message = $ep->getSubject();
    demo_addon_logger::log('Subject: ' . $message, $ep->getName());
});
