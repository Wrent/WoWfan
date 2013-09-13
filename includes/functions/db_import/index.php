<?php
//first, import the tables, with no foreign keys
//category, menu, highlight

require_once '../../classes/CDatabase.php';

$database_old = new CDatabase("localhost", "wowherniweb", "woWKo4-db;15", "webcore");
$database_old->Connect();

$database_new = new CDatabase("localhost", "root", "root", "aurora");
$database_new->Connect();

include "category.php";
include "menu.php";
include "highlight.php";
?>
