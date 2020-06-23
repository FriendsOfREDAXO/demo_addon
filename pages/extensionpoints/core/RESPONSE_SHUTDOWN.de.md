
**Beschreibung:** Der EP `RESPONSE_SHUTDOWN` ist der letzte Extension Point vor der Ausgabe der Seite an den Browser (Backend und Frontend). Subject ist der finale HTML-Output (evtl. durch andere EP's verändert). Der Output kann nicht mehr geändert werden (readonly).

**Übergabewerte**

```
Subject: $content (HTML)
Parameter: keine
```
