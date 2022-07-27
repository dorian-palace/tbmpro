<?php
// require_once('../setting/db.php');
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');

class Devis extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLastRobotFromUser()
    {
        $sql = "SELECT * FROM `robots` WHERE `id_user` = ? ORDER BY `id_robot` DESC LIMIT 1";
        $query = $this->pdo->prepare($sql);
        $query->execute([$_SESSION['id']]);
        $robot = $query->fetch();
        return $robot;
    }

    public function getAllInfosFromUser()
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$_SESSION['id']]);
        $user = $query->fetch();
        return $user;
    }

    public function newQuote($id_user, $id_robot)
    {
        $sql = "INSERT INTO `quotes` (`id_user`, `id_robot`) VALUES (?, ?)";
        $query = $this->pdo->prepare($sql);
        $query->execute([$id_user, $id_robot]);
        $quote = $query->fetch();
    }
}
