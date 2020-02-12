<?php

// Klassen im Verzeichnis ./lib/ eines Addons werden durch den Autoloader geladen

// Klasse für die Ausgabe der EP-Meldungen im REDAXO-Logfile
// Diese Klasse sollte bei den Beispielen zu den Extension Points verwendet werden
// demo_addon_logger::logText('Meldungstext');

class demo_addon_logger extends rex_logger
{
    public static function logText($logstr)
    {
        self::logError(E_NOTICE, $logstr, 'demo_addon', 1);
    }
}
