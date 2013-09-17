<?php

require_once 'includes/classes/CDatabase.php';

class CUser {

    //------------VARIABLES FROM DB-------------------------------
    private $m_nick;
    private $m_id;
    private $m_password;
    private $m_name;
    private $m_surname;
    private $m_residence;
    private $m_email;
    private $m_icq;
    private $m_skype;
    private $m_url;
    private $m_activated;
    private $m_warnings;
    private $m_last_warned;
    private $m_newsletter;
    private $m_info;
    // ----------------OTHER VARIABLES-----------------------------
    private $m_array;
    private $m_newUser;
    private $m_database;

    const TABLE = 'user';

    /**
     * New User object stores all information about user and allows to work with it.
     * @param $database Link to the database object, where the category will be stored.
     * @param $nick Unique nick of a user
     * @param $id Unique id of the user, can be NULL (if creating new user)
     */
    public function __construct($database, $nick = NULL, $id = NULL) {
        $this->m_id = $id;
        $this->m_nick = $nick;
        

        //is this new or existing article?
        if (!isset($nick) && !isset($id)) {
            $this->m_newUser = true;
            return;
        }
        else
            $this->m_newUser = false;

        $id = $database->Escape($id);
        $q = $database->Query("SELECT * FROM " . self::TABLE . " WHERE id = '$id';");


        $user = mysql_fetch_array($q);


        $this->m_id = $user["id"];
        $this->m_nick = $user["nick"];

        $this->m_array = $user;

        $this->m_database = $database;
    }

    /* !
     * Saves the user to the databaze.
     */

    public function save() {
         $not_null_variables = array(
            $this->m_nick,
            $this->m_email,
        );
        foreach ($not_null_variables AS $item) {
            if (IsNullOrEmptyString($item))
                return false;
        }
        
        
        $this->getVariablesToArray();
        if ($this->m_newUser) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    public function getNick() {
        return $this->m_nick;
    }

    public function setNick($nick) {
        if (IsNullOrEmptyString($nick))
            return FALSE;
        $where = array('nick' => $nick,);
        if ($this->m_database->Count(self::TABLE, 'nick', $where) == 0) {
            $this->m_nick = $nick;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getPassword() {
        return $this->m_password;
    }

    public function setPassword($password) {
        if (IsNullOrEmptyString($password))
            return FALSE;
        $this->m_password = $password;
        return TRUE;
    }

    public function getName() {
        return $this->m_name;
    }

    public function setName($name) {
        $this->m_name = $name;
    }

    public function getSurname() {
        return $this->m_surname;
    }

    public function setSurname($surname) {
        $this->m_surname = $surname;
    }

    public function getResidence() {
        return $this->m_residence;
    }

    public function setResidence($residence) {
        $this->m_residence = $residence;
    }

    public function getEmail() {
        return $this->m_email;
    }

    public function setEmail($email) {
        if (IsNullOrEmptyString($email))
            return FALSE;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return FALSE;
        $where = array('email' => $email,);
        if ($this->m_database->Count(self::TABLE, 'email', $where) == 0) {
            $this->m_email = $email;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getIcq() {
        return $this->m_icq;
    }

    public function setIcq($icq) {
        if (!is_numeric($icq) && !IsNullOrEmptyString($icq))
            return FALSE;
        $this->m_icq = $icq;
        return TRUE;
    }

    public function getSkype() {
        return $this->m_skype;
    }

    public function setSkype($skype) {
        $this->m_skype = $skype;
    }

    public function getUrl() {
        return $this->m_url;
    }

    public function setUrl($url) {
        if (!filter_var($url, FILTER_VALIDATE_URL) && !IsNullOrEmptyString($icq))
            return FALSE;
        $this->m_url = $url;
    }

    public function getActivated() {
        return $this->m_activated;
    }

    public function setActivated($activated) {
        $this->m_activated = $activated;
    }

    public function getWarnings() {
        return $this->m_warnings;
    }

    public function setWarnings($warnings) {
        if (!is_numeric($warnings) && !IsNullOrEmptyString($warnings))
            return FALSE;
        $this->m_warnings = $warnings;
    }

    public function getLast_warned() {
        return $this->m_last_warned;
    }

    public function setLast_warned($last_warned) {
        if (!is_numeric($last_warned) && !IsNullOrEmptyString($last_warned))
            return FALSE;
        $this->m_last_warned = $last_warned;
    }

    public function getNewsletter() {
        return $this->m_newsletter;
    }

    public function setNewsletter($newsletter) {
        $this->m_newsletter = $newsletter;
    }

    public function getInfo() {
        return $this->m_info;
    }

    public function setInfo($info) {
        $this->m_info = $info;
    }

    public function getId() {
        return $this->m_id;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /**
     * Gets variables of category to an array suitable for mysql insert.
     */
    private function getVariablesToArray() {
        $this->m_array = array(
            'nick' => $this->m_nick,
            'password' => $this->m_password,
            'name' => $this->m_name,
            'surname' => $this->m_surname,
            'residence' => $this->m_residence,
            'email' => $this->m_email,
            'icq' => $this->m_icq,
            'skype' => $this->m_skype,
            'url' => $this->m_url,
            'activated' => $this->m_activated,
            'warnings' => $this->m_warnings,
            'last_warned' => $this->m_last_warned,
            'newsletter' => $this->m_newsletter,
            'info' => $this->m_info,
        );
    }

}

?>