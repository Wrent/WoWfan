<?php
$old_table = 'user';
$new_table = 'ip';

//import only when Table is empty
if ($database_new->Count('ip', "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT ip, id FROM users");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        //there might be UNIQUE errors here, that is why we will not log errors here
        $data1 = array (
            'ip' => $r['ip'],
        );
        $database_new->Insert($new_table, $data1, TRUE);
        
        $where = array ('ip' => $r['ip']);
        $ip = $database_new->SelectSingle('ip', 'id', $where);
        $data2 = array (
            'id_ip' => $ip,
            'id_user' => $r['id'],
        );
        $database_new->Insert('ip_usage', $data2, TRUE);
        $i++;
    }
    echo "Import from table $old_table to $new_table finished!Imported $i fields.<br>";
} else {
    echo "Table $new_table is not empty, import failed.<br>";
}
?>
