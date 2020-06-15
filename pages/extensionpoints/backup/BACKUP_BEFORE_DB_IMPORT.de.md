
**Beschreibung:** Der EP `BACKUP_BEFORE_DB_IMPORT` wird vor dem Import eines Datenbank-Backups im Backend aufgerufen.

**Übergabewerte**

```
Subject: leer
Parameter: ['content' => $content, 'filename' => $filename, 'filesize' => $filesize]
```

> **Hinweis:** $content enthält den kompletten Inhalt der SQL-Import-Datei
