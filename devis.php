<?php

require_once('app/Devis.php');

$devis = new Devis();
$userData = $devis->getAllInfosFromUser();
$robotData = $devis->getLastRobotFromUser();

// foreach ($userData as $user) {
//     // $user[$key] = $value;
//     echo "<pre>";
//     var_dump($user);
//     echo "</pre>";
// }

foreach ($robotData as $robot) {
    // $robot[$key] = $value;
    echo "<pre>";
    var_dump($robotData);
    echo "</pre>";
}

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
