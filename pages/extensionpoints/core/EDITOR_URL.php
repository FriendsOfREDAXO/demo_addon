<?php

rex_extension::register('EDITOR_URL', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    $file = $ep->getParam('file');
    $line = $ep->getParam('line');
    demo_addon_logger::log('file: ' . $file . '<br>line: ' . $line, $ep->getName());

    // Die Url kann in diesem Fall mit return geändert werden
    // return $meineurl;
});
