
**Beschreibung:** Der EP `BACKUP_AFTER_DB_IMPORT` wird nach dem Import eines Datenbank-Backups im Backend aufgerufen.

**Übergabewerte**

```
Subject: rex_i18n::msg('backup_database_imported');
Parameter: ['content' => $content, 'filename' => $filename, 'filesize' => $filesize]
```

> **Hinweis:** $content enthält den kompletten Inhalt der SQL-Import-Datei
