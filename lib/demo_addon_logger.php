<?php

/**
 * Klasse für die Ausgabe der EP-Meldungen im Logfile
 * Diese Klasse sollte bei den Beispielen zu den Extension Points verwendet werden
 * Beispiel: demo_addon_logger::log('Meldungstext', 'EP_NAME');.
 *
 * @author Friends Of REDAXO
 *
 * @package demo_addon
 */

class demo_addon_logger extends rex_log_file
{
    public static $init = false;
    public static $logfile;

    public static function init()
    {
        if (!self::$init) {
            self::$logfile = new rex_log_file(rex_path::log('demo_addon.log'), 4000000);
            self::$init = true;
        }
    }

    public static function log($logstr, $logname = '<strong>* Demo_Addon *</strong>')
    {
        self::init();

        $data = [
            $logname,
            $logstr,
            rex::isFrontend(),
        ];

        self::$logfile->add($data);
    }

    public static function getPath()
    {
        return rex_path::log('demo_addon.log');
    }

    public static function close()
    {
        self::$logfile = null;
        self::$init = false;
    }
}
