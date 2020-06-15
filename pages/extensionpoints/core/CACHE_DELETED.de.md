
**Beschreibung:** Der EP `CACHE_DELETED` wird nach dem löschen des REDAXO Caches aufgerufen (im Backend oder mit der Funktion `rex_delete_cache`). Die Meldung kann mit `$ep->setSubject()` angepasst werden.

**Übergabewerte**

```
Subject: rex_i18n::msg('delete_cache_message');
Parameter: keine
```
