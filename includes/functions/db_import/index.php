<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../../classes/CDatabase.php';
require_once './import.php';

//connect to both databases
$database_old = new CDatabase("localhost", "wowherniweb", "woWKo4-db;15", "webcore");
$database_old->Connect();

$database_new = new CDatabase("localhost", "root", "root", "aurora");
$database_new->Connect();

$database_new->Query("SET foreign_key_checks = 0;");

include "category.php";
include "menu.php";
include "highlight.php";

$database_new->Query("SET foreign_key_checks = 1;");
?>
