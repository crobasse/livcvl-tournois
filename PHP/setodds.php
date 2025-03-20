<?php

include "/home/u160780608/public_html/PHP/functions.php";
include "/home/u160780608/public_html/PHP/database.php";
global $db;

$getMatchs = $db->prepare("SELECT DISTINCT match_id FROM bets");
$getMatchs->execute();
$matches = $getMatchs->fetchAll();

$count = $getMatchs->rowCount();

var_dump($matches);