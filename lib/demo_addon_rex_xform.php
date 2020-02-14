<?php

/**
 * Diese Klasse wird bei der Tabellenverwaltung verwendet
 * Als Beispiel dient hier das Geburtsdatum (Feld `birthdate`) das im Format tt.mm.jjjj im Formular
 * eingegeben wird und hier für das speichern in der Tabelle in das Format YYYY-MM-DD umgewandelt wird.
 *
 * @author Friends Of REDAXO
 *
 * @package demo_addon
 */
class demo_addon_rex_form extends rex_form
{
    /**
     * Callbackfunktion vor dem speichern des Formulars
     * hier kann der zu speichernde Inhalt noch beeinflusst werden.
     */
    public function preSave($fieldsetName, $fieldName, $fieldValue, rex_sql $saveSql)
    {
        switch ($fieldName) {
            default:
                return $fieldValue;
                break;
            case 'birthdate':
                return date('Y-m-d', strtotime($fieldValue));
                break;
        }
    }
}
