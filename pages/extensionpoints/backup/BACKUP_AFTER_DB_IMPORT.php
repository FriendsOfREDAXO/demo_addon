<?php

rex_extension::register('BACKUP_AFTER_DB_IMPORT', static function (rex_extension_point $ep) {
    $subject = $ep->getSubject(); // Subject, hier die Nachricht
    $params = $ep->getParams(); // Array aller EP-Parameter
    $content = $ep->getParam('content'); // Datei-Inhalt des SQL-Imports
    $filename = $ep->getParam('filename'); // Dateiname des SQL-Imports
    $filesize = $ep->getParam('filesize'); // Dateigröße des SQL-Imports
    $logcontent = nl2br(substr($content, 0, 600)) . ' ...'; // gekürzte Ausgabe $content für das Logfile

    demo_addon_logger::log('Subject: ' . $subject . 'Filename: ' . $filename . '<br>Filesize: ' . $filesize . '<br>Content:<br>' . $logcontent, $ep->getName());
});
