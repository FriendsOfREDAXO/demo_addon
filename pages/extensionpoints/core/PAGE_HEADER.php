<?php

rex_extension::register('PAGE_HEADER', static function (rex_extension_point $ep) {
    $content = $ep->getSubject(); // Array mit den Meta Navi Links

    // Ausgabe der Übergabewerte im Logfile
    $var = nl2br(rex_escape($content));
    demo_addon_logger::log('PAGE_HEADER Subject:<br>' . $var, $ep->getName());
});
