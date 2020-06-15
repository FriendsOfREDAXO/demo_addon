<?php

rex_extension::register('BACKUP_AFTER_DB_EXPORT', static function (rex_extension_point $ep) {
    // Ausgabe der Übergabewerte im Logfile
    //$var = rex_escape(var_export($ep, true));
    //demo_addon_logger::log('<pre>' . $var . '</pre>', $ep->getName());
    demo_addon_logger::log('Datenbank-Backup wurde erstellt. Keine Übergabewerte!', $ep->getName());
});
