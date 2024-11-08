<?php
$addon = rex_addon::get('filepond_uploader');

// Instanzieren des Formulars
$form = rex_config_form::factory('filepond_uploader');

// Einstellungen Fieldset
$form->addFieldset($addon->i18n('filepond_settings_title'));

// Maximale Anzahl Dateien
$field = $form->addInputField('number', 'max_files', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('filepond_settings_max_files'));
$field->setAttribute('min', '1');

// Maximale Dateigröße
$field = $form->addInputField('number', 'max_filesize', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('filepond_settings_maxsize'));
$field->setNotice($addon->i18n('filepond_settings_maxsize_notice'));
$field->setAttribute('min', '1');

// Erlaubte Dateitypen
$field = $form->addInputField('text', 'allowed_types', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('filepond_settings_allowed_types'));
$field->setNotice($addon->i18n('filepond_settings_allowed_types_notice'));

// Standardkategorie
$field = $form->addSelectField('category_id', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('filepond_settings_category_id'));
$field->setNotice($addon->i18n('filepond_settings_category_notice'));
$select = new rex_media_category_select();
$select->setSize(1);
$select->addOption($addon->i18n('filepond_upload_no_category'), 0);
$field->setSelect($select);

// Standardsprache
$field = $form->addInputField('text', 'lang', null, ['class' => 'form-control']);
$field->setLabel($addon->i18n('filepond_settings_lang'));
$field->setNotice($addon->i18n('filepond_settings_lang_notice'));

// Ausgabe des Formulars
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $addon->i18n('filepond_settings_title'));
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');
