<?php
$old_table = "cantmiss";
$new_table = "highlight";
$fields = array(
    'id' => 'id',
    'poradi' => 'position',
    'link_big' => 'pic_big',
    'link' => 'link',
    'pridal' => 'id_user',
    'del' => 'visible',
);

import($database_new, $database_old, $old_table, $new_table, $fields)
?>
