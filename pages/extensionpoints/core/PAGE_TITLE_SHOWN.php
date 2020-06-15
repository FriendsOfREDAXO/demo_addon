<?php

rex_extension::register('PAGE_TITLE_SHOWN', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    demo_addon_logger::log('Keine Übergabewerte!', $ep->getName());
});
