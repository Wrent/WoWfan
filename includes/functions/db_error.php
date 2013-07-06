<?php

//this functions handles database errors, it informs user and it saves the error as well (tries to)
function db_error() {
    $error_message = "<br><br>Omlouváme se návštěvníkům webu, ale nastala nečekaná chyba v databázi.
    Pokud tento problém přetrvá, můžete kontaktovat administrátora na adam.kucera@wrent.cz<br><br>";

    /*
     * error handling, which will be added later
     * it will try to save error to the database and if it is not possible,
     * it will send the error to specified email adress
     * 
     */

    return $error_message . mysql_error();
}

?>
