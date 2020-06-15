<?php

rex_extension::register('BACKUP_AFTER_FILE_EXPORT', static function (rex_extension_point $ep) {
    $tar = $ep->getSubject(); // Subject, hier ein Objekt der Klasse rex_backup_tar
    demo_addon_logger::log('Datei-Backup wurde erstellt. Keine Parameter!', $ep->getName());
});
