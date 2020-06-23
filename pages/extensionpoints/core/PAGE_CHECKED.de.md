
**Beschreibung:** Der EP `PAGE_CHECKED` enthält das nach dem EP `PAGES_PREPARED` evtl. veränderte Pages-Objekt (rex_be_controller::getPages()).

**Übergabewerte**

```
Subject: $page
Parameter: ['pages' => $pages]
```

> **Hinweis:** Der Wert ist schreibgeschützt. Parameter $pages enthält das Array aus rex_be_controller::getPages()