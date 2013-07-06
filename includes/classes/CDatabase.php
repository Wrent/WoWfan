<?php 

class CDatabase{
	/*!
	 * New object of Database just stores the data about the database.
	 * \param $host The adress of the database server.
	 * \param $login Login name of the database user.
	 * \param $password Password of the database user.
	 * \param $database Specifies the database to use. 
	 */
	public function __construct($host, $login, $password, $database){
		$this->m_host = $host;
		$this->m_login = $login;
		$this->m_password = $password;
		$this->m_database = $database;
	}


	public function __destruct(){
		mysql_close($this->m_connection);
	}

	/*!
	 * Tries to establish new connection to the database.
	 */
	public function Connect(){
		$this->m_connection = mysql_connect($this->m_host, $this->m_login, $this->m_password) or die($this->ThrowError(mysql_error()));

		mysql_query("SET CHARACTER SET utf8") or die($this->ThrowError(mysql_error()));
		mysql_query("SET NAMES utf8")or die($this->ThrowError(mysql_error()));
		//chooses the right database
		mysql_select_db($this->m_database) or die($this->ThrowError(mysql_error()));
	}

	/*!
	 * Inserts an item to the table.
	 * \param $table The name of the table.
	 * \param $item Item to be added. It must be an array with keys named the same way like in the table.
	 */
	public function Insert($table, $item){
		$query = "INSERT INTO " . $table . " ("; 
		foreach ($item as $key => $value) {
				$collumns [] = Escape($key);
				$values [] = Escape($value);
			}	
		$query .= implode(",",$collumns) . ") VALUES (" . implode(",", $values) . ");";
		
		mysql_query($query) or die($this->ThrowError(mysql_error()));
	}

	/*!
	 * Perfoms query with error handler.
	 * \param $query The query to use.
	 */
	public function Query($query){
		$q = mysql_query($query) or die($this->ThrowError(mysql_error()));
		return $q;
	}

	public function Escape($string) {
		return mysql_real_escape_string($string);
	}


	/* ----------------------------------------------------------------------------------------------------------------- */

	/*!
	 * Handler for the database errors, it will print the error and tries to save it to the logs table
	 * \param $error Error message from the database.
	 */
	private function ThrowError($error){
		echo "<br><br>Omlouváme se návštěvníkům webu, ale nastala nečekaná chyba v databázi.
    		Pokud tento problém přetrvá, můžete kontaktovat administrátora na adam.kucera@wrent.cz.<br><br>
    		Díky, tým WoWfan.cz.<br><br>";
    	echo "Text chyby: " . $error . "<br><br>";

    	$errorLog = array('msg' => $error);

    	$this->Insert("error_log", $errorLog); 
	}

	private $m_host;
	private $m_login;
	private $m_password;
	private $m_database;

	private $m_connection;
}
?>