<?php

error_reporting(0);
ini_set('display_errors', 0);


require_once('../setting/db.php');
require_once('../setting/data.php');
class AdminUser extends Database
{

    public $limite;

    public function __construct()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $this->page = (int) strip_tags($_GET['page']); //strip_tags — Supprime les balises HTML et PHP d'une chaîne
        } else {
            $this->page = 1;
        }
        $this->limite = 5;
        $this->debut = ($this->page - 1) * $this->limite;
        parent::__construct();

        if ($_SESSION['id_role'] == 1) {
            header('Location: index.php');
        }
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE id_role = 1 LIMIT $this->limite OFFSET $this->debut";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    public function countUser()
    {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $count = $stmt->fetchColumn();
        return $stmt;
    }

    public function getSingleUser($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'id' => $id
        ));
        $user = $stmt->fetch();
        return $user;
    }

    public function getAdmin()
    {
        $sql = "SELECT * FROM users WHERE id_role = 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    public function updateUser()
    {

        if (isset($_POST['submitUser'])) {

            $name = secuData($_POST['nameUser']);
            $surname = secuData($_POST['surnameUser']);
            $login = secuData($_POST['loginUser']);
            $mail = secuData($_POST['mailUser']);
            $id_role = secuData($_POST['id_role']);
            $idUser = secuData($_POST['submitUser']);

            $sql = "UPDATE users SET name = ?, surname = ?,  mail = ?, login = ?, id_role = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $name, $surname, $mail, $login, $id_role, $idUser
            ]);
        }
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $id
        ]);
    }
}
