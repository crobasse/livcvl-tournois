<?php

include "/home/u160780608/public_html/PHP/functions.php";
include "/home/u160780608/public_html/PHP/database.php";
global $db;

$getMatchs = $db->prepare("SELECT DISTINCT match_id FROM bets");
$getMatchs->execute();
$matches = $getMatchs->fetch();

$count = $getMatchs->rowCount();

if ($count > 0) {
    foreach ($matches as $id => $match) {
        $cotes = cotesMatch($match["match_id"]);

        echo "Updating Match " . $match["match_id"] . "\n";
        $updateBets = $db->prepare("UPDATE bets SET odds = :odds WHERE match_id = :matchId AND choice = :choice");
        $updateBets->execute([
            "odds" => $cotes[0],
            "matchId" => $match["match_id"],
            "choice" => 0
        ]);
        echo " - Updated 0\n";
        $updateBets->execute([
            "odds" => $cotes[1],
            "matchId" => $match["match_id"],
            "choice" => 1
        ]);
        echo " - Updated 1\n";
        $updateBets->execute([
            "odds" => $cotes[2],
            "matchId" => $match["match_id"],
            "choice" => 2
        ]);
        echo " - Updated 2\n";
        echo "Updated Match " . $match["match_id"] . "\n\n";
    }
    echo "All ".$count." Done.";
}else{
    echo "An error happened";
}