<?php
require 'functions/db_error.php';
$db_error = "Omlouváme se návštěvníkům webu, ale nastal nečekaná chyba v databázi.
    Pokud tento problém přetrvá, můžete kontaktovat administrátora na adam.kucera@wrent.cz<br><br>";
//connection
define("CONNECTION", "localhost");
//name of the database
define("DATABASE", "webcore");
//username to access the db
define("USERNAME", "wowherniweb");
//password to access the db
define("PASSWORD", "woWKo4-db;15");
//connect or throw and error
$connection = mysql_connect(CONNECTION, USERNAME, PASSWORD) or die(db_error());
//sets connection charset
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET NAMES utf8");
//chooses the right database
mysql_select_db(DATABASE) or die(db_error());

?>
