<?php
// require_once('setting/data.php');
// require_once('./setting/db.php');
require_once('C:\wamp64\www\tbmpro\setting\db.php');
// var_dump(__DIR__);

class Robots extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

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

    public function getAllBodyRobots()
    {
        $sql = "SELECT * FROM body_robots";
        $result = $this->pdo->query($sql);
        $robot = $result->fetchAll();
        return $robot;
    }

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

    public function getColor()
    {
        $sql = 'SELECT * FROM colors';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    public function getMaterials()
    {
        $sql = 'SELECT * FROM materials';
        $result = $this->pdo->query($sql);
        $results = $result->fetchAll();
        return $results;
    }

    // méthodes de conversion data #LDB

    public static function LoadHEADS() {
        $connexion = mysqli_connect("localhost", "root", "", "tbm");
        $sql = mysqli_query($connexion, "SELECT * FROM head_robots");
        $heads = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        file_put_contents('heads.json', json_encode($heads));
    }

    public static function LoadBODIES() {
        $connexion = mysqli_connect("localhost", "root", "", "tbm");
        $sql = mysqli_query($connexion, "SELECT * FROM body_robots");
        $bodies = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        file_put_contents('bodies.json', json_encode($bodies));
    }

}
