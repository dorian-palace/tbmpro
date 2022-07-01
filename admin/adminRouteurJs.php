<?php
require_once('../app/AdminProduct.php');

$robot = new AdminRobot();

if (isset($_POST['select_color'])) {

    $idColor = $_POST['select_color'];
    $colorHeadRobots = $robot->getHeadRobotsByColor($idColor);
    $dataCo = ['colorHeadRobots' => $colorHeadRobots];
    echo json_encode($dataCo);
}

if (isset($_POST['select_mat'])) {

    $idMaterial = $_POST["select_mat"];
    $materialHeadRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $dataMat = ['materialHeadRobots' => $materialHeadRobots];
    echo json_encode($dataMat);
}
