<?php

$addon = rex_addon::get('demo_addon');

// Custom-Function zum prüfen des Geburtsdatums
// Return false wenn das Datum ungültig ist. Ansonsten true
function demoAddon_checkBirthdate($par)
{
    return '0000-00-00';
}

// Die Update-Funktionen werden am Anfang des Scripts abgearbeitet
// Am Script-Ende wird dadurch immer die Liste ausgegeben

// Parameter bereitstellen
$func = rex_request('func', 'string', ''); // Funktion: add/edit/delete
$id = rex_request('id', 'int', -1); // ID des Datensatzes
$oldstatus = rex_request('oldstatus', 'int', -1); // Alter Status beim aktivieren/deaktivieren

// Bei vorhandener Funktion (add/edit/delete) eine rex_sql-Instanz erstellen
// https://www.redaxo.org/doku/master/datenbank-queries
 if ($func) {
     $sql = rex_sql::factory();
     $sql->setDebug(true); // mit 'true' kann die Debug-Ausgabe eingeschalten werden
 }

// -----------------------------------------------------------------------------
// Datensatz Löschen
// -----------------------------------------------------------------------------
if ('delete' == $func) {
    $sql->setTable(rex::getTable('demo_addon'));
    $sql->setWhere(['id' => $id]);
    $sql->delete();

    if (!$sql->hasError()) {
        echo rex_view::success($addon->i18n('list_deleted'));
    } else {
        echo rex_view::error($addon->i18n('list_error'));
        dump($sql->getError()); // Fehlerinformationen ausgeben
    }
    $func = '';
}

// -----------------------------------------------------------------------------
// aktivieren/deaktivieren
// -----------------------------------------------------------------------------
if ('togglestatus' == $func) {
    $status = (1 === $oldstatus) ? 0 : 1; // Neuer Status beim aktivieren/deaktivieren

    $sql->setTable(rex::getTable('demo_addon'));
    $sql->setWhere(['id' => $id]);
    $sql->setValue('status', $status);
    $sql->update();

    if (!$sql->hasError()) {
        if ($status) {
            echo rex_view::success($addon->i18n('list_activated'));
        } else {
            echo rex_view::success($addon->i18n('list_deactivated'));
        }
    } else {
        echo rex_view::error($addon->i18n('list_error'));
        dump($sql->getError()); // Fehlerinformationen ausgeben
    }
    $func = '';
}

// -----------------------------------------------------------------------------
// Neuen Datensatz anlegen / Datensatz editieren
// https://redaxo.org/doku/master/formulare
// -----------------------------------------------------------------------------
if (in_array($func, ['add', 'edit'])) {
    if ('edit' == $func) {
        $title = $addon->i18n('list_edit');
    }
    if ('add' == $func) {
        $title = $addon->i18n('list_create_new_entry');
    }

    // Formular-Objekt erstellen
    $form = rex_form::factory(rex::getTable('demo_addon'), 'Datensatz bearbeiten', 'id=' . $id);

    // Die ID muss immer mit übergeben werden, sonst funktioniert das Speichern nicht
    $form->addParam('id', $id); // ID des Datensatzes

    // Sortierparameter werden ebenso behalten wie die Position in der Liste
    $form->addParam('sort', rex_request('sort', 'string', ''));
    $form->addParam('sorttype', rex_request('sorttype', 'string', ''));
    $form->addParam('start', rex_request('start', 'int', 0));

    // Select Anrede
    $field = $form->addSelectField('anrede', $value = null, ['class' => 'form-control selectpicker']);
    $field->setLabel($addon->i18n('thead_anrede'));
    $select = $field->getSelect();
    $select->addOption($addon->i18n('list_mr'), 1);
    $select->addOption($addon->i18n('list_mrs'), 2);

    // Textfelder
    $field = $form->addTextField('name');
    $field->setLabel($addon->i18n('thead_name'));
    $field->getValidator()->add('notEmpty', 'Das Feld Name darf nicht leer sein.');

    $field = $form->addTextField('vorname');
    $field->setLabel($addon->i18n('thead_vorname'));
    $field->getValidator()->add('notEmpty', 'Das Feld Vorame darf nicht leer sein.');

    $field = $form->addTextField('strasse');
    $field->setLabel($addon->i18n('thead_strasse'));

    $field = $form->addTextField('plz');
    $field->setLabel($addon->i18n('thead_plz'));
    $field->setAttribute('style', 'width: 150px;');
    $field->setAttribute('maxlength', '8');

    $field = $form->addTextField('ort');
    $field->setLabel($addon->i18n('thead_ort'));

    // Geburtsdatum
    $field = $form->addTextField('birthdate');
    $field->setLabel($addon->i18n('thead_birthdate'));
    $field->setAttribute('style', 'width: 150px;');
    $field->setAttribute('maxlength', '10');
    if ($field->getValue()) {
        $field->setValue(date('d.m.Y', strtotime($field->getValue())));
    }
    $field->getValidator()->add('notEmpty', 'Das Feld Geburtsdatum darf nicht leer sein.');
    $field->getValidator()->add('custom', 'Geburtsdatum ungültig', 'demoAddon_checkBirthdate');

    // Select Status
    $field = $form->addSelectField('status', $value = null, ['class' => 'form-control selectpicker']);
    $field->setLabel($addon->i18n('thead_status'));
    $select = $field->getSelect();
    $select->addOption($addon->i18n('list_active'), 1);
    $select->addOption($addon->i18n('list_inactive'), 0);

    $content = $form->get();

    // Forumular ausgeben
    $fragment = new rex_fragment();
    $fragment->setVar('class', 'edit', false);
    $fragment->setVar('title', $title);
    $fragment->setVar('body', $content, false);
    $content = $fragment->parse('core/page/section.php');
    echo $content;
    exit;
}

