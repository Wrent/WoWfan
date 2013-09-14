<?php

/* !
 * All scripts in this folder are used only once for importing the old database 
 * to the new, better one. Some things as user ranks have to be added manually.
 */

header('Content-Type: text/html; charset=utf-8');
require_once '../../classes/CDatabase.php';
require_once './import.php';

//connect to both databases
$database_old = new CDatabase("localhost", "root", "root", "webcore");
$database_old->Connect();

$database_new = new CDatabase("localhost", "aurora", "aurora", "aurora");
$database_new->Connect();

//during the import, foreign keys will not be consistent
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

//make all the other changes consistent again.
$database_new->Query("SET foreign_key_checks = 1;");

//Tables menu and item are not imported, because they will be filled manually.
//Menu will probably differ a lot on the new system.
//Tables site, rank and rank_list will be also filled manually.
?>
