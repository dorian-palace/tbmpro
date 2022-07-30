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
    
    public function getLastQuotes()
    {
        $sql = "SELECT * FROM quotes JOIN users on users.id = quotes.id_user JOIN robots ON robots.id_robot = quotes.id_robot JOIN body_robots ON body_robots.body_id = robots.id_image_body JOIN head_robots ON head_robots.head_id = robots.id_image_head WHERE quotes.id_user = ? ORDER BY quotes.id DESC LIMIT 1";
        $query = $this->pdo->prepare($sql);
        $query->execute([$_SESSION['id']]);
        $quote = $query->fetchAll();
        return $quote;
    }
}
