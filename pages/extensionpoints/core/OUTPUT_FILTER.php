<?php

rex_extension::register('OUTPUT_FILTER', static function (rex_extension_point $ep) {
    // Modus Backend und Frontend evtl. unterscheiden
    if (rex::isBackend() && rex::getUser()) {
        // Ersetzungen im Backend ...
    }
    if (rex::isFrontend()) {
        // Ersetzungen im Frontend ...
    }

    // Modus und URL für die Logfile-Ausgabe
    $rxmode = (rex::isBackend() && rex::getUser()) ? 'Backend' : 'Frontend';
    $url = " - $_SERVER[REQUEST_URI]";

    // Ausgabe der Anzahl Bytes, Modus und URL im Logfile
    demo_addon_logger::log(strlen($ep->getSubject()) . ' Bytes - Mode: ' . $rxmode . '<br>URL: ' . $url, $ep->getName());

    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    // Ersetzung im HTML-Code durchführen und zurückliefern
    $search = '</html>';
    $replace = '</html><!-- OUTPUT_FILTER Demo-AddOn - ' . $rxmode . ' -->';

    // Mit setSubject wird der veränderte HTML-Code zurückgeschrieben
    $ep->setSubject(str_replace($search, $replace, $ep->getSubject()));
});
