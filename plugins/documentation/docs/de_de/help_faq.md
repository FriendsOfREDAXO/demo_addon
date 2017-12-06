# FAQ-Liste

* **Ich habe einen Fehler in der Dokumentation zum Plugin `documentation` oder im Plugin-Code gefunden, was kann ich tun?**
Du kannst Fehler gerne auf [GitHub](https://github.com/FriendsOfREDAXO/demo_addon) per Pullrequest oder einfach als Issue melden

* **Wo finde ich mehr Informationen zur Markdown Syntax?**
Beispiele findest Du in der [Markdown-Vorlage](_vorlage.md) oder hier [https://daringfireball.net/projects/markdown/syntax](https://daringfireball.net/projects/markdown/syntax)
[http://markdown.de/](http://markdown.de/)

* **Kann ich dem Pluginverzeichnis auch einen anderen Namen als `documentation` vergeben?**
Ja, Du kannst das Verzeichnis auch z.B. **docs** nennen, musst dann aber in der package.yml den Eintrag **package** auf `package: DeinAddonName/docs` anpassen.

* **Es gibt eine neue Version des Plugins, wie kann ich mein plugin updaten?**
Ganz einfach, alle Dateien des documentation-Plugins übernehmen 
**ausser** das Verzeichnis **docs**, und der Datei **package.yml**!

* **Wie kann ich meine Dokumentation automatisch mit meinem Addon installieren und aktivieren?**
Dazu musst Du die package.yml deines Addons erweitern um den Parameter **system_plugins**. Beispiel hier im Demo-Addon [package.yml](https://github.com/FriendsOfREDAXO/demo_addon/blob/master/package.yml#L33-L35)

---

&raquo; Weiter zur **[Markdown-Vorlage](_vorlage.md)**
