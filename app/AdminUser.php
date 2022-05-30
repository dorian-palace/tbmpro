<?php
require_once('../setting/db.php');
require('../setting/data.php');
class AdminUser extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
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

    public function updateUser($id)
    {

        // $id = $_GET['id'];

        if (isset($_POST['submitUser'])) {
            $name = secuData($_POST['name']);
            $surname = secuData($_POST['surname']);
            $login = secuData($_POST['login']);
            $mail = secuData($_POST['mail']);
            $id_role = secuData($_POST['id_role']);
            $id_quotes = secuData($_POST['id_quotes']);
            $idUser = secuData($_POST['submitUser']);

            $sql = "UPDATE users SET name = ?, surname = ?,  mail = ?, login = ?, id_role = ?, id_quotes = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'surname' => $surname,
                'mail' => $mail,
                'login' => $login,
                'id_role' => $id_role,
                'id_quotes' => $id_quotes,
                'id' => $id
            ]);
            //UPDATE users SET name = 'aaze', surname = 'azea', mail = 'aze@a',login = 'aaze', id_role = 1, id_quotes = 0 WHERE id = 1;
            header('Location: adminUser.php');
        }
    }

    public function deleteUser()
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $_GET['id'] //id dans button delete
        ]);
    }
}
