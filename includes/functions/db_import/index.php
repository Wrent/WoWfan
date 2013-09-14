<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../../classes/CDatabase.php';
require_once './import.php';

//connect to both databases
$database_old = new CDatabase("localhost", "root", "root", "webcore");
$database_old->Connect();

$database_new = new CDatabase("localhost", "aurora", "aurora", "aurora");
$database_new->Connect();

$database_new->Query("SET foreign_key_checks = 0;");

include "category.php";
include "highlight.php";
//include "log.php";
include "user.php";
include "ip_usage.php";
include "comment.php";
include "article.php";
include "being_in_category.php";
include 'article_rated.php';
include 'authorship.php';

$database_new->Query("SET foreign_key_checks = 1;");

//Tables menu and item are not imported, because they will be filled manually.
//Tables site, rank and rank_list will be also filled manually.

?>
