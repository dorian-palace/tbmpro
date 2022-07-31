<?php
require_once('adminProduct.php');
require_once('../setting/data.php');
require_once('devis.php');
$devis = new Devis();
$robot = new AdminRobot();

/**
 * Si ma page de traitement reçois un POST, à l'aide de fetch (Javascript), je crée un nouveau robot et un devis.
 */

if (isset($_POST['head_id']) || $_POST['body_id'] || $_POST['robot_name_value']) {

    $head = secuData(intval($_POST['head_id']));
    $body = secuData(intval($_POST['body_id']));
    $name = secuData($_POST['robot_name_value']);
    $userId = $_SESSION['id'];
    var_dump($head);
    // var_dump($_POST);
    $newRobot = $robot->newRobots($name, $head, $body, $userId);
    // return les values au format JSON
    echo json_encode($newRobot);
}

if (isset($_POST['head_id']) || $_POST['body_id'] || $_POST['robot_name_value']) {

    $lastRobot = $devis->getLastRobotFromUser();
    $id_robot = $lastRobot['id_robot'];
    $userId = $_SESSION['id'];
    $robotDevis = $devis->newQuote($userId, $id_robot);
    // return les values au format JSON
    echo json_encode($robotDevis);
}
