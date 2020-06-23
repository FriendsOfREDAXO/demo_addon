<?php

rex_extension::register('PAGE_CHECKED', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    // Achtung erzeugt einen ellenlangen Eintrag im Logfile und eine Warning im Systemlog!
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    // Modus und Counter für die Logfile-Ausgabe
    $rxmode = (rex::isBackend() && rex::getUser()) ? 'Backend' : 'Frontend';
    $pages = count($ep->getParam('pages')); // rex_be_controller::getPages()
    $page = $ep->getSubject();

    demo_addon_logger::log('Mode: ' . $rxmode . '<br>Count pages: ' . $pages . '<br>Page: ' . $page, $ep->getName());
});
