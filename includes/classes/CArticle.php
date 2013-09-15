<?php

require_once 'includes/classes/CDatabase.php';
require_once 'includes/classes/CCategory.php';
require 'includes/functions/bbcode.php';


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
            $this->m_categories->attach(new CCategory($database, $r['id']));
        }


        $this->m_authors = $authors;
    }

    /**
     * Saves the article to the databaze.
     */

    public function save() {
        $this->getVariablesToArray();
        if ($this->m_newArticle) {
            $this->m_database->Insert(self::TABLE, $this->m_array);
        } else {
            $where = array('id' => $this->m_id);
            $this->m_database->Update(self::TABLE, $this->m_array, $where);
        }
    }

    public function addCategory(CCategory $category) {
        $this->m_categories->attach($category);
    }

    public function removeCategory(CCategory $category) {
        $this->m_categories->detach($category);
    }
    
    /* ----------------------------------------------------------------------------------------------------------------- */

    //getters and setters
    public function getLink() {
        return $this->m_link;
    }

    public function setLink($link) {
        $this->m_link = $link;
    }

    public function getTitle() {
        return $this->m_title;
    }

    public function setTitle($title) {
        $this->m_title = $title;
    }

    public function getDescription() {
        return $this->m_description;
    }

    public function setDescription($description) {
        $this->m_description = $description;
    }

    public function getText() {
        return $this->m_text;
    }
    
    public function getBBText() {
        return bbcode($this->m_text);
    }

    public function setText($text) {
        $this->m_text = $text;
    }

    public function setTime($time) {
        $this->m_time = $time;
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

    public function getAuthor() {
        /*if (!empty($this->m_autor)) {
            $q = $this->m_database->Query("SELECT nick FROM users WHERE nick = '" . $this->m_autor . "';");
            if (mysql_num_rows($q) > 0) {
                $nick = $this->m_autor;
                return '<a href="profily/' . $nick . '/" title="Profil uživatele ' . $nick . '">' . $nick . '</a>';
            }
            else
                return $this->m_autor;
        } else {
            $q = $this->m_database->Query("SELECT nick FROM users WHERE id = '" . $this->m_id_autor . "';");
            $nick = mysql_result($q, 0);
            return '<a href="profily/' . $nick . '/" title="Profil uživatele ' . $nick . '">' . $nick . '</a>';
        }*/
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /**
     * Gets variables of Article to an array suitable for mysql insert.
     */

    private function getVariablesToArray() {
        $this->m_array = array(
            'link' => $this->m_link,
            'title' => $this->m_title,
            'id' => $this->m_id,
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

class NotFoundException extends Exception {};

?>