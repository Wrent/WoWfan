<?php
/* @var $article CArticle */
?>
<div class="date">
    <div class="datetext">
        <span class="dm">
            <?php
            echo $article->getDay();
            echo '.';
            echo $article->getMonth();
            echo '.';
            ?>
        </span><br>
        <span class="year">
            <?php
            echo $article->getYear();
            ?>
        </span>
    </div>
</div>
<div class="headers">
    <h1>
        <?php
        echo $article->getTitle();
        ?>
    </h1><br>
    napsal: 
    <?php
    echo $article->printAuthors();
    ?>
    v
    <?php
    echo $article->getHour();
    echo ":";
    echo $article->getMinute();
    ?>
    <br>
    <?php
    //TODO KEYWORDS
    $article->printCategories();
    ?>
</div>
<div class="text">
    <?php
    echo $article->getBBDescription();
    ?>
</div>
<hr>
<div class="text">
    <?php
    echo $article->getBBText();
    ?>
    
    <h3>Nejlepší Komentáře</h3>
    <?php
    $article->printBestComment();
    $article->printComments($_GET['page']);
    ?>
</div>
