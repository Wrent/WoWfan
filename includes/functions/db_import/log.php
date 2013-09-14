<?php
$old_table = "logy";
$new_table = "log";
$fields = array(
    'id' => 'id',
    'kdo' => 'id_user',
    'co' => 'what',
    'time' => 'time',
);

import($database_new, $database_old, $old_table, $new_table, $fields)
?>
