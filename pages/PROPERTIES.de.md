# AddOn-Properties

Die AddOn-Properties können über die `package.yml` oder per `setProperty(propertyname, propertyvalue)` gesetzt werden.
Mit `getProperty(propertyname)` können die AddOn-Properties abgefragt werden.

Hier wird die Verwendung der Properties demonstriert (und das einbinden einer .md-Datei im AddOn, einfach mal in den Quellcode reinschauen).

> **Hinweis:** Properties sollten in einem eigenen Namespace unabhängig vom Core (rex:) verwendet werden.
Zum Beispiel:
`$addon = rex_addon::get('project');`
`$addon->setProperty($key, $value);`

Dokumentation:

- [https://redaxo.org/doku/master/konfiguration#package_yml](https://redaxo.org/doku/master/konfiguration#package_yml)
- [https://redaxo.org/doku/master/eigenschaften#property-methoden](https://redaxo.org/doku/master/eigenschaften#property-methoden)
