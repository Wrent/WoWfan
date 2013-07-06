<?php
$article = new CArticle($database, $_GET["link"]);
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
        echo $article->getNazev();
        ?>
    </h1><br>
    napsal: 
    <?php
    echo $article->getAutor();
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
    ?>
    > <a href="#">Další datadisk</a> > <a href="#">Úvahy</a>
</div>
<div class="text">
    <?php
    echo $article->getPopis();
    ?>
</div>
<hr>
<div class="text">
    <?php
    echo $article->getText();
    ?>
</div>