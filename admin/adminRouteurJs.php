<?php
require_once('../app/AdminProduct.php');

$robot = new AdminRobot();

if (isset($_POST['select_color'])) {

    // var_dump($_POST['select_color']);

    $idColor = secuData($_POST['select_color']);
    $colorHeadRobots = $robot->getHeadRobotsByColor($idColor);
    $colorBodyRobots = $robot->getBodyRobotsByColor($idColor);
    $dataCo = ['colorHeadRobots' => $colorHeadRobots, 'colorBodyRobots' => $colorBodyRobots];
    echo json_encode($dataCo);
}

if (isset($_POST['select_mat'])) {

    $idMaterial = secuData($_POST["select_mat"]);
    $materialHeadRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $materialBodyRobots = $robot->getBodyRobotsByMaterial($idMaterial);
    $dataMat = ['materialHeadRobots' => $materialHeadRobots, 'materialBodyRobots' => $materialBodyRobots];
    echo json_encode($dataMat);
}

if (isset($_POST['delete-robot'])) {

    $button = intval(secuData($_POST['delete-robot']));
    $deleteRobot = $robot->deleteRobot($button);
    echo json_encode($deleteRobot);
    // var_dump($button);
}

if (isset($_POST['delete-head'])) {

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
    var_dump($_POST['name-robot']);
}

if (isset($_POST['submit-robot'])) {
    // var_dump($_POST);
    if (isset($_POST['name-robot']) && isset($_POST['head-robot']) && isset($_POST['body-robot']) && isset($_POST['categorie-robot'])) {

        $name = secuData($_POST['name-robot']);
        $head = secuData($_POST['head-robot']);
        $body = secuData($_POST['body-robot']);
        $categorie = secuData($_POST['categorie-robot']);
        $idUser = $_SESSION['id'];

        $robot->newRobots($name, $head, $body, $categorie, $idUser);
        echo json_encode($robot);
    }
}

if (isset($_POST['delete-category'])) {

    $id = secuData($_POST['delete-category']);
    $delete = $robot->deleteCategorie($id);
    // var_dump($_POST);
    echo json_encode($delete);
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

if (isset($_POST['update-category'])) {

    // var_dump($_POST);
    $name = secuData($_POST['update-category']);
    $id = secuData($_POST['update-category-id']);
    $update = $robot->updateCategorie($name, $id);
    echo json_encode($update);
    // var_dump($_POST);
}
