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
    echo $article->getAuthor();
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
    echo $article->getDescription();
    ?>
</div>
<hr>
<div class="text">
    <?php
    echo $article->getBBText();
    ?>
</div>
