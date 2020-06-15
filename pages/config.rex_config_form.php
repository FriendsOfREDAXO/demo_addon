<?php

/*
Demo für AddOn-Einstellungen die in der Tabelle `rex_config` gespeichert werden.
Hier mit Verwendung der Klasse `rex_config_form`. Die Einstellungen werden automatisch
beim absenden des Formulars gespeichert.

Die beiden Dateien `config.rex_config_form.php` und `config.classic_form.php`
speichern die gleichen AddOn-Einstellungen.
Anhand der identischen Kommentare können die beiden Dateien "verglichen" werden.

https://redaxo.org/doku/master/konfiguration_form
*/

$addon = rex_addon::get('demo_addon');

// Instanzieren des Formulars
$form = rex_config_form::factory('demo_addon');

// Fieldset 1
$field = $form->addFieldset($addon->i18n('config_legend1'));

// 1.1 Einfaches Textfeld
$field = $form->addInputField('text', 'url', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('config_url'));

// 1.2 Textarea
$field = $form->addTextAreaField('text', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('config_text'));

// 1.3 Checkbox
$field = $form->addCheckboxField('checkbox');
$field->addOption($addon->i18n('config_checkbox'), 1);

// 1.4 Select
$field = $form->addSelectField('select', $value = null, ['class' => 'form-control selectpicker']);
$field->setLabel($addon->i18n('config_select'));
$select = $field->getSelect();
$select->addOption('eins', 1);
$select->addOption('zwei', 2);
$select->addOption('drei', 3);

// 1.5 Multiselect
$field = $form->addSelectField('multiselect', null, ['class' => 'form-control']);
$field->setAttribute('multiple', 'multiple');
$field->setLabel($addon->i18n('config_multiselect'));
$select = $field->getSelect();
$select->setSize(5);
for ($i = 1; $i <= 10; ++$i) {
    $select->addOption($i, $i);
}
$field = $form->addRawField('<dl class="rex-form-group form-group"><dt></dt><dd><p>'.$addon->i18n('config_multiselect_note').'</p></dd></dl>');

// 1.6 Radio-Group
$field = $form->addRadioField('radio');
$field->addOption($addon->i18n('demo_addon_config_radio_fe'), 'frontend');
$field->addOption($addon->i18n('demo_addon_config_radio_be'), 'backend');

// Fieldset 2
$form->addFieldset($addon->i18n('config_legend2'));

// 2.1 Media-Widget
$field = $form->addMediaField('media');
$field->setLabel($addon->i18n('config_media'));

// 2.2 MediaList-Widget
$field = $form->addMediaListField('medialist');
$field->setLabel($addon->i18n('config_medialist'));

// 2.3 Media-Category-Select
$field = $form->addSelectField('mediacategories', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('config_mediacategories'));
$field->setSelect(new rex_media_category_select());
$category_select = $field->getSelect();
$category_select->setSize('10');
$category_select->setAttribute('multiple', 'multiple');
$category_select->setAttribute('class', 'form-control');

// Fieldset 3
$form->addFieldset($addon->i18n('config_legend3'));

// 3.1 Link-Widget
$field = $form->addLinkmapField('article');
$field->setLabel($addon->i18n('config_article'));

// 3.2 Linklist-Widget
$field = $form->addLinklistField('articlelist');
$field->setLabel($addon->i18n('config_articlelist'));

// 3.3 Kategorienauswahl
$field = $form->addSelectField('categories', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('config_categories'));
$field->setSelect(new rex_category_select(false, false, false, true));
$category_select = $field->getSelect();
$category_select->setSize('10');
$category_select->setAttribute('multiple', 'multiple');
$category_select->setAttribute('class', 'form-control');

// Ausgabe des Formulars
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('config_title_rex_config'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
