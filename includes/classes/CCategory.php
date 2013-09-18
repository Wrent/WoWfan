<?php

require_once 'includes/classes/CDatabase.php';

class CCategory {

    //------------VARIABLES FROM DB-------------------------------
    private $m_title;
    private $m_id;
    // ----------------OTHER VARIABLES-----------------------------
    private $m_array;
    private $m_newCategory;
    private $m_database;

    const TABLE = 'category';

    /**
     * New Category object stores all information about category and allows to work with it.
     * @param $database Link to the database object, where the category will be stored.
     * @param $id Unique id of the category, can be NULL (if creating new category)
     */
    public function __construct($database, $id = NULL) {
        $this->m_id = $id;

        //is this new or existing category?
        if (!isset($id)) {
            $this->m_newCategory = true;
            return;
        }
        else
            $this->m_newCategory = false;

        $fields = array("*",);
        $where = array(
            "id" => $id,
        );
        $q = $database->Select(self::TABLE, $fields, $where);


        $category = mysql_fetch_array($q);


        $this->m_id = $category["id"];
        $this->m_title = $category["title"];

        $this->m_array = $category;

        $this->m_database = $database;
    }

    /**
     * Saves the category to the databaze.
     */
    public function save() {
        $not_null_variables = array(
            $this->m_title,
        );
        foreach ($not_null_variables AS $item) {
            if (IsNullOrEmptyString($item))
                return FALSE;
        }

        $this->getVariablesToArray();
        if ($this->m_newCategory) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }
        return TRUE;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    public function getTitle() {
        return $this->m_title;
    }

    public function setTitle($title) {
        if (IsNullOrEmptyString($title))
            return FALSE;
        $where = array('title' => $title,);
        if ($this->m_database->Count(self::TABLE, 'title', $where) == 0) {
            $this->m_title = $title;
            return TRUE;
        } else {
            return FALSE;
        }
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
            'title' => $this->m_title,
        );
    }

}

?>