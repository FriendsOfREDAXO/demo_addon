
**Beschreibung:** Der EP `FE_OUTPUT` wird vor dem EP `OUTPUT_FILTER` nur im Frontend aufgerufen. Es wird ein leeres Subject übergeben und es gibt keine Übergabeparameter. Der EP wird vom *structure content* Plugin für die Ausgabe der Webseite verwendet.
Durch setSubject kann hier noch vor Ausgabe der Webseite eine Ausgabe generiert werden.

> **Hinweis:** Da der REDAXO Core selbst keine Ausgabe erstellt wird in der frontend.php dieser EP bereitgestellt. Auch auf [http://traduko.redaxo.org/](http://traduko.redaxo.org/) wird für die Ausgabe der Webseite dieser EP verwendet.

**Übergabewerte**

```
Subject: $content
Parameter: keine
```
