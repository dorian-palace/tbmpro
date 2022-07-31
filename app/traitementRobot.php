<?php
require_once('Robots.php');
$robot = new Robots();
require_once('../setting/data.php');

/**
 * Si ma page de traitement reçois un POST, à l'aide de fetch (Javascript), je récupère en base de données les composants des robots par couleurs et matériaux.
 **/

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
