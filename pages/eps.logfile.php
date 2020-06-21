<?php

// Ausgabe des Logfiles
// Die Anzahl der angezeigten Zeilen kann in der `package.yml` festgelegt werden
// logfile.listEntries: 300

$addon = rex_addon::get('demo_addon');

$func = rex_request('func', 'string');

$error = '';
$success = '';

$logFile = rex_path::log('demo_addon.log');

// Logfile löschen
if ('delLog' == $func) {
    demo_addon_logger::close();

    if (rex_log_file::delete($logFile)) {
        $success = rex_i18n::msg('demo_addon_log_deleted');
    } else {
        $error = rex_i18n::msg('demo_addon_log_delete_error');
    }
}

// Download des Logfiles
if ('download' == $func && file_exists($logFile)) {
    rex_response::sendFile($logFile, 'application/octet-stream', 'attachment');
    exit;
}

// Ausgabe der Logfile-Einträge
$message = '';
$content = '';

if ('' != $success) {
    $message .= rex_view::success($success);
}

if ('' != $error) {
    $message .= rex_view::error($error);
}

$content .= '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>' . rex_i18n::msg('demo_addon_log_timestamp') . '</th>
                        <th>' . rex_i18n::msg('demo_addon_logid') . '</th>
                        <th>' . rex_i18n::msg('demo_addon_log_message') . '</th>
                    </tr>
                </thead>
                <tbody>';

$file = new rex_log_file($logFile);

// Anzahl der anzuzeigenden Zeilen aus der `package.yml`, falls nicht vorhanden Standard 200
// https://redaxo.org/doku/master/addon-package#eigene
foreach (new LimitIterator($file, 0, $addon->getProperty('logfile.listEntries', 200)) as $entry) {
    /** @var rex_log_entry $entry */
    $data = $entry->getData();
    $class = 'notice';
    if ('1' === $data[2]) {
        $class = 'warning';
    }

    $content .= '
                <tr class="rex-state-' . $class . '">
                    <td nowrap="nowrap">' . $entry->getTimestamp('%d.%m.%Y %H:%M:%S') . '</td>
                    <td nowrap="nowrap">' . $data[0] . '</td>
                    <td width="100%">' . $data[1] . '</td>
                </tr>';
}

$content .= '
                </tbody>
            </table>';

$formElements = [];

$n = [];
$n['field'] = '<button class="btn btn-delete" type="submit" name="del_btn" data-confirm="' . rex_i18n::msg('delete') . '?">' . rex_i18n::msg('syslog_delete') . '</button>';
$formElements[] = $n;

if ($url = rex_editor::factory()->getUrl($logFile, 0)) {
    $n = [];
    $n['field'] = '<a class="btn btn-save" href="'. $url .'">' . rex_i18n::msg('system_editor_open_file', basename($logFile)) . '</a>';
    $formElements[] = $n;
}

if (file_exists($logFile)) {
    $url = rex_url::currentBackendPage(['func' => 'download']);
    $n = [];
    $n['field'] = '<a class="btn btn-save" href="'. $url .'">' . rex_i18n::msg('syslog_download', basename($logFile)) . '</a>';
    $formElements[] = $n;
}

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');

$fragment = new rex_fragment();
$fragment->setVar('title', rex_i18n::msg('syslog_title', $logFile), false);
$fragment->setVar('content', $content, false);
$fragment->setVar('buttons', $buttons, false);
$content = $fragment->parse('core/page/section.php');

$content = '
    <form action="' . rex_url::currentBackendPage() . '" method="post">
        <input type="hidden" name="func" value="delLog" />
        ' . $content . '
    </form>';

echo $message;
echo $content;
