<?php

rex_extension::register('BACKUP_BEFORE_FILE_IMPORT', static function (rex_extension_point $ep) {
    $tar = $ep->getSubject(); // Subject, hier ein Objekt der Klasse rex_backup_tar
    demo_addon_logger::log('Datei-Backup wird importiert. Keine Parameter!', $ep->getName());
});
