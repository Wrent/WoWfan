<?php

require_once 'includes/classes/CDatabase.php';

class CComment {

    //------------VARIABLES FROM DB-------------------------------
    private $m_id;
    private $m_id_article;
    private $m_text;
    private $m_time;
    private $m_score;
    private $m_reply_to;
    //----------------OBJECT VARIABLES-----------------------------
    /**
     * @var CUser
     */
    private $m_author;
    // ----------------OTHER VARIABLES-----------------------------
    private $m_array;
    private $m_newComment;

    /**
     * @var CDatabase
     */
    private $m_database;

    const TABLE = 'comment';

    /**
     * New Comment object stores all information about comment and allows to work with it.
     * @param $database Link to the database object, where the category will be stored.
     * @param $id Unique id of the comment, can be NULL (if creating new comment)
     */
    public function __construct(CDatabase $database, $id = NULL) {
        $this->m_id = $id;


        //is this new or existing article?
        if (!isset($id)) {
            $this->m_newComment = true;
            return;
        }
        else
            $this->m_newComment = false;

        $fields = array("*",);
        $where = array(
            "id" => $id,
        );
        $q = $database->Select(self::TABLE, $fields, $where);


        $comment = mysql_fetch_array($q);


        $this->m_id = $comment["id"];
        $this->m_id_article = $comment["id_article"];
        $this->m_text = $comment["text"];
        $this->m_time = $comment["time"];
        $this->m_score = $comment["score"];
        $this->m_reply_to = $comment["reply_to"];

        $this->m_array = $comment;

        $this->m_database = $database;

        //select author
        $where = array('id' => $comment['id_user']);
        $r = $this->m_database->SelectSingle('user', 'id', $where);

        $this->m_author = new CUser($database, NULL, $r);
    }

    /**
     * Saves the comment to the databaze.
     */
    public function save() {
        $not_null_variables = array(
            $this->m_id_article,
            $this->m_author,
            $this->m_text,
            $this->m_time,
        );
        foreach ($not_null_variables AS $item) {
            if (IsNullOrEmptyString($item))
                return false;
        }


        $this->getVariablesToArray();
        if ($this->m_newComment) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }

        return TRUE;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    public function getId() {
        return $this->m_id;
    }

    public function getIdd_article() {
        return $this->m_id_article;
    }

    public function setId_article($id_article) {
        //article must exist
        $where = array('id' => $id_article,);
        if ($this->m_database->Count('article', 'id', $where) == 0) {
            return FALSE;
        } else {
            $this->m_id_article = $id_article;
            return TRUE;
        }
    }

    public function getText() {
        return $this->m_text;
    }

    public function setText($text) {
        if (IsNullOrEmptyString($text))
            return FALSE;
        $this->m_text = $text;
        return TRUE;
    }

    public function getTime() {
        return $this->m_time;
    }

    public function setTime($time) {
        if (!is_numeric($time))
            return FALSE;
        $this->m_time = $time;
        return TRUE;
    }
    
    public function getScore() {
        return $this->m_score;
    }

    public function setScore($score) {
        if (!is_numeric($score))
            return FALSE;
        $this->m_score = $score;
        return TRUE;
    }
    
    public function scoreIncrease() {
        $this->m_score++;
    }
    
    public function scoreDecrease() {
        $this->m_score--;
    }

    public function getAuthor() {
        return $this->m_author;
    }

    public function setAthor(CUser $author) {
        try {
            $a = new CUser($this->m_database, NULL, $author->getId());
            $this->m_author = $author;
            return TRUE;
        } catch (NotFoundException $e) {
            return FALSE;
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /**
     * Gets variables of category to an array suitable for mysql insert.
     */
    private function getVariablesToArray() {
        $this->m_array = array(
            'id_article' => $this->m_id_article,
            'id_user' => $this->m_author->getId(),
            'text' => $this->m_text,
            'time' => $this->m_time,
            'score' => $this->m_score,
            'reply_to' => $this->m_reply_to,
        );
    }

}

?>