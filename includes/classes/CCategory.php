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

    /* !
     * New Category object stores all information about category and allows to work with it.
     * \param $database Link to the database object, where the category will be stored.
     * \param $id Unique id of the category, can be NULL (if creating new category)
     */

    public function __construct($database, $id = NULL) {
        $this->m_id = $id;

        //is this new or existing article?
        if (!isset($id)) {
            $this->m_newCategory = true;
            return;
        }
        else
            $this->m_newCategory = false;

        $id = $database->Escape($id);
        $q = $database->Query("SELECT * FROM " . self::TABLE . " WHERE id = '$id';");


        $category = mysql_fetch_array($q);


        $this->m_id = $category["id"];
        $this->m_title = $category["title"];

        $this->m_array = $category;

        $this->m_database = $database;
    }

    /* !
     * Saves the category to the databaze.
     */

    public function save() {
        $this->getVariablesToArray();
        if ($this->m_newCategory) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }
    }
    /* ----------------------------------------------------------------------------------------------------------------- */

    public function getTitle() {
        return $this->m_title;
    }
    
    public function setTitle($title) {
        $this->m_title = $title;
    }
    
    public function getId() {
        return $this->m_id;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /* !
     * Gets variables of category to an array suitable for mysql insert.
     */

    private function getVariablesToArray() {
        $this->m_array = array(
            'title' => $this->m_title,
            'id' => $this->m_id,
        );
    }

}

?>