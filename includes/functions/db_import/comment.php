<?php

$old_table = 'comments';
$new_table = 'comment';

//import only when Table is empty
if ($database_new->Count($new_table, "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT * FROM $old_table");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        //some of the comments dont have the right id_article number, this will fix it
        if ($r['old_id'] != 0) {
             //look for the new id of the article
            if ($r['id_novinka'] != 0) {
               $old_id = $r['id_novinka'];
               $type = 'N';
            } else {
               $old_id = $r['id_usertext'];
               $type = 'U';
            }
            $where = array (
                'old_id' => $old_id,
                'typ' => $type,
                );
            $id_article = $database_old->SelectSingle('clanky', 'id', $where);
        } else {
            $id_article = $r['id_clanek'];
        }
        
        //some of the comments have the wrong time
        if ($r['time'] == NULL) {
            $date = date_create_from_format('d.m.Y ? H:i:s', $r['datum']);
            $time = date_format($date, 'U');
        } else {
            $time = $r['time'];
        }
        
        //some of the comments dont have the id_user set
        if ($r['id_user'] == 0) {
            $id_user = NULL;
        } else {
            $id_user = $r['id_user'];
        }

        $data = array(
            'id' => $r['id'],
            'id_article' => $id_article,
            'id_user' => $id_user,
            'text' => $r['text'],
            'time' => $time,
        );
        $database_new->Insert($new_table, $data);
        $i++;
    }
    echo "Import from table $old_table to $new_table finished!Imported $i fields.<br>";
} else {
    echo "Table $new_table is not empty, import failed.<br>";
}
?>
