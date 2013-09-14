<?php

$old_table = 'clanky';
$new_table = 'article_rated';

//import only when Table is empty
if ($database_new->Count($new_table, "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT id, hlasujici FROM $old_table");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        $ips = explode(",", $r['hlasujici']);
        //insert all ips to database
        foreach ($ips as $ip) {
            $data = array(
                'ip' => $ip,
            );
            //dont scream when IP already in
            $database_new->Insert('ip', $data, TRUE);


            //connect those ips with articles
            $where = array('ip' => $ip);
            $id_rater = $database_new->SelectSingle('ip', 'id', $where);

            $data = array(
                'id_article' => $r['id'],
                'id_rater' => $id_rater,
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