// -----------------------------------------------------------------------------
// Aufbereitung und Ausgabe der Tabellenliste
// Dokumentation https://redaxo.org/doku/master/listen
// $list = rex_list::factory($query, $rowsPerPage, $listName, $debug);
// -----------------------------------------------------------------------------

// Alle ausgewählten Felder des Queries werden als Spalten in der Liste angezeigt
// Die einzelnen Spalten können noch verändert/erweitert werden ... siehe weiter unten
// Mit dem Parameter $rowsPerPage (hier 30) kann die Anzahl der Listeinträge festgelegt werden
// Sind mehr Datensätze vorhanden wird automatisch eine Pagination ausgegeben
$list = rex_list::factory(
    '
    SELECT `id`, `anrede`, `vorname`, `name`, `strasse`, `plz`, `ort`, `birthdate`, `status`
    FROM ' . rex::getTable('demo_addon') . '
    ORDER by `name` ASC, `vorname` ASC
    ',
    30, 'Demo-Liste', false);

// Spalten können mit removeColumn('columnname') entfernt werden
//$list->removeColumn('id');

// Spaltenbreiten definieren. Evtl. anpassen wenn Spalten entfernt/hinzugefügt werden
$list->addTableColumnGroup([40, 40, 40, 100, 120, '*', 40, 100, 100, 80, 80]);

// Sortierbare Spalten - Klick auf die Spaltenüberschrift sortiert die Liste nach dieser Spalte
// Der zweite Parameter legt die Sortierung für den 1. Klick auf die Spaltenüberschrift fest und
// wird danach automatisch 'getoggled' (asc/desc)
$list->setColumnSortable('id', 'asc');
$list->setColumnSortable('name', 'asc');

// Spalte mit Editier-Icon am Zeilen-Anfang hinzufügen (Parameter 3 bei addColumn = 0)
// $thIcon: Icon für die Überschriftenzeile mit Link 'func=add'
// $tdIcon: Icon für die Datenzeilen mit Link 'func=edit'
// zum ändern des Icons 'rex-icon-editmode' durch das gewünschte Icon ersetzen
$thIcon = '<a href="' . $list->getUrl(['func' => 'add']) . '"' . rex::getAccesskey($addon->i18n('list_create_new_entry'), 'add') . ' title="' . $addon->i18n('create_new_entry') . '"><i class="rex-icon rex-icon-add"></i></a>';
$tdIcon = '<i class="rex-icon rex-icon-editmode" title="' . $addon->i18n('list_edit') . ' [###id###]"></i>';
$list->addColumn($thIcon, $tdIcon, 0, ['<th class="rex-table-icon">###VALUE###</th>', '<td class="rex-table-icon">###VALUE###</td>']);
$list->setColumnParams($thIcon, ['func' => 'edit', 'id' => '###id###']);

// Spalte 'Funktionen' am Zeilen-Ende hinzufügen (Parameter 3 bei addColumn = -1)
// Link zum löschen des Datensatzes
// In dieser Spalte können bei Bedarf auch mehrere Funktions-Links untergebracht werden
$list->addColumn('func', '', -1, ['<th>###VALUE###</th>', '<td nowrap="nowrap">###VALUE###</td >']);
$list->setColumnLabel('func', $addon->i18n('thead_func'));

