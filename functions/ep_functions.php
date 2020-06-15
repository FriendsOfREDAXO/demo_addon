<?php

/**
 * Include der Extension-Points im Verzeichnis `pages/extensionpoints/`.
 * Das Verzeichnis wird rekursiv durchsucht und php-Dateien includiert.
 *
 * Es wird ein Array mit den Ordnern und Dateien aufgebaut ($_eplist)
 * Das Array wird als AddOn-Property `eplist` für die Auflistung der Extension-Points gespeichert.
 */

if (!function_exists('demo_addon_includeExtensionPoints')) {
    function demo_addon_includeExtensionPoints()
    {
        $epcount = 0;
        $_folder = '';
        $_eplist = [];
        $addon = rex_addon::get('demo_addon');

        // Verzeichnis der EP's
        $epdir = $addon->getPath() . 'pages' . DIRECTORY_SEPARATOR . 'extensionpoints' . DIRECTORY_SEPARATOR;

        // Alle Dateien im EP-Ordner ermitteln
        $files = rex_finder::factory($epdir)->recursive()->sort();

        // Dateien verarbeiten
        // - include der PHP-Dateien
        // - Array für die EP-Auflistung erstellen
        foreach ($files as $file) {
            if ($file->isDir()) {
                $_folder = $file->getFilename();
            } else {
                if ('php' == $file->getExtension()) {
                    ++$epcount;
                    $_eplist[$_folder][basename($file->getFilename(), '.php')] = $file;
                    $addon->includeFile($epdir .  $_folder . DIRECTORY_SEPARATOR  . $file->getFilename());
                }
            }
        }

        // Ausgabe der Anzahl Extension-Points im Logfile
        if (!isset($_SESSION['demo_addon.epinfo'])) {
            $rxmode = (rex::isBackend() && rex::getUser()) ? 'Backend' : 'Frontend';
            demo_addon_logger::log($epcount . ' Extension Points in ' . $epdir . '<br>Mode: ' . $rxmode);
            $_SESSION['demo_addon.epinfo'] = true;
        }

        // Array mit den EP's als AddOn-Property zwischenspeichern, wird bei der EP-Liste `pages/eps.eplist.php` verwendet
        $addon->setProperty('eplist', $_eplist);
    }
}

/*
 * Ausgabe der Extension Point Einträge für die Liste
 */

if (!function_exists('demo_addon_outputEpEntry')) {
    function demo_addon_outputEpEntry($dir, $ep, $epdata = [])
    {
        $addon = rex_addon::get('demo_addon');

        $template = '
<section class="rex-page-section demo-addon-section">
    <div class="panel panel-default">
        <header class="panel-heading collapsed" data-toggle="collapse" data-target="#collapse-{{ep}}" >
            <div class="panel-title">
                {{ep}}
                <i class="fa fa-chevron-down folddown"></i><i class="fa fa-chevron-up foldup"></i>
            </div>
        </header>
        <div id="collapse-{{ep}}" class="panel-collapse collapse">
            <div class="readme">
{{readme}}
            </div>
            <div class="phpcode">
<textarea class="form-control rex-code rex-js-code" rows="15">{{phpcode}}</textarea>
            </div>
        </div>
    </div>
</section>
';

        $path = $epdata->getPath() . DIRECTORY_SEPARATOR . $ep . '.md';
        $languagePath = substr($path, 0, -3) . '.' . rex_i18n::getLanguage() . '.md';
        if (is_readable($languagePath)) {
            $path = $languagePath;
        }

        if (file_exists($path)) {
            $readme = rex_markdown::factory()->parse(rex_file::get($path));
            if ('' == $readme) {
                $readme = '<p>' . $ep . '.md no content!</p>';
            }
        } else {
            $readme = '<p>' . $ep . '.md not found!</p>';
        }

        // PHP-Code des EP's bereitstellen
        $epdir = $addon->getPath() . 'pages' . DIRECTORY_SEPARATOR . 'extensionpoints' . DIRECTORY_SEPARATOR;
        $path = $epdir . $dir . DIRECTORY_SEPARATOR . $ep . '.php';
        $phpcode = rex_escape(rex_file::get($path));

        // Template mit Daten füllen
        $output = str_replace('{{ep}}', $ep, $template);
        $output = str_replace('{{readme}}', $readme, $output);
        $output = str_replace('{{dir}}', $dir, $output);
        $output = str_replace('{{phpcode}}', $phpcode, $output);

        return $output;
    }
}
