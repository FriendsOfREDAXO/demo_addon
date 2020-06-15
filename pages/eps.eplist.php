<?php

$addon = rex_addon::get('demo_addon');

$content = '';

// Beschreibung aus `EPLISTHEADER.md` ausgeben
// Wenn eine Markdown-Datei in der aktuellen Backendsprache vorhanden ist wird diese verwendet.
$path = __DIR__ . DIRECTORY_SEPARATOR . 'EPLISTHEADER.md';
$languagePath = substr($path, 0, -3) . '.' . rex_i18n::getLanguage() . '.md';
if (is_readable($languagePath)) {
    $path = $languagePath;
}

// Parse der Markdown-Datei und ausgeben mit fragment docs.php
$content = rex_markdown::factory()->parse(rex_file::get($path));
$fragment = new rex_fragment();
$fragment->setVar('content', $content, false);
$content = $fragment->parse('core/page/docs.php');

// Verzeichnis mit den Extension Points
$epdir = $addon->getPath() . 'pages' . DIRECTORY_SEPARATOR . 'extensionpoints' . DIRECTORY_SEPARATOR;

// Array der Extension Points, wird in der boot.php ermittelt
$_eplist = $addon->getProperty('eplist');

// Ausgabe Toggle-Buttons
$content .= '';

// Ausgabe der Extension Point Liste
foreach ($_eplist as $dir => $eps) {
    // README.md aus jedem Verzeichnis parsen und ausgeben
    $path = $epdir . $dir . DIRECTORY_SEPARATOR . 'README.md';
    $languagePath = substr($path, 0, -3) . '.' . rex_i18n::getLanguage() . '.md';
    if (is_readable($languagePath)) {
        $path = $languagePath;
    }

    if (file_exists($path)) {
        $cont = rex_markdown::factory()->parse(rex_file::get($path));
    } else {
        $cont = rex_markdown::factory()->parse('## ' . $dir . ' (README.md not found!)');
    }
    $content .= $cont;

    // Ausgabe der Extension Points (Beschreibung + Code)
    foreach ($eps as $ep => $epdata) {
        $content .= demo_addon_outputEpEntry($dir, $ep, $epdata);
    }
}

$formElements = [];

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

$fragment = new rex_fragment();
$fragment->setVar('title', $addon->i18n('demo_addon_eplist_title'));
$fragment->setVar('body', $content, false);

$output = $fragment->parse('core/page/section.php');
echo $output;
