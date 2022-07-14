<?php
require_once('../app/AdminProduct.php');

$robot = new AdminRobot();

if (isset($_POST['select_color'])) {

    $idColor = $_POST['select_color'];
    $colorHeadRobots = $robot->getHeadRobotsByColor($idColor);
    $colorBodyRobots = $robot->getBodyRobotsByColor($idColor);
    $dataCo = ['colorHeadRobots' => $colorHeadRobots, 'colorBodyRobots' => $colorBodyRobots];
    echo json_encode($dataCo);
}

if (isset($_POST['select_mat'])) {

    $idMaterial = $_POST["select_mat"];
    $materialHeadRobots = $robot->getHeadRobotsByMaterial($idMaterial);
    $materialBodyRobots = $robot->getBodyRobotsByMaterial($idMaterial);
    $dataMat = ['materialHeadRobots' => $materialHeadRobots, 'materialBodyRobots' => $materialBodyRobots];
    echo json_encode($dataMat);
}

// if (isset($_POST['submit-robot'])) {
//     $robot->newRobots($_POST['name-robot'], $_POST['checkbox-head-robot'], $_POST['checkbox-body-robot'], $_POST['categorie-robot'], $_SESSION['id']);
// }

// if (isset($_POST['name-robot'])) {

//     var_dump($_POST['name-robot']);
//     var_dump($_POST);

// }

// if (isset($_POST['categorie-robot'])) {

//     var_dump($_POST['categorie-robot']);
//     // echo "j'ai la catégorie";
// }

// if (isset($_POST['checkbox-head-robot'])) {
//     // var_dump($_POST['checkbox-head-robot']);
//     $c = intval($_POST['checkbox-head-robot']);
//     var_dump($c);
//     // echo "checkbox HEAD";
// }


// if (isset($_POST)) {
//     var_dump($_POST);
// }
// if (isset($_POST['checkbox-body-robot'])) {

//     var_dump($_POST);
// }

// if (isset($_POST['submit-robot'], $_POST['name-robot'], $_POST['checkbox-head-robot'], $_POST['checkbox-body-robot'], $_POST['categorie-robot'])) {
//     // echo "coucou";
//     var_dump($_POST);
//     $name = secuData($_POST['name-robot']);
//     $head = secuData($_POST['checkbox-head-robot']);
//     $body = secuData($_POST['checkbox-body-robot']);
//     $categorie = secuData($_POST['categorie-robot']);
//     $idUser = $_SESSION['id'];

//     $robot->newRobots($name, $head, $body, $categorie, $idUser);
//     // echo json_encode($robot);
//     echo "nazfeygazuieguazgeuazgbduoazvdiuvazduiazv";
// }

if (isset($_POST['submit-robot'])) {
    var_dump($_POST);
    if (isset($_POST['name-robot']) && isset($_POST['checkbox-head-robot']) && isset($_POST['checkbox-body-robot']) && isset($_POST['categorie-robot'])) {
        
        $name = secuData($_POST['name-robot']);
        $head = secuData($_POST['checkbox-head-robot']);
        $body = secuData($_POST['checkbox-body-robot']);
        $categorie = secuData($_POST['categorie-robot']);
        $idUser = $_SESSION['id'];

        $robot->newRobots($name, $head, $body, $categorie, $idUser);
        // echo json_encode($robot);
        echo "nazfeygazuieguazgeuazgbduoazvdiuvazduiazv";
    }
}

// if (isset($_POST['submit-robot']) && isset($_POST['categorie-robot'])){
//     var_dump($_POST);
// }
// if (isset($_POST['select-color']) && isset($_POST['name-robot']) && isset)