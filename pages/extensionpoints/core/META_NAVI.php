<?php

rex_extension::register('META_NAVI', static function (rex_extension_point $ep) {
    $content = $ep->getSubject(); // Array mit den Meta Navi Links

    // Aufbereiten für die Ausgabe im Logfile
    $var = rex_escape(var_export($content, true));
    demo_addon_logger::log('Subject: <pre>' . $var . '</pre>', $ep->getName());

    // Zusätzlichen Link in der Meta-Navi einfügen
    //$content[] = '<li><a href="#"><i class="rex-icon rex-icon-view"></i> Neuer Link</a></li>'; # Link am Ende anhängen
    //array_unshift($content, '<li><a href="#"><i class="rex-icon rex-icon-view"></i> Neuer Link</a></li>'); # Link vorne einfügen
    //$ep->setSubject($content);
});
