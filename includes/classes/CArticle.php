<?php

require_once 'includes/classes/CDatabase.php';
require_once 'includes/classes/CCategory.php';
require_once 'includes/classes/CUser.php';
require_once 'includes/functions/bbcode.php';
require_once 'includes/functions/isNullOrEmptyString.php';

class CArticle {

    //------------VARIABLES FROM DB-------------------------------
    private $m_link;
    private $m_id;
    private $m_title;
    private $m_description;
    private $m_text;
    private $m_views;
    private $m_rating;
    private $m_auto_spacing;
    private $m_time;
    private $m_comments_cnt;
    private $m_rating_now;
    private $m_source;
    private $m_type;
    // ----------------OBJECT VARIABLES----------------------------
    /**
     * @var SplObjectStorage
     */
    private $m_authors;

    /**
     * @var SplObjectStorage
     */
    private $m_categories;
    // ----------------OTHER VARIABLES-----------------------------
    private $m_array;
    private $m_newArticle;

    /**
     * @var CDatabase
     */
    private $m_database;

    const TABLE = 'article';

    /**
     * New Article object stores all information about article and allows to work with it.
     * @param CDatabase $database Link to the database object, where the article will be stored.
     * @param string $link Unique link of the article, can be NULL (if creating new article)
     * @param int $id Unique id of the article, can be NULL (if creating new article)
     */
    public function __construct(CDatabase $database, $link = NULL, $type = NULL, $id = NULL) {
        $this->m_link = $link;
        $this->m_type = $type;
        $this->m_id = $id;

        $this->m_categories = new SplObjectStorage();
        $this->m_authors = new SplObjectStorage();

        //is this new or existing article?
        if (!isset($link) AND !isset($id)) {
            $this->m_newArticle = true;
            return;
        }
        else
            $this->m_newArticle = false;

        if (isset($link)) {
            $fields = array("*",);
            $where = array(
                "link" => $link,
                "type" => $type,
            );
            $q = $database->Select(self::TABLE, $fields, $where);
        } else {
            $fields = array("*",);
            $where = array(
                "type" => $type,
            );
            $q = $database->Select(self::TABLE, $fields, $where);
        }

        if (!$q) {
            throw new NotFoundException();
        }

        $article = mysql_fetch_array($q);

        $this->m_link = $article["link"];
        $this->m_id = $article["id"];
        $this->m_title = $article["title"];
        $this->m_description = $article["description"];
        $this->m_text = $article["text"];
        $this->m_views = $article["views"];
        $this->m_rating = $article["rating"];
        $this->m_auto_spacing = $article["auto_spacing"];
        $this->m_time = $article["time"];
        $this->m_comments_cnt = $article["comments_cnt"];
        $this->m_rating_now = $article["rating_now"];
        $this->m_source = $article["source"];
        $this->m_type = $article["type"];

        $this->m_array = $article;

        $this->m_database = $database;

        //select all categories
        $q = $database->Query("SELECT id FROM category AS c JOIN being_in_category AS b ON 
            (c.id = b.id_category) WHERE b.id_article = $this->m_id;");

        while ($r = mysql_fetch_array($q)) {
            $this->addCategory(new CCategory($database, $r['id']));
        }


        //select all authors
        $q = $database->Query("SELECT id FROM user AS u JOIN authorship AS a ON 
            (u.id = a.id_user) WHERE a.id_article = $this->m_id;");

        while ($r = mysql_fetch_array($q)) {
            $this->addAuthor(new CUser($database, NULL, $r['id']));
        }
    }

    /**
     * Saves the article to the databaze.
     */
    public function save() {
        $not_null_variables = array(
            $this->m_link,
            $this->m_text,
            $this->m_title,
            $this->m_type,
            $this->m_time,
        );
        foreach ($not_null_variables AS $item) {
            if (IsNullOrEmptyString($item))
                return false;
        }

        if (IsNullOrEmptyString($this->m_description) && $this->m_type != "N")
            return false;


        $this->getVariablesToArray();
        //save article itself
        if ($this->m_newArticle) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }
        //delete all categories
        $where = array("id_article" => $this->m_id);
        $this->m_database->Delete("being_in_category", $where);

        //insert new categories
        foreach ($this->m_categories as $category) {
            $data = array(
                'id_article' => $this->m_id,
                'id_category' => $category->getId(),
            );
            $this->m_database->Insert("being_in_category", $data);
        }
        return TRUE;
    }

    public function addCategory(CCategory $category) {
        if (!$this->m_categories->contains($category)) {
            $this->m_categories->attach($category);
            return TRUE;
        }
        else
            return FALSE;
    }

    public function removeCategory(CCategory $category) {
        if ($this->m_categories->contains($category)) {
            $this->m_categories->detach($category);
        } else {
            return FALSE;
        }
    }

    public function addAuthor(CUser $author) {
        if (!$this->m_authors->contains($author)) {
            $this->m_authors->attach($author);
            return TRUE;
        }
        else
            return FALSE;
    }

    public function removeAuthor(CUser $author) {
        if (!$this->m_authors->contains($author)) {
            $this->m_authors->attach($author);
            return TRUE;
        }
        else
            return FALSE;
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    //getters and setters
    public function getLink() {
        return $this->m_link;
    }

    public function setLink($link) {
        if (IsNullOrEmptyString($link))
            return FALSE;
        $where = array('link' => $link,);
        if ($this->m_database->Count(self::TABLE, 'link', $where) == 0) {
            $this->m_link = $link;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getTitle() {
        return $this->m_title;
    }

    public function setTitle($title) {
        if (IsNullOrEmptyString($title))
            return FALSE;
        $this->m_title = $title;
    }

    public function getDescription() {
        return $this->m_description;
    }

    public function getBBDescription() {
        if ($this->m_auto_spacing)
            $text = str_replace('\n', '<br>\n', $this->m_description);
        else
            $text = $this->m_description;
        return bbcode($text);
    }

    public function setDescription($description) {
        if (IsNullOrEmptyString($description) && $this->m_type != "N")
            return FALSE;
        $this->m_description = $description;
    }

    public function getText() {
        return $this->m_text;
    }

    public function getBBText() {
        if ($this->m_auto_spacing)
            $text = str_replace('\n', '<br>\n', $this->m_text);
        else
            $text = $this->m_text;
        return bbcode($text);
    }

    public function setText($text) {
        if (IsNullOrEmptyString($text))
            return FALSE;
        $this->m_text = $text;
    }

    public function setTime($time) {
        if (!is_numeric($time))
            return FALSE;
        $this->m_time = $time;
        return TRUE;
    }

    public function getType() {
        return $this->m_type;
    }

    public function setType($type) {
        if ($type == "C" || $type == "U" || $type == "N") {
            $this->m_type = $type;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getTime() {
        return $this->m_time;
    }

    public function getDay() {
        return Date("d", $this->m_time);
    }

    public function getMonth() {
        return Date("m", $this->m_time);
    }

    public function getYear() {
        return Date("Y", $this->m_time);
    }

    public function getHour() {
        return Date("h", $this->m_time);
    }

    public function getMinute() {
        return Date("i", $this->m_time);
    }

    public function getCategories() {
        return $this->m_categories;
    }

    public function printCategories() {
        foreach ($this->m_categories as $category) {
            echo "> ";
            echo $category->getTitle();
        }
    }

    public function getAuthors() {
        return $this->m_authors;
    }

    public function printAuthors($links = TRUE) {
        $i = 0;
        /* @var $author CUser */
        foreach ($this->m_authors as $author) {
            if ($i > 0)
                echo ", ";
            if ($links)
                echo "<a href='profily/" . $author->getNick() . "/'>";

            echo $author->getNick();

            if ($author->getName() || $author->getSurname()) {
                echo "(";
                echo $author->getName() . " ";
                echo $author->getSurname();
                echo ")";
            }
            if ($links)
                echo "</a>";

            $i++;
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /**
     * Gets variables of Article to an array suitable for mysql insert.
     */
    private function getVariablesToArray() {
        $this->m_array = array(
            'link' => $this->m_link,
            'title' => $this->m_title,
            'description' => $this->m_description,
            'text' => $this->m_text,
            'views' => $this->m_views,
            'rating' => $this->m_rating,
            'auto_spacing' => $this->m_auto_spacing,
            'time' => $this->m_time,
            'comments_cnt' => $this->m_comments_cnt,
            'rating_now' => $this->m_rating_now,
            'source' => $this->m_source,
            'type' => $this->m_type,
        );
    }

}

class NotFoundException extends Exception {
    
}

;
?>