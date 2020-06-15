<?php

// https://redaxo.org/doku/master/eigenschaften
// https://redaxo.org/doku/master/eigenschaften#property-methoden

$addon = rex_addon::get('demo_addon');

// Beschreibung aus `PROPERTIES.md` ausgeben
// Wenn eine Markdown-Datei in der aktuellen Backendsprache vorhanden ist wird diese verwendet.
$path = __DIR__ . DIRECTORY_SEPARATOR . 'PROPERTIES.md';
$languagePath = substr($path, 0, -3) . '.' . rex_i18n::getLanguage() . '.md';
if (is_readable($languagePath)) {
    $path = $languagePath;
}

// Parse der Markdown-Datei und ausgeben mit fragment docs.php
[$toc, $content] = rex_markdown::factory()->parseWithToc(rex_file::get($path));
$fragment = new rex_fragment();
$fragment->setVar('content', $content, false);
$fragment->setVar('toc', $toc, false);
$content = $fragment->parse('core/page/docs.php');

// Ausgabe mit Fragment section
$fragment = new rex_fragment();
$fragment->setVar('title', $addon->i18n('properties_title'), false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');

// Im AddOn-Scope können die Properties über $this->getProperty($key) abgefragt werden
// Empfohlen ist aber die Verwendung über rex_addon::get('addonname')->getProperty('varname'))
// siehe https://github.com/redaxo/redaxo/pull/2482

echo '<code>$this->getProperty(\'package\');</code>';
dump($this->getProperty('package'));

echo '<code>$this->getProperty(\'version\');</code>';
dump($this->getProperty('version'));

echo '<code>$this->getProperty(\'supportpage\');</code>';
dump($this->getProperty('supportpage'));

echo '<code>$this->getProperty(\'page\');</code>';
dump($this->getProperty('page'));

// In Templates/Modulen oder anderen AddOns können die Porperties des demo-AddOns
// über rex_addon::get('addonname')->getProperty('varname')) abgefragt werden

echo '<code>rex_addon::get(\'demo_addon\')->getProperty(\'package\');</code>';
dump(rex_addon::get('demo_addon')->getProperty('package'));

echo '<code>rex_addon::get(\'demo_addon\')->getProperty(\'version\');</code>';
dump(rex_addon::get('demo_addon')->getProperty('version'));

echo '<code>rex_addon::get(\'demo_addon\')->getProperty(\'supportpage\');</code>';
dump(rex_addon::get('demo_addon')->getProperty('supportpage'));

echo '<code>rex_addon::get(\'demo_addon\')->getProperty(\'page\');</code>';
dump(rex_addon::get('demo_addon')->getProperty('page'));

// Alternativ AddOn-Objekt zwischenspeichern ...
$addon = rex_addon::get('demo_addon');
$package = $addon->getProperty('package');
$version = $addon->getProperty('version');

// AddOn-Properties können auch gesetzt werden
//$addon->setProperty('myProperty', 'myValue');
