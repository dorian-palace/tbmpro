<?php
require_once('../setting/db.php');
require('../setting/data.php');
class AdminUser extends Database
{

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION['id_role'] != 1) {
            header('Location: index.php');
        }
    }

    public function getAllUsers()
    {
        //affiche toute les information de tout les utilisateurs
        $sql = "SELECT * FROM users WHERE id_role = 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
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
            $id_quotes = secuData($_POST['id_quotes']);
            $idUser = secuData($_POST['submitUser']);

            $sql = "UPDATE users SET name = ?, surname = ?,  mail = ?, login = ?, id_role = ?, id_quotes = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $name, $surname, $mail, $login, $id_role, $id_quotes, $idUser
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
