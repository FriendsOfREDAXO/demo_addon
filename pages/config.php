<?php

$content = '';
$buttons = '';

$csrfToken = rex_csrf_token::factory('demo_addon');

// Einstellungen speichern
if (rex_post('formsubmit', 'string') == '1' && !$csrfToken->isValid()) {
    echo rex_view::error(rex_i18n::msg('csrf_token_invalid'));
} elseif (rex_post('formsubmit', 'string') == '1') {
    $this->setConfig(rex_post('config', [
        ['url', 'string'],
        ['checkbox', 'string'],
        ['select', 'string'],
        ['multiselect', 'array[int]'],
        ['file', 'string'],
        ['article', 'string'],
        ['categories', 'array[int]'],
        ['pageids', 'string'],
    ]));

    echo rex_view::success($this->i18n('config_saved'));
}

$content .= '<fieldset><legend>' . $this->i18n('config_legend1') . '</legend>';

// Einfaches Textfeld
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-url">' . $this->i18n('config_url') . '</label>';
$n['field'] = '<input class="form-control" type="text" id="demo_addon-config-url" name="config[url]" value="' . $this->getConfig('url') . '"/>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// Checkbox
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-checkbox">' . $this->i18n('config_checkbox') . '</label>';
$n['field'] = '<input type="checkbox" id="demo_addon-config-checkbox" name="config[checkbox]"' . (!empty($this->getConfig('checkbox')) && $this->getConfig('checkbox') == '1' ? ' checked="checked"' : '') . ' value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

// Select
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-ids">' . $this->i18n('config_select') . '</label>';
$select = new rex_select();
$select->setId('demo_addon-config-select');
$select->setAttribute('class', 'form-control');
$select->setName('config[select]');
$select->addOption(0, 0);
$select->addOption(1, 1);
$select->setSelected($this->getConfig('select'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// Multiselect
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-multiselect">' . $this->i18n('config_multiselect') . '</label>';
$select = new rex_select();
$select->setId('demo_addon-config-multiselect');
$select->setMultiple();
$select->setAttribute('class', 'form-control');
$select->setName('config[multiselect][]');
for ($i = 1; $i < 6; ++$i) {
    $select->addOption($i, $i);
}
$select->setSelected($this->getConfig('multiselect'));
$n['field'] = $select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

$content .= '</fieldset>';

$content .= '<fieldset><legend>' . $this->i18n('config_legend2') . '</legend>';

// Dateiauswahl Medienpool-Widget
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_MEDIA_1">' . $this->i18n('config_file') . '</label>';

$n['field'] = '
<div class="rex-js-widget rex-js-widget-media">
	<div class="input-group">
		<input class="form-control" type="text" name="config[file]" value="' . $this->getConfig('file') . '" id="REX_MEDIA_1" readonly="readonly">
		<span class="input-group-btn">
        <a href="#" class="btn btn-popup" onclick="openREXMedia(1);return false;" title="'.$this->i18n('var_media_open').'">
        	<i class="rex-icon rex-icon-open-mediapool"></i>
        </a>
        <a href="#" class="btn btn-popup" onclick="addREXMedia(1);return false;" title="'.$this->i18n('var_media_new').'">
        	<i class="rex-icon rex-icon-add-media"></i>
        </a>
        <a href="#" class="btn btn-popup" onclick="deleteREXMedia(1);return false;" title="'.$this->i18n('var_media_remove').'">
        	<i class="rex-icon rex-icon-delete-media"></i>
        </a>
        <a href="#" class="btn btn-popup" onclick="viewREXMedia(1);return false;" title="'.$this->i18n('var_media_view').'">
        	<i class="rex-icon rex-icon-view-media"></i>
        </a>
        </span>
	</div>
 </div>
';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// Artikel
$formElements = [];
$artname = '';
$art = rex_article::get($this->getConfig('article'));
if ($art) {
    $artname = $art->getValue('name');
}
$n = [];
$n['label'] = '<label for="REX_LINK_1_NAME">' . $this->i18n('config_article') . '</label>';
$n['field'] = '
<div class="rex-js-widget rex-js-widget-link">
	<div class="input-group">
			<input class="form-control" type="text" name="REX_LINK_NAME[1]" value="'.$artname.'" id="REX_LINK_1_NAME" readonly="readonly" />
			<input type="hidden" name="config[article]" id="REX_LINK_1" value="' . $this->getConfig('article') . '" />

			<span class="input-group-btn">
				<a href="#" class="btn btn-popup" onclick="openLinkMap(\'REX_LINK_1\', \'&clang=1&category_id=1\');return false;" title="' . $this->i18n('var_link_open') . '"><i class="rex-icon rex-icon-open-linkmap"></i></a>
				<a href="#" class="btn btn-popup" onclick="deleteREXLink(1);return false;" title="' . $this->i18n('var_link_delete') . '"><i class="rex-icon rex-icon-delete-link"></i></a>
			</span>
    </div>
</div>
';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// Kategorienauswahl
$formElements = [];
$n = [];
$n['label'] = '<label for="demo_addon-config-categories">' . $this->i18n('config_categories') . '</label>';

$category_select = new rex_category_select(false, false, false, true);
$category_select->setName('config[categories][]');
$category_select->setId('demo_addon-config-categories');
$category_select->setSize('10');
$category_select->setMultiple(true);
$category_select->setAttribute('style', 'width:100%');
$category_select->setSelected($this->getConfig('categories'));

$n['field'] = $category_select->get();
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

// Seitenauswahl
$formElements = [];
$n = [];
$n['label'] = '<label for="REX_LINKLIST_SELECT_1">' . $this->i18n('config_pageids') . '</label>';
$n['field'] = rex_var_linklist::getWidget(1, 'config[pageids]', $this->getConfig('pageids'));
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');

$content .= '</fieldset>';

// Save-Button
$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="save" value="' . $this->i18n('config_save') . '">' . $this->i18n('config_save') . '</button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');
$buttons = '
<fieldset class="rex-form-action">
    ' . $buttons . '
</fieldset>
';

// Ausgabe Formular
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $this->i18n('config'));
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
