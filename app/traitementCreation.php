<?php
require_once('adminProduct.php');
require_once('../setting/data.php');
require_once('devis.php');
$devis = new Devis();
$robot = new AdminRobot();

// if (isset($_POST['head_id'])) {
//     var_dump($_POST['head_id']);
// }

// if (isset($_POST['body_id'])); {
//     var_dump($_POST['body_id']);
// }

// if (isset($_POST['robot_name_value'])) {
//     var_dump($_POST['robot_name_value']);
// }


if (isset($_POST['head_id']) || $_POST['body_id'] || $_POST['robot_name_value']) {

    $head = secuData(intval($_POST['head_id']));
    $body = secuData(intval($_POST['body_id']));
    $name = secuData($_POST['robot_name_value']);
    $userId = $_SESSION['id'];
    var_dump($head);
    // var_dump($_POST);
    $newRobot = $robot->newRobots($name, $head, $body, $userId);
    echo json_encode($newRobot);
}

if (isset($_POST['head_id']) || $_POST['body_id'] || $_POST['robot_name_value']) {

    $lastRobot = $devis->getLastRobotFromUser();
    $id_robot = $lastRobot['id_robot'];
    // echo "<pre>";
    // var_dump($id_robot);
    // echo "</pre>";
    $userId = $_SESSION['id'];
    // var_dump($head);
    $robotDevis = $devis->newQuote($userId, $id_robot);
    echo json_encode($robotDevis);
    // var_dump($_POST);

}
