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

// if (isset($_POST['select_color'])) {

//     $idColor = $_POST["select_color"];
//     var_dump($idColor);
//     $headByColor = $robot->getHeadRobotsByColor($idColor, $idMaterial);

//     echo "<pre>";
//     var_dump($headByColor);
//     echo "</pre>";
//     // echo json_encode($headByColor);

// }
echo "<pre>";
var_dump($_POST);
echo "</pre>";
