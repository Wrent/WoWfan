<?php

$old_table = 'clanky';
$new_table = 'authorship';

//import only when Table is empty
if ($database_new->Count($new_table, "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT id, id_autor, autor FROM $old_table");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        //make sure the array is empty
        unset($id_users);

        //id of user is ok
        if ($r['autor'] == 'NULL') {
            $id_users [] = $r['id_autor'];
        } else {
            //look for all of the nicks of authors to database and try to add them
            //else add at least Nonregistered
            $authors = explode(",", $r['autor']);
            foreach ($authors as $author) {
                $author = trim($author);
                $where = array('nick' => $author);
                $id = $database_old->SelectSingle('users', 'id', $where);
                if (!$id) {
                    $id_users [] = NULL;
                } else {
                    $id_users [] = $id;
                }
            }
        }

        //insert all found authors to db
        foreach ($id_users as $id_user) {
            $data = array(
                'id_user' => $id_user,
                'id_article' => $r['id'],
            );
            $database_new->Insert($new_table, $data);
            $i++;
        }
    }

    echo "Import from table $old_table to $new_table finished!Imported $i fields.<br>";
} else {
    echo "Table $new_table is not empty, import failed.<br>";
}
?>
