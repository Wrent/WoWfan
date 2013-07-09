<?php
header('Content-Type: text/html; charset=utf-8');
require_once 'includes/classes/CDatabase.php';
require_once 'includes/classes/CArticle.php';
///zkouska

$database = new CDatabase("localhost", "wowherniweb", "woWKo4-db;15", "webcore");
$database->Connect();



require_once "includes/html/head.php";
?>
    <body>
        <a name="top"></a>
        <div class="top">
            <div class="top_web">
                <div class="badges">
                    <img src="pic/design/badges/community_challenge.jpg" alt="4th place community fan sites challenge 2011">  
                </div>

                <div class="login">
                    <form style="display: inline" action="" method="post">
                        <input class="login_item" value="Username" type="text">
                        <input class="login_item" value="Password" type="password">
                    </form>
                </div>

                <div class="social">
                    <img src="pic/design/social/facebook.png" alt="wowfan.cz on facebook">
                    <img src="pic/design/social/twitter.png" alt="wowfan.cz on twitter">
                    <img src="pic/design/social/rss.png" alt="wowfan.cz's RSS">  
                </div>
            </div>         
        </div>     
        
        <div class="web">
            <div class="logo">
                <img src="pic/design/wowfan_logo.png" alt="wowfan.cz official fan site logo">
            </div>

            <div class="banner_top">
                <img src="pic/design/adds/banner_top_blank.jpg" alt="banner blank">
            </div>

            <div class="menu">
                <div class="menuentry" id="menu1" style="padding-left: 8px;">
                    <div class="menutitle" id="menutitle1">
                        Hlavní stránka
                    </div>
                    <div class="submenu" id="submenu1">
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                    </div>
                </div>
                <div class="menuentry" id="menu2">
                    <div class="menutitle" id="menutitle2">
                        Povolání
                    </div>
                    <div class="submenu" id="submenu2">
                        2Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                    </div>
                </div>
                <div class="menuentry" id="menu3">
                    <div class="menutitle" id="menutitle3">
                        Cataclysm
                    </div>
                    <div class="submenu" id="submenu3">
                        3Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Porno s Ellem<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Sex u Hanzika<br>
                        <img src="pic/design/menu_u_sep.png" alt="menu separator" class="menusep"><br>
                        Jerryho pohádky
                    </div>
                </div>
            </div>


            <div class="boxes">
                <div class="leftbox">
                    <div class="top_news">
                        <img class="top_news_logo" src="pic/design/temp/news_logo.jpg" alt="temporary news logo" id="top_news_logo1">
                        <img class="top_news_logo" src="pic/design/temp/news_logo2.jpg" alt="temporary news logo 2" id="top_news_logo2">
                        <img class="top_news_logo" src="http://wowfan.tiscali.cz/pic/podcast/wowfanpodcast.jpg" alt="temporary news logo 3" id="top_news_logo3">
                        <img class="top_news_logo" src="http://media.wowfan.cz/blizzcon/11/mop-logo.jpg" alt="temporary news logo 4" id="top_news_logo4">
                        <img class="top_news_logo" src="http://media.wowfan.cz/news/wowfan2011.jpg" alt="temporary news logo 5" id="top_news_logo5">
                    </div>
                    <div class="arrow_left_big">

                    </div>
                    <div class="arrow_right_big">
                        
                    </div>
                </div>

                <div class="rightbox">  
                   <?php require_once "includes/rightbox.php";?>
                </div>
            </div>

            <div class="hotnews">
                Dnes byl oznámen nový datadisk pro WoW - Mists of Pandaria! Nová rasa a povolání!
            </div>

            <div class="content">
                <div class="content_top">
                    Reklama xzone nebo nějaká jiná kravina. Reklama xzone nebo nějaká jiná kravina.
                </div>



                <div class="mainpage_menu">
                    <div class="mainpage_menuentry" style="padding-left: 35px;">
                        <img class="mainpage_menu_arrow" src="pic/design/arrow_selected.png" alt="selected type" id="arrow_hot">
                        ŽHAVÉ NOVINKY
                    </div>
                    <div class="mainpage_menuentry">
                        <img class="mainpage_menu_arrow" src="pic/design/arrow_selected.png" alt="selected type" id="arrow_news">
                        NOVINKY
                    </div>
                    <div class="mainpage_menuentry">
                        <img class="mainpage_menu_arrow" src="pic/design/arrow_selected.png" alt="selected type" id="arrow_articles">
                        ČLÁNKY
                    </div>
                </div>
                <?php
                if (isset($_GET["presenter"]))
                    require_once "includes/presenters/".$_GET["presenter"].".php";
                else require_once "presenter.html";

                ?>


                
                <div class="content_bottom">
                    Reklama xzone nebo nějaká jiná kravina. Reklama xzone nebo nějaká jiná kravina.
                </div>
            </div>

            <div class="rightmenu">
                <div class="rightmenu_header" id="rightmenu_header_1">
                    OFFICIAL FANSITE
                </div>
                <div class="rightmenu_item_image">
                    <img src="pic/design/rightmenu_banners/blizzard.jpg" alt="Official Czech and Slovak World of Warcraft Fansite - Blizzard programme">
                </div>

                <div class="rightmenu_header">
                    DŮLEŽITÉ ČLÁNKY
                </div>
                <div class="rightmenu_item_image">
                    <img width="221" src="pic/design/temp/imp_article1.jpg" alt="Důležité články">
                </div>
                <div class="rightmenu_item_image">
                    <img width="221" src="pic/design/temp/imp_article2.jpg" alt="Důležité články">
                </div>

                <div class="rightmenu_header">
                    SPOLUPRACUJEME
                </div>
                <div class="rightmenu_item_image">
                    <img src="pic/design/rightmenu_banners/fanatics.jpg" alt="Tiscali Games.cz - Fanatics">
                </div>

                <div class="rightmenu_header">
                    ANKETA
                </div>
                <br><br><br><br><br><br><br><br><br><br><br>
            </div>

            <div class="bottom">
                Naprogramoval Wrent (Adam Kučera), design vytvořil Jerryky (Jaroslav Kovář)<br>
                Všechna práva vyhrazena - Adam Kučera - WoWfan.cz 2006-<?php echo Date("Y"); ?><br>
                Obsah webu nesmí být publikován bez souhlasu vlastníka licence nebo autora.<br> 
            </div>

            <div class="blank">

            </div>     

        </div>

        <div class="go_top">
            <a href="#top"><img border="0" src="pic/design/fixed_go_top.png" alt="go top - nahoru"></a>
        </div>

    </body>
</html>