<?php
require_once('../app/AdminProduct.php');

$robot = new AdminRobot();

if (isset($_POST['select_color'])){

    $idColor = $_POST['select_color'];
    $colorRobots = $robot->getHeadRobotsByColor($idColor);
    $dataCo = ['co' => $colorRobots];
    echo json_encode($dataCo);

}

if (isset($_POST['select_mat'])) {

    $idMaterial = $_POST["select_mat"];
    $bodyRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $dataMat = ['mat' => $bodyRobots];
    echo json_encode($dataMat);
}
// $data = ['result' => $bodyRobots];
// echo (json_encode($data));