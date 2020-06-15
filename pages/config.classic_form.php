<?php

/*
Demo für AddOn-Einstellungen die in der Tabelle `rex_config` gespeichert werden.
Hier "klassisch" mit Verwendung von `rex_form`, `rex_list`, Fragmenten und `setConfig()` zum speichern der
Einstellungen.

Die beiden Dateien `config.rex_config_form.php` und `config.classic_form.php`
speichern die gleichen AddOn-Einstellungen.
Anhand der identischen Kommentare können die beiden Dateien "verglichen" werden.

https://redaxo.org/doku/master/formulare
https://redaxo.org/doku/master/listen
*/

$addon = rex_addon::get('demo_addon');

$content = '';
$buttons = '';

// csrf-Schutz
$csrfToken = rex_csrf_token::factory('demo_addon');

// Formular abgesendet - Einstellungen speichern
if ('1' == rex_post('formsubmit', 'string') && !$csrfToken->isValid()) {
    echo rex_view::error(rex_i18n::msg('csrf_token_invalid'));
} elseif ('1' == rex_post('formsubmit', 'string')) {
    $addon->setConfig(rex_post('config', [
        ['url', 'string'],
        ['text', 'string'],
        ['checkbox', 'string'],
        ['select', 'string'],
        ['multiselect', 'array[int]'],
        ['radio', 'string'],
        ['media', 'string'],
        ['medialist', 'string'],
        ['mediacategories', 'array[int]'],
        ['article', 'string'],
        ['articlelist', 'string'],
        ['categories', 'array[int]'],
    ]));

    echo rex_view::success($addon->i18n('config_saved'));
}

// Fieldset 1
$content .= '<fieldset><legend>' . $addon->i18n('config_legend1') . '</legend>';

// 1.1 Einfaches Textfeld
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-url">' . $addon->i18n('config_url') . '</label>';
$n['field'] = '<input class="form-control" type="text" id="demo_addon-config-url" name="config[url]" value="' . $addon->getConfig('url') . '"/>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 1.2 Textarea
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-text">' . $addon->i18n('config_text') . '</label>';
$n['field'] = '<textarea class="form-control" rows="6" id="demo_addon-config-text" name="config[text]">' . $addon->getConfig('text') . '</textarea>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 1.3 Checkbox
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-checkbox">' . $addon->i18n('config_checkbox') . '</label>';
$n['field'] = '<input type="checkbox" id="demo_addon-config-checkbox" name="config[checkbox]"' . (!empty($addon->getConfig('checkbox')) && '|1|' == $addon->getConfig('checkbox') ? ' checked="checked"' : '') . ' value="|1|" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

// 1.4 Select
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-select">' . $addon->i18n('config_select') . '</label>';
$select = new rex_select();
$select->setId('demo_addon-config-select');
$select->setAttribute('class', 'form-control selectpicker');
$select->setName('config[select]');
$select->addOption('eins', 1);
$select->addOption('zwei', 2);
$select->addOption('drei', 3);
$select->setSelected($addon->getConfig('select'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 1.5 Multiselect
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-multiselect">' . $addon->i18n('config_multiselect') . '</label>';
$select = new rex_select();
$select->setId('demo_addon-config-multiselect');
$select->setMultiple();
$select->setAttribute('class', 'form-control');
$select->setName('config[multiselect][]');
for ($i = 1; $i <= 10; ++$i) {
    $select->addOption($i, $i);
}
$mselect = $addon->getConfig('multiselect');

/* FIX für Multiselect da rex_config_form in Pipe-Schreibweise speichert, wird nur hier in der Demo benötigt */
if (!is_array($mselect)) {
    $mselect = explode('|', $mselect);
} /* Ende FIX */

$select->setSelected($mselect);
$n['field'] = $select->get();
$n['field'] .= $addon->i18n('config_multiselect_note');
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 1.6 Radio-Group
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-radio1">' . $addon->i18n('demo_addon_config_radio_fe') . '</label>';
$n['field'] = '<input type="radio" id="demo_addon-config-radio1" name="config[radio]" value="frontend"' . (!empty($addon->getConfig('radio')) && 'frontend' == $addon->getConfig('radio') ? ' checked="checked"' : '') . ' />';
$formElements[] = $n;

$n = [];
$n['label'] = '<label for="demo_addon-config-radio2">' . $addon->i18n('demo_addon_config_radio_be') . '</label>';
$n['field'] = '<input type="radio" id="demo_addon-config-radio2" name="config[radio]" value="backend"' . (!empty($addon->getConfig('radio')) && 'backend' == $addon->getConfig('radio') ? ' checked="checked"' : '') . ' />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/radio.php');

$content .= '</fieldset>';

// Fieldset 2
$content .= '<fieldset><legend>' . $addon->i18n('config_legend2') . '</legend>';

// 2.1 Media-Widget
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_MEDIA_1">' . $addon->i18n('config_media') . '</label>';
$n['field'] = rex_var_media::getWidget(1, 'config[media]', $addon->getConfig('media'));
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 2.2 MediaList-Widget
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_MEDIALIST_SELECT_1">' . $addon->i18n('config_medialist') . '</label>';
$n['field'] = rex_var_medialist::getWidget(1, 'config[medialist]', $addon->getConfig('medialist'));
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 2.3 Media-Category-Select
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-mediacategories">' . $addon->i18n('config_mediacategories') . '</label>';

$category_select = new rex_media_category_select(false, false, false, true);
$category_select->setName('config[mediacategories][]');
$category_select->setId('demo_addon-config-mediacategories');
$category_select->setSize('10');
$category_select->setMultiple(true);
$category_select->setAttribute('style', 'width:100%');
$mselect = $addon->getConfig('mediacategories');

/* FIX für Multiselect da rex_config_form in Pipe-Schreibweise speichert, wird nur hier in der Demo benötigt */
if (!is_array($mselect)) {
    $mselect = explode('|', $mselect);
} /* Ende FIX */

$category_select->setSelected($mselect);
$n['field'] = $category_select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

$content .= '</fieldset>';

// Fieldset 3
$content .= '<fieldset><legend>' . $addon->i18n('config_legend3') . '</legend>';

// 3.1 Link-Widget
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_LINK_1_NAME">' . $addon->i18n('config_article') . '</label>';
$n['field'] = rex_var_link::getWidget(1, 'config[article]', $addon->getConfig('article'));
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// 3.2 Linklist-Widget
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_LINKLIST_SELECT_1">' . $addon->i18n('config_articlelist') . '</label>';
$n['field'] = rex_var_linklist::getWidget(1, 'config[articlelist]', $addon->getConfig('articlelist'));
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

// 3.3 Kategorienauswahl
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-categories">' . $addon->i18n('config_categories') . '</label>';

$category_select = new rex_category_select(false, false, false, true);
$category_select->setName('config[categories][]');
$category_select->setId('demo_addon-config-categories');
$category_select->setSize('10');
$category_select->setMultiple(true);
$category_select->setAttribute('style', 'width:100%');
$mselect = $addon->getConfig('categories');

/* FIX für Multiselect da rex_config_form in Pipe-Schreibweise speichert, wird nur hier in der Demo benötigt */
if (!is_array($mselect)) {
    $mselect = explode('|', $mselect);
} /* Ende FIX */

$category_select->setSelected($mselect);
$n['field'] = $category_select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/form.php');

$content .= '</fieldset>';

// Save-Button
$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="save" value="' . $addon->i18n('config_save') . '">' . $addon->i18n('config_save') . '</button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');
$buttons = '
<fieldset class="rex-form-action">
    ' . $buttons . '
</fieldset>
';

// Ausgabe des Formulars mit csrf-Schutz
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $addon->i18n('config_title_classic'));
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$output = $fragment->parse('core/page/section.php');

$output = '
<form action="' . rex_url::currentBackendPage() . '" method="post">
<input type="hidden" name="formsubmit" value="1" />
    ' . $csrfToken->getHiddenField() . '
    ' . $output . '
</form>
';

echo $output;
