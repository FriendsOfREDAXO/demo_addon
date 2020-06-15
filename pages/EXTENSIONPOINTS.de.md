# Extension Points

[Extension Points](https://redaxo.org/doku/master/extension-points) sind Stellen im REDAXO-Programmcode, an denen eigener Code eingeklinkt und ausgeführt werden kann. Dadurch lässt sich auch das Core-System erweitern und anpassen, ohne den Core selbst zu verändern.

Extension Points ermöglichen die Manipulation eines bestimmten Wertes, der von der Funktion zurückgegeben wird, die man am Extension Point ausführen lässt. Extension Points stehen im Frontend und im Backend zur Verfügung.

Die Funktion bekommt an der Stelle der Codeausführung relevante Parameter als Übergabewerte, die sich von Extension Point zu Extension Point unterscheiden.

- [Extension Points in der REDAXO-Dokumentation](https://www.redaxo.org/doku/master/extension-points)

## Beispiele Extension Points im Demo-AddOn

Im Verzeichnis `pages/extensionpoints/` des Demo-AddOns gibt es viele Beispiele für Extension Points und wie diese EP's verwendet werden können.

In der Liste der Extension Points kann der PHP-Code zu den einzelnen Beispiel EP's direkt angezeigt und kopiert werden.

<a href="?page=demo_addon/eps/eplist" class="btn btn-primary">Zur Liste der Extension Points</a>

Die EP's sind in einzelne Unterordner aufgeteilt. Für jeden Unterorder sollte Eine `README.md` für die Anlistung der EP's vorhanden sein.

Für jeden Extension Point gibt es im Idealfall 2 Dateien:

- `EP_NAME.php` - Beispiel-Code für den EP
- `EP_NAME.md` - Eine kurze Beschreibung des EP

Der Name des EP's wird für die Dateinamen verwendet (**GROSSBUCHSTABEN!**).
Alle Extension Points werden automatisch in der `boot.php` eingebunden und somit auch ausgeführt.
Die Ausgabe im Logfile kann mit z.B. mit `demo_addon_logger::log('Meldung für das Logfile', 'EP_NAME');` im EP-Code erreicht werden.

Die EP's dienen als Vorlage und sollten nicht wirkich Änderungen vornehmen. Nach Möglichkeit Ausgabe der für den EP wichtigen Felder und Inhalte im Logfile. Dokumentation im Quellcode erwünscht!

<a href="?page=demo_addon/eps/logfile" class="btn btn-primary">Zum Logfile</a>

> **Hinweis:** Gerne fehlende EP's per PR hinzufügen :)
