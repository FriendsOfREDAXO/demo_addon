<?php

rex_extension::register('PAGE_HEADER', static function (rex_extension_point $ep) {
    $content = $ep->getSubject(); // Content HEAD-Bereich

    // Ausgabe der Übergabewerte im Logfile
    $var = rex_escape($content);
    demo_addon_logger::log('Subject:<br><pre>    ' . $var . '</pre>', $ep->getName());

    // Hier kann zusätzlicher Code ausgegeben werden, Zeilen sollten mit "\n" abgeschlossen werden
    //$ep->setSubject($content . PHP_EOL . $zusatzContent);
});
