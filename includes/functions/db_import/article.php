<?php
//imports all the articles (even news and usertexts)


$old_table = 'clanky';
$new_table = 'article';

//import only when Table is empty
if ($database_new->Count($new_table, "*") == 0) {

    //get the data
    $q = $database_old->Query("SELECT * FROM $old_table");

    //insert the data to the new table
    $i = 0;
    while ($r = mysql_fetch_assoc($q)) {
        //some of the articles have the wrong time
        if ($r['time'] == NULL) {
            $date = date_create_from_format('d.m.Y ? H:i:s', trim($r['datum']));
            //lot of articles did not have seconds specified, so try also this 
            //before throwing an error
            if (!$date)
                $date = date_create_from_format('d.m.Y ? H:i', trim($r['datum']));
            //if there is still problem, print id of the article
            if (!$date)
                echo $r['id'] . "<br>";
            $time = date_format($date, 'U');
        } else {
            $time = $r['time'];
        }

        //this changes ano / ne to more IT format
        if ($r['odradkovani'] == "ano") {
            $odradkovani = 1;
        } else {
            $odradkovani = 0;
        }

        //specify data
        $data = array(
            'id' => $r['id'],
            'title' => $r['nazev'],
            'description' => $r['popis'],
            'text' => $r['text'],
            'time' => $time,
            'views' => $r['shlednuti'],
            'link' => $r['link'],
            'auto_spacing' => $r['id'],
            'comments_cnt' => $odradkovani,
            'rating' => $r['hodnoceni'],
            'rating_now' => $r['now_hodnoceni'],
            'source' => $r['zdroj'],
            'type' => $r['typ'],
        );
        $database_new->Insert($new_table, $data);
        $i++;
    }
    echo "Import from table $old_table to $new_table finished!Imported $i fields.<br>";
} else {
    echo "Table $new_table is not empty, import failed.<br>";
}
?>
