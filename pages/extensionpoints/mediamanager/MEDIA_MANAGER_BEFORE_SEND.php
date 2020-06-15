<?php

rex_extension::register('MEDIA_MANAGER_BEFORE_SEND', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    $var = rex_escape(var_export($ep, true));
    demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());
});
