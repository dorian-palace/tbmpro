<?php
require_once('../app/AdminProduct.php');
// require_once('adminProduct.php');

// $request_body = trim(file_get_contents('php://input'));
// var_dump($request_body);
$robot = new AdminRobot();
// // var_dump('COUCOU');

// var_dump($robot->bidon());
// var_dump($_POST);
// var_dump($request_body);

if (isset($_POST['select_mat'])) {
    //récupère les robots selons le matériel choisi avec le button

    $idMaterial = $_POST["select_mat"];
    $bodyRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    echo "<pre>";
    var_dump($bodyRobots);
    echo "</pre>";
    echo json_encode($bodyRobots);
}
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
