<?php

/** @var rex_addon $this */

//Install tables via table manager api
$table_definitions = $this->getPath('install/tables.json');
if (file_exists($table_definitions)) {
    $table_data = file_get_contents($table_definitions);
    rex_yform_manager_table_api::importTablesets($table_data);
}

// clear table cache
rex_yform_manager_table::deleteCache();