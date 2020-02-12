<?php

// Im Addon-Scope können die Properties über $this->getProperty($key) abgefragt werden
// Empfohlen ist aber die Verwendung über rex_addon::get('addonname')->getProperty('varname'))
// siehe https://github.com/redaxo/redaxo/pull/2482

echo '<code>dump($this->getProperty(\'package\'));</code>';
dump($this->getProperty('package'));

echo '<code>dump($this->getProperty(\'version\'));</code>';
dump($this->getProperty('version'));

echo '<code>dump($this->getProperty(\'supportpage\'));</code>';
dump($this->getProperty('supportpage'));

echo '<code>dump($this->getProperty(\'page\'));</code>';
dump($this->getProperty('page'));

// In Templates/Modulen oder anderen Addons können die Porperties
// über rex_addon::get('addonname')->getProperty('varname')) abgefragt werden

echo '<code>dump(rex_addon::get(\'demo_addon\')->getProperty(\'package\'));</code>';
dump(rex_addon::get('demo_addon')->getProperty('package'));

echo '<code>dump(rex_addon::get(\'demo_addon\')->getProperty(\'version\'));</code>';
dump(rex_addon::get('demo_addon')->getProperty('version'));

echo '<code>dump(rex_addon::get(\'demo_addon\')->getProperty(\'supportpage\'));</code>';
dump(rex_addon::get('demo_addon')->getProperty('supportpage'));

echo '<code>dump(rex_addon::get(\'demo_addon\')->getProperty(\'page\'));</code>';
dump(rex_addon::get('demo_addon')->getProperty('page'));

// Alternativ Addon-Objekt zwischenspeichern ...
$addon = rex_addon::get('demo_addon');
$package = $addon->getProperty('package');
$version = $addon->getProperty('version');
