<?php

$content = 'Allgemeine Dummy-Seite';

$fragment = new rex_fragment();
$fragment->setVar('class', 'dummy');
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
