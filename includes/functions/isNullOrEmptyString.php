<?php

function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}
?>
