<?php

rex_extension::register('META_NAVI', static function (rex_extension_point $ep) {
    $content = $ep->getSubject(); // Array mit den Meta Navi Links

    // Aufbereiten für die Ausgabe im Logfile
    $var = rex_escape(var_export($content, true));
    demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());
});
