<?php

$content = 'Allgemeine Demo-Addon-Seite';

$fragment = new rex_fragment();
$fragment->setVar('title', 'Demo-Addon Titel', false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
