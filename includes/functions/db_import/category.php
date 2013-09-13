<?php

$old_table = "kategorie";
$new_table = "category";
$fields = array(
            'id' => 'id',
            'nazev' => 'title',
        );


import($database_new, $database_old, $old_table, $new_table, $fields)
?>
