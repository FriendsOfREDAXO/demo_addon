<?php

// Die layout/top.php und layout/bottom.php werden automatisch eingebunden

// Die Subpages müssen dem Titel nicht mehr übergeben werden
echo rex_view::title($this->i18n('title')); // $this->i18n('title') ist eine Kurzform für rex_i18n::msg('dummy_title')

// Die Subpages werden nicht mehr über den "subpage"-Parameter gesteuert, sondern mit über "page" (getrennt mit einem Slash, z. B. page=dummy/config)
// Die einzelnen Teile des page-Pfades können mit der folgenden Funktion ausgelesen werden.
$subpage = rex_be_controller::getCurrentPagePart(2);

switch ($subpage) {
  case 'config':
    include $this->getBasePath('pages/config.inc.php');
    break;
  default:
    include $this->getBasePath('pages/main.inc.php');
}
