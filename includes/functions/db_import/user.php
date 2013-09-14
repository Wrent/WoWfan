<?php

//imports users using unified import script

$old_table = "users";
$new_table = "user";
$fields = array(
    'id' => 'id',
    'nick' => 'nick',
    'heslo' => 'password',
    'jmeno' => 'name',
    'prijmeni' => 'surname',
    'bydliste' => 'residence',
    'email' => 'email',
    'icq' => 'icq',
    'skype' => 'skype',
    'url' => 'url',
    'aktivace' => 'activated',
    'napomenuti' => 'warnings',
    'napomenuti_time' => 'last_warned',
    'aktivace' => 'newsletter',
    'popis' => 'info',
);

import($database_new, $database_old, $old_table, $new_table, $fields)
?>