// setColumnParams func => 'delete' ... wird weiter oben im Script entsprechend abgefragt und abgearbeitet
// Die Klasse 'data-confirm' bei addLinkAttribute bewirkt eine Popup-Abfrage ob der Datensatz gelöscht werden soll
// ohne die Klasse 'data-confirm' wird der Datensatz sofort gelöscht!
$list->setColumnFormat('func', 'custom', static function ($params) {
    $list = $params['list'];
    $list->setColumnParams('delete', ['func' => 'delete', 'id' => '###id###']);
    $list->addLinkAttribute('delete', 'data-confirm', '[###vorname### ###name###] - ' . rex_addon::get('demo_addon')->i18n('confirm_delete'));
    $str = $list->getColumnLink('delete', '<i class="rex-icon rex-icon-delete"></i> ' . rex_addon::get('demo_addon')->i18n('delete') . '');
    return $str;
});

// Spaltenüberschriften setzen
// Wenn keine Überschrift für eine Spalte gesetzt wird dann wird automatisch der DB-Feldname als Überschrift verwendet
$list->setColumnLabel('id', $addon->i18n('thead_id'));
$list->setColumnLabel('anrede', $addon->i18n('thead_anrede'));
$list->setColumnLabel('vorname', $addon->i18n('thead_vorname'));
$list->setColumnLabel('name', $addon->i18n('thead_name'));
$list->setColumnLabel('strasse', $addon->i18n('thead_strasse'));
$list->setColumnLabel('plz', $addon->i18n('thead_plz'));
$list->setColumnLabel('ort', $addon->i18n('thead_ort'));
$list->setColumnLabel('birthdate', $addon->i18n('thead_birthdate'));
$list->setColumnLabel('status', $addon->i18n('thead_status'));

// Spalte Anrede anpassen
// In der Tabelle wird 1 für Herr und 2 für Frau abgespeichert und würde auch so angezeigt werden
// Hier wird die Anzeige der Spalte entsprechend dem Feldinhalt angepasst
$list->setColumnFormat('anrede', 'custom', static function ($params) {
    $list = $params['list']; // $list enthält ein SQL-Objekt mit allen Felder aus dem DB-Select
    $str = (1 == $list->getValue('anrede')) ? rex_i18n::msg('demo_addon_list_mr') : rex_i18n::msg('demo_addon_list_mrs');
    return $str;
});

// Spalte Geburtsdatum (birthdate) anpassen
// In der Tabelle wird das Datum im Format YYYY-MM-DD gespeichert
// Hier wird für die Anzeige auf das deutsche Datumsformat umgewandelt
$list->setColumnFormat('birthdate', 'custom', static function ($params) {
    $list = $params['list'];
    $str = date('d.m.Y', strtotime($list->getValue('birthdate')));
    return $str;
});

// Spalte Status (status) anpassen
// In der Tabelle wird 1 für aktiv, und 0 für inaktiv gespeichert
// Hier wird die Ausgabe als Text umgewandelt und als Link ausgegeben
// Dem Link wird die func=togglestatus und der 'alte' (oldstatus) Status angehängt
// func => 'togglestatus' ... wird weiter oben im Script entsprechend abgefragt und abgearbeitet
$list->setColumnFormat('status', 'custom', static function ($params) {
    $list = $params['list'];
    $list->addLinkAttribute('status', 'class', 'toggle');
    if (1 == $list->getValue('status')) {
        $list->setColumnParams('status', ['func' => 'togglestatus', 'id' => '###id###', 'oldstatus' => '###status###']);
        $str = $list->getColumnLink('status', '<span class="rex-online"><i class="rex-icon rex-icon-active-true"></i> ' . rex_i18n::msg('demo_addon_list_active') . '</span>');
    } else {
        $list->setColumnParams('status', ['func' => 'togglestatus', 'id' => '###id###', 'oldstatus' => '###status###']);
        $str = $list->getColumnLink('status', '<span class="rex-offline"><i class="rex-icon rex-icon-active-false"></i> ' . rex_i18n::msg('demo_addon_list_inactive') . '</span>');
    }
    return $str;
});

// Hier wird ein Text definiert, der angezeigt wird, falls keine Datensätze gefunden werden.
// Als Standard wird der über rex_i18n übersetzte String aus 'list_no_rows' verwendet.
$list->setNoRowsMessage($addon->i18n('list_no_rows'));

// Ausgabe der Tabelle mit dem Attribut class="table-striped table-hover"
$list->addTableAttribute('class', 'table-striped table-hover');

// Liste mit Verwundung eines Fragments ausgeben - $list->get()
$fragment = new rex_fragment();
$fragment->setVar('title', $addon->i18n('thead_title'));
$fragment->setVar('content', $list->get(), false);
echo $fragment->parse('core/page/section.php');
