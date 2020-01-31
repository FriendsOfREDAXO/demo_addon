<?php

/*
Demo für Addon-Einstellungen die in der Tabelle rex_config gespeichert werden
Hier mit Verwendung der Klasse rex_config_form. Die Einstellungen werden automatisch
beim absenden des Formulars gespeichert.

Die beiden Dateien config.rex_config_form.php und config.classic_form.php
speichern die gleichen Addon-Einstellungen.
Anhand der identischen Kommentare können die beiden Dateien "verglichen" werden.
*/

// Instanzieren des Formulars
$form = rex_config_form::factory('demo_addon');

// Fieldset 1
$form->addFieldset($this->i18n('config_legend1'));

// 1.1 Einfaches Textfeld
$field = $form->addInputField('text', 'url', null, ['class' => 'form-control']);
$field->setLabel($this->i18n('config_url'));

// 1.2 Textarea
$field = $form->addTextAreaField('text');
$field->setLabel($this->i18n('config_text'));

// 1.3 Checkbox
$field = $form->addCheckboxField('checkbox');
$field->addOption($this->i18n('config_checkbox'), 1);

// 1.4 Select
$field = $form->addSelectField('select', $value = null, ['class' => 'form-control selectpicker']);
$field->setLabel($this->i18n('config_select'));
$select = $field->getSelect();
$select->addOption('eins', 1);
$select->addOption('zwei', 2);
$select->addOption('drei', 3);

// 1.5 Multiselect
$field = $form->addSelectField('multiselect', null, ['class' => 'form-control']);
$field->setAttribute('multiple', 'multiple');
$field->setLabel($this->i18n('config_multiselect'));
$select = $field->getSelect();
$select->setSize(5);
for ($i = 1; $i <= 10; ++$i) {
    $select->addOption($i, $i);
}
$field = $form->addRawField('<dl class="rex-form-group form-group"><dt></dt><dd><p>'.$this->i18n('config_multiselect_note').'</p></dd></dl>');

// 1.6 Radio-Group
$field = $form->addRadioField('radio');
$field->addOption($this->i18n('demo_addon_config_radio_fe'), 'frontend');
$field->addOption($this->i18n('demo_addon_config_radio_be'), 'backend');

// Fieldset 2
$form->addFieldset($this->i18n('config_legend2'));

// 2.1 Media-Widget
$field = $form->addMediaField('file');
$field->setLabel($this->i18n('config_file'));
$field->setAttribute('id', 'medienpool-linkmap-usw-file');

// 2.2 MediaList-Widget
$field = $form->addMediaListField('files');
$field->setLabel($this->i18n('config_files'));

// 2.3 Link-Widget
$field = $form->addLinkmapField('article');
$field->setLabel($this->i18n('config_article'));

// 2.4 Linklist-Widget
$field = $form->addLinklistField('articles');
$field->setLabel($this->i18n('config_articles'));

// 2.5 Kategorienauswahl
$category_select = new rex_category_select(false, false, false, true);
$category_select->setName('medienpool_linkmap_usw_[categories]');
$category_select->setId('demo_addon-config-categories');
$category_select->setSize('10');
$category_select->setMultiple(true);
$category_select->setAttribute('style', 'width:100%');
$category_select->setSelected($this->getConfig('categories'));
$html = $category_select->get();
$field = $form->addRawField($html);
$field->setLabel($this->i18n('config_categories'));

// Ausgabe des Formulars
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $this->i18n('config_title_rex_config'), false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
