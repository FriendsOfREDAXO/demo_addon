<?php

rex_extension::register('REX_FORM_SAVED', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    $var = '...';
    demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());
});
