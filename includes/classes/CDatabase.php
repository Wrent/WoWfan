<?php

class CDatabase {

    private $m_host;
    private $m_login;
    private $m_password;
    private $m_database;
    private $m_connection;

    /* !
     * New object of Database just stores the data about the database.
     * \param $host The adress of the database server.
     * \param $login Login name of the database user.
     * \param $password Password of the database user.
     * \param $database Specifies the database to use. 
     */

    public function __construct($host, $login, $password, $database) {
        $this->m_host = $host;
        $this->m_login = $login;
        $this->m_password = $password;
        $this->m_database = $database;
    }

    public function __destruct() {
        mysql_close($this->m_connection);
    }

    /* !
     * Tries to establish new connection to the database.
     */

    public function Connect() {
        $this->m_connection = mysql_connect($this->m_host, $this->m_login, $this->m_password) or die($this->ThrowError(mysql_error($this->m_connection)));

        mysql_query("SET CHARACTER SET utf8", $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection)));
        mysql_query("SET NAMES utf8", $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection)));
        //chooses the right database
        mysql_select_db($this->m_database, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection)));
    }

    /* !
     * Inserts an item to the table and escapes them.
     * \param $table The name of the table.
     * \param $item Item to be added. It must be an array with keys named the same way like in the table.
     * \param $forget_error If set to TRUE, possible errors will not be printed or handled.
     */

    public function Insert($table, $item, $forget_error = FALSE) {
        $query = "INSERT INTO " . $table . " (";
        foreach ($item as $key => $value) {
            $collumns [] = $this->Escape($key);
            $values [] = $this->Escape($value);
        }

        //makes values strings
        foreach ($values as &$value) {
            $value = "'" . $value . "'";
        }

        //composes the query
        $query .= implode(",", $collumns) . ") VALUES (" . implode(",", $values) . ");";

        if ($forget_error)
            mysql_query($query, $this->m_connection);
        else
            mysql_query($query, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection), $query));
    }
    
    /* !
     * Updates an item in the table.
     * \param $table The name of the table.
     * \param $item Items to be updated. It must be an array with keys named the same way like in the table.
     * \param $where Condition for update. It is also a key => value array sam as in the table.
     * \param $logic If you want to change the logic of the condition, you can here, ig. OR.
     * \param $forget_error If set to TRUE, possible errors will not be printed or handled.
     */

    public function Update($table, $items, $where, $logic = "AND", $forget_error = FALSE) {
        $query = "UPDATE " . $table . " SET ";
        foreach ($items as $key => $value) {
            $collumns [] = $this->Escape($key);
            $values [] = $this->Escape($value);
        }

        //makes values strings
        foreach ($values as &$value) {
            $value = "'" . $value . "'";
        }

        //composes the query
        for ($i=0; $i < count($items); $i++) {
            if($i > 0)
                $query .= ", ";
            $query .= $collumns[$i].'='.$values[$i];
        }
        if ($where != NULL) {
            $query .= " WHERE ";
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i > 0)
                    $query .= " $logic ";
                $query .= $this->Escape($key);
                $query .= " = '";
                $query .= $this->Escape($value);
                $query .= "'";
                $i++;
            }
        }
        $query .= ";";

        if ($forget_error)
            mysql_query($query, $this->m_connection);
        else
            mysql_query($query, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection), $query));
    }

    /* !
     * Perfoms query with error handler.
     * \param $query The query to use.
     * \param $forget_error If set to TRUE, possible errors will not be printed or handled.
     * \return Performed query object.
     */

    public function Query($query, $forget_error = FALSE) {
        if ($forget_error)
            $q = mysql_query($query, $this->m_connection);
        else
            $q = mysql_query($query, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection), $query));

        return $q;
    }

    /* !
     * Escapes the string for the safe use in the database.
     * \param $string String to escape..
     * \return Escaped string.
     */

    public function Escape($string) {
        return mysql_real_escape_string($string, $this->m_connection);
    }

    /* !
     * Return the count of the field in the table.
     * \param $table Table to use.
     * \param $field Field to use.
     * \return Count of the field.
     */

    public function Count($table, $field) {
        $query = "SELECT COUNT($field) FROM $table;";
        $q = mysql_query($query, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection), $query));
        return mysql_result($q, 0);
    }

    /* !
     * Selects single result from the field in the table using the where clausule.
     * \param $table Table to use.
     * \param $field Field to use.
     * \param $where Array of the condition. Key represents field and value the value.
     * \param $logic Can be changed to ig. OR.
     * \return Single result or FALSE, if no result.
     */
    public function SelectSingle($table, $field, $where = NULL, $logic = "AND") {
        $query = "SELECT $field FROM $table";
        if ($where != NULL) {
            $query .= " WHERE ";
            $i = 0;
            foreach ($where as $key => $value) {
                if ($i > 0)
                    $query .= " $logic ";
                $query .= $this->Escape($key);
                $query .= " = '";
                $query .= $this->Escape($value);
                $query .= "'";
                $i++;
            }
        }
        $q = mysql_query($query, $this->m_connection) or die($this->ThrowError(mysql_error($this->m_connection), $query));
        if (mysql_num_rows($q) > 0)
            return mysql_result($q, 0);
        else
            return FALSE;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /* !
     * Handler for the database errors, it will print the error and tries to save it to the logs table
     * \param $error Error message from the database.
     * \param $query Contains the query, where error was thrown.
     */

    private function ThrowError($error, $query = "") {
        echo "<br><br>Omlouváme se návštěvníkům webu, ale nastala nečekaná chyba v databázi.
    		Pokud tento problém přetrvá, můžete kontaktovat administrátora na adam.kucera@wrent.cz.<br><br>
    		Díky, tým WoWfan.cz.<br><br>";
        echo "Text chyby: " . $error . "<br><br>";
        if ($query != "")
            echo "Původní dotaz: " . $query . "<br><br>";

        $errorLog = array('msg' => $error . " - " . $query);

        //TO DO TO DO TO DO TO DO TO DO
        //this insert will not be logged, if it failes, it can cause a recursive deadlock
        $this->Insert("error_log", $errorLog, TRUE);
    }

}

?>