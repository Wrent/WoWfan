<?php

class CArticle {

    private $m_link;
    private $m_id;
    private $m_nazev;
    private $m_kategorie;
    private $m_popis;
    private $m_text;
    private $m_id_autor;
    private $m_autor;
    private $m_shlednuti;
    private $m_hodnoceni;
    private $m_hlasujici;
    private $m_odradkovani;
    private $m_time;
    private $m_pocet_komentaru;
    private $m_now_hodnoceni;
    private $m_zdroj;
    private $m_datum;
    private $m_typ;
    private $m_array;
    private $m_newArticle;
    private $m_database;

    /* !
     * New Article object stores all information about article and allows to work with it.
     * \param $link Unique link of the article, can be NULL (if creating new article)
     * \param $id Unique id of the article, can be NULL (if creating new article)
     */

    public function __construct($database, $link = NULL, $id = NULL) {
        $this->m_link = $link;
        $this->m_id = $id;

        if (!isset($link) AND !isset($id)) {
            $this->m_newArticle = true;
            return;
        }
        else
            $this->m_newArticle = false;

        if (isset($link)) {
            $link = $database->Escape($link);
            $q = $database->Query("SELECT * FROM clanky WHERE link = '" . $link . "' AND typ = 'C';");
        } else {
            $id = $database->Escape($id);
            $q = $database->Query("SELECT * FROM clanky WHERE id = '" . $id . "' AND typ = 'C';");
        }

        $article = mysql_fetch_array($q);

        $this->m_link = $article["link"];
        $this->m_id = $article["id"];
        $this->m_nazev = $article["nazev"];
        $this->m_kategorie = $article["kategorie"];
        $this->m_popis = $article["popis"];
        $this->m_text = $article["text"];
        $this->m_id_autor = $article["id_autor"];
        $this->m_autor = $article["autor"];
        $this->m_shlednuti = $article["shlednuti"];
        $this->m_hodnoceni = $article["hodnoceni"];
        $this->m_hlasujici = $article["hlasujici"];
        $this->m_odradkovani = $article["odradkovani"];
        $this->m_time = $article["time"];
        $this->m_pocet_komentaru = $article["pocet_komentaru"];
        $this->m_now_hodnoceni = $article["now_hodnoceni"];
        $this->m_zdroj = $article["zdroj"];
        $this->m_typ = $article["typ"];
        $this->m_datum = $article["datum"];

        $this->m_array = $article;

        $this->m_database = $database;
    }

    /* !
     * Saves the article to the databaze.
     */

    public function save() {
        if ($this->m_newArticle) {
            $this->getVariablesToArray();

            unset($value);

            $this->m_database->Insert("clanky", $this->m_array);
        } else {
            $this->m_nazev = $this->m_database->Escape($this->m_nazev);
            $this->m_popis = $this->m_database->Escape($this->m_popis);
            $this->m_kategorie = $this->m_database->Escape($this->m_kategorie);
            $this->m_text = $this->m_database->Escape($this->m_text);
            $this->m_id_autor = $this->m_database->Escape($this->m_id_autor);
            $this->m_autor = $this->m_database->Escape($this->m_autor);
            $this->m_link = $this->m_database->Escape($this->m_link);
            $this->m_odradkovani = $this->m_database->Escape($odradkovani);
            $this->m_typ = $this->m_database->Escape($typ);
            $this->m_database->Query("UPDATE clanky SET nazev='" . $this->m_nazev . "', popis='" . $this->m_popis . "', kategorie='" . $this->m_kategorie . "', text='" . $this->m_text . "', id_autor='" . $this->m_id_autor . "', autor='" . $this->m_autor . "', link='" . $this->m_link . "', odradkovani='" . $this->m_odradkovani . "' WHERE link = '" . $this->m_link . "' AND typ = '" . $this->m_typ . "';");
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    //getters and setters
    public function getLink() {
        return $this->m_link;
    }

    public function setLink($link) {
        $this->m_link = $link;
    }

    public function getNazev() {
        return $this->m_nazev;
    }

    public function setNazev($nazev) {
        $this->m_nazev = $nazev;
    }

    public function getPopis() {
        return $this->m_popis;
    }

    public function setPopis($popis) {
        $this->m_popis = $popis;
    }

    public function getText() {
        return $this->m_text;
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
        if (!empty($this->m_datum) AND $this->m_datum != "NULL") {
            preg_match('/([0-9]{1,2})\..*/', $this->m_datum, $matches);
            return $matches[1];
        } else {
            return Date("d", $this->m_time);
        }
    }

    public function getMonth() {
        if (!empty($this->m_datum) AND $this->m_datum != "NULL") {
            preg_match('/[0-9]{1,2}\.([0-9]{1,2}).*/', $this->m_datum, $matches);
            return $matches[1];
        } else {
            return Date("m", $this->m_time);
        }
    }

    public function getYear() {
        if (!empty($this->m_datum) AND $this->m_datum != "NULL") {
            preg_match('/[0-9]{1,2}\.[0-9]{1,2}\.([0-9]{4,4}).*/', $this->m_datum, $matches);
            return $matches[1];
        } else {
            return Date("Y", $this->m_time);
        }
    }

    public function getHour() {
        if (!empty($this->m_datum) AND $this->m_datum != "NULL") {
            preg_match('/.*\| ([0-9]{1,2}).*/', $this->m_datum, $matches);
            return $matches[1];
        } else {
            return Date("h", $this->m_time);
        }
    }

    public function getMinute() {
        if (!empty($this->m_datum) AND $this->m_datum != "NULL") {
            preg_match('/.*\| [0-9]{1,2}:([0-9]{1,2}).*/', $this->m_datum, $matches);
            return $matches[1];
        } else {
            return Date("i", $this->m_time);
        }
    }

    public function getAutor() {
        if (!empty($this->m_autor)) {
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
        }
    }

    /* ----------------------------------------------------------------------------------------------------------------- */

    /* !
     * Gets variables of Article to an array suitable for mysql insert.
     */

    private function getVariablesToArray() {
        $this->m_array = array(
            'link' => $this->m_link,
            'id' => $this->m_id,
            'kategorie' => $this->m_kategorie,
            'popis' => $this->m_popis,
            'text' => $this->m_text,
            'id_autor' => $this->m_id_autor,
            'autor' => $this->m_autor,
            'shlednuti' => $this->m_shlednuti,
            'hodnoceni' => $this->m_hodnoceni,
            'hlasujici' => $this->m_hlasujici,
            'odradkovani' => $this->m_odradkovani,
            'time' => $this->m_time,
            'pocet_komentaru' => $this->m_pocet_komentaru,
            'now_hodnoceni' => $this->m_now_hodnoceni,
            'zdroj' => $this->m_zdroj,
            'typ' => $this->m_typ,
            'datum' => $this->m_datum,
        );
    }

}
?>