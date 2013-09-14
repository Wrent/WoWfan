<?php

$old_table = 'clanky';
$new_table = 'being_in_category';

//import only when Table is empty
if ($database_new->Count($new_table, "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT id, kategorie FROM $old_table");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        if($r['kategorie'] == 0)
            $id_category = NULL;
        else
            $id_category = $r['kategorie'];
        
        
        $data = array(
            'id_article' => $r['id'],
            'id_category' => $id_category,
        );
        $database_new->Insert($new_table, $data);
        $i++;
    }
    echo "Import from table $old_table to $new_table finished!Imported $i fields.<br>";
} else {
    echo "Table $new_table is not empty, import failed.<br>";
}
?>
