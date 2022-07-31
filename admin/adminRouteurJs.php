<?php
require_once('../app/AdminProduct.php');

$robot = new AdminRobot();

if (isset($_POST['select_color'])) {

    /**
     * Si ma page de traitement reçois un POST, à l'aide de fetch (Javascript), je récupère en base de données les composants des robots par couleurs et matériaux.
     */

    $idColor = secuData($_POST['select_color']);
    $colorHeadRobots = $robot->getHeadRobotsByColor($idColor);
    $colorBodyRobots = $robot->getBodyRobotsByColor($idColor);
    $dataCo = ['colorHeadRobots' => $colorHeadRobots, 'colorBodyRobots' => $colorBodyRobots];
    echo json_encode($dataCo);
}

if (isset($_POST['select_mat'])) {
    /**
     * Si ma page de traitement reçois un POST, à l'aide de fetch (Javascript), je récupère en base de données les composants des robots par matériaux.
     */

    $idMaterial = secuData($_POST["select_mat"]);
    $materialHeadRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $materialBodyRobots = $robot->getBodyRobotsByMaterial($idMaterial);
    $dataMat = ['materialHeadRobots' => $materialHeadRobots, 'materialBodyRobots' => $materialBodyRobots];
    echo json_encode($dataMat);
}

if (isset($_POST['delete-robot'])) {
    /**
     * Permet de supprimer un robot
     */

    $button = intval(secuData($_POST['delete-robot']));
    $deleteRobot = $robot->deleteRobot($button);
    echo json_encode($deleteRobot);
    // var_dump($button);
}

if (isset($_POST['delete-head'])) {
    /**
     * Permet de supprimer une tête
     */
    $id = intval(secuData($_POST['delete-head']));
    var_dump($id);
    $robot->deleteHead($id);
    echo json_encode($robot);
    // var_dump($_POST['delete-head']);
}

if (isset($_POST['delete-body'])) {

    $id = secuData($_POST['delete-body']);
    $deleteBody = $robot->deleteBody($id);
    echo json_encode($deleteBody);
}

if (isset($_POST['name-robot'])) {
    // var_dump($_POST['name-robot']);
}

if (isset($_POST['submit-robot'])) {
    // var_dump($_POST);
    if (isset($_POST['name-robot']) && isset($_POST['head-robot']) && isset($_POST['body-robot'])) {

        $name = secuData($_POST['name-robot']);
        $head = secuData($_POST['head-robot']);
        $body = secuData($_POST['body-robot']);
        $idUser = $_SESSION['id'];

        $insertRobot = $robot->newRobots($name, $head, $body, $idUser);
        echo json_encode($insertRobot);
    }
}


if (isset($_POST['delete-color'])) {

    $id = secuData($_POST['delete-color']);
    $delete = $robot->deleteColor($id);
    echo json_encode($delete);
}

if (isset($_POST['delete-material'])) {

    $id = secuData($_POST['delete-material']);
    $delete = $robot->deleteMaterials($id);
    echo json_encode($delete);
}
