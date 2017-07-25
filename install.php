<?php

/** @var rex_addon $this */

// Hier können zum Beispiel Konfigurationswerte in der rex_config initialisiert werden.
// Das if-Statement ist notwendig, um bei einem reinstall die Konfiguration nicht zu überschreiben.
/*if (!$this->hasConfig()) {
    $this->setConfig('url', 'http://www.example.com');
    $this->setConfig('ids', [1, 4, 5]);
} */

// Mit einer rex_functional_exception kann die Installation mit einer Fehlermeldung abgebrochen werden.
/* $somethingIsWrong = false;
if ($somethingIsWrong) {
    throw new rex_functional_exception('Something is wrong');
} */

// Alternativ kann ähnlich wie in R4 mit den Properties "install" und "installmsg" die Installation als nicht erfolgreich markiert werden.
// Im Gegensatz zu R4 muss für eine erfolgreiche Installation keine Property mehr gesetzt werden.
/* if ($somethingIsWrong) {
    $this->setProperty('installmsg', 'Something is wrong');
    $this->setProperty('install', false);
} */