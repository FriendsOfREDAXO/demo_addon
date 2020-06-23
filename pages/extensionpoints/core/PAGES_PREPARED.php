<?php

rex_extension::register('PAGES_PREPARED', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    // Achtung erzeugt einen ellenlangen Eintrag im Logfile und eine Warning im Systemlog!
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());

    // Pages aus Subject - rex_be_controller::getPages()
    $pages = $ep->getSubject();

    // Modus und Counter für die Logfile-Ausgabe
    $rxmode = (rex::isBackend() && rex::getUser()) ? 'Backend' : 'Frontend';
    $pagecount = count($ep->getSubject());
    $url = $_SERVER['REQUEST_URI'];

    demo_addon_logger::log('Mode: ' . $rxmode . '<br>Count pages: ' . $pagecount . '<br>URL: ' . $url, $ep->getName());

    // Pages verändern und zurückliefern
    //$pages['AddOn-Name']->setHref('MeineUrl');
    //$ep->setSubject($pages);
});
