<?php

/* !
 * Unified function, which imports from one table to the other the specified data.
 * /param $database_new Database where the data will be imported.
 * /param $database_old Database from the data will be imported.
 * /param $old_table Table from the data will be imported.
 * /param $new_table Table to the data will be imported.
 * /param $fields Array, where key means old field and value means the new field.
 */

function import($database_new, $database_old, $old_table, $new_table, $fields) {
    //import only when Table is empty
    if ($database_new->Count($new_table, "*") == 0) {

        //build query itself
        $query = "SELECT ";
        $i = FALSE;
        //old represents fields from old table and new from the new one
        foreach ($fields as $old => $new) {
            if ($i)
                $query .= ", ";
            $query .= $old . " AS " . $new;
            $i = TRUE;
        }

        $query .= " FROM $old_table";
        //get the data
        $q = $database_old->Query($query);
        
        //insert the data to the new table
        $i = 0;
        while ($r = mysql_fetch_assoc($q)) {
            $database_new->Insert($new_table, $r);
            $i++;
        }
        echo "Import from table $old_table to $new_table finished! Imported $i fields.<br>";
    } else {
        echo "Table $new_table is not empty, import failed.<br>";
    }
}

?>