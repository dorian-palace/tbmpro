<?php
require_once('Robots.php');
$robot = new Robots();
require_once('../setting/data.php');


// if (isset($_POST['select_color'])) {

//     var_dump($_POST['select_color']);
//     echo "azeazeazea";
// }

if (isset($_POST['select_color'])) {

    $idColor = secuData($_POST['select_color']);
    $colorHeadRobots = $robot->getHeadRobotsByColor($idColor);
    $colorBodyRobots = $robot->getBodyRobotsByColor($idColor);
    $dataCo = ['colorHeadRobots' => $colorHeadRobots, 'colorBodyRobots' => $colorBodyRobots];
    echo json_encode($dataCo);
}

if (isset($_POST['select_mat'])) {
    $idMaterial = secuData($_POST["select_mat"]);
    // var_dump($_POST);
    $materialHeadRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $materialBodyRobots = $robot->getBodyRobotsByMaterial($idMaterial);
    $dataMat = ['materialHeadRobots' => $materialHeadRobots, 'materialBodyRobots' => $materialBodyRobots];
    echo json_encode($dataMat);
}