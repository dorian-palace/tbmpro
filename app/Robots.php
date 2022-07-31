<?php
// require_once('setting/data.php');
// require_once('./setting/db.php');
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// var_dump(__DIR__);

class Robots extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    // Récupère la tête des robots par leurs matériaux
    public function getHeadRobotsByMaterial($id)
    {
        $sql = "SELECT * FROM head_robots WHERE id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère la tête des robots par leurs couleurs
    public function getHeadRobotsByColor($id)
    {
        $sql = "SELECT * FROM head_robots WHERE id_color = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère les robots par leurs couleurs et matériaux
    public function getHeadRobotsByColorAndMaterial($id_color, $id_material)
    {

        $sql = "SELECT * FROM head_robots WHERE id_color = ? AND id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id_color, $id_material
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère tous les robots
    public function getAllBodyRobots()
    {
        $sql = "SELECT * FROM body_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère le corp des robots par leurs couleurs
    public function getBodyRobotsByColor($id)
    {
        $sql = "SELECT * FROM body_robots WHERE id_color = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère le corp des robots par leurs matériaux
    public function getBodyRobotsByMaterial($id)
    {
        $sql = "SELECT * FROM body_robots WHERE id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $id
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Récupère le corps des robots par leurs couleurs et matériaux
    public function getBodyRobotsByColorAndMaterial($idColor, $idMaterial)
    {
        $sql = "SELECT * FROM body_robots WHERE id_color = ? AND id_material = ?";
        $result = $this->pdo->prepare($sql);
        $result->execute([
            $idColor, $idMaterial
        ]);
        $robot = $result->fetchAll();
        return $robot;
    }

    // Selectionne toutes les couleurs en base de donnèes
    public function getColor()
    {
        $sql = 'SELECT * FROM colors';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    // Selectionne tous les matériaux en base de donnèes
    public function getMaterials()
    {
        $sql = 'SELECT * FROM materials';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }
}
