
**Beschreibung:** Der EP `OUTPUT_FILTER` wird sowohl im Backend als auch im Frontend aufgerufen. Er liefert den gesamten HTML-Code vor der Ausgabe an den Browser. Der HTML-Code kann über den EP noch vor der Ausgabe geändert und mit `setSubject` zurückgegeben werden.

**Übergabewerte**

```
Subject: $content (HTML)
Parameter: keine
```
