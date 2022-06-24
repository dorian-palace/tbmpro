<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once('../setting/db.php');
require('../setting/data.php');
class AdminCommandes extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCommandes()
    {
        $sql = "SELECT * FROM commandes";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $allOrders = $stmt->fetchAll();
        return $allOrders;
    }

    public function getOneOrder($id)
    {
        $sql = "SELECT * FROM commandes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(
            'id' => $id
        ));
        $order = $stmt->fetch();
        return $order;
    }
// structure de constrôle à l'issu des isset POST

    public function modifyOrder($id)
    {

        // $id = $_GET['id'];

        if (isset($_POST['submitOrder'])) {
            $name = secuData($_POST['name']);
            $surname = secuData($_POST['surname']);
            $login = secuData($_POST['login']);
            $mail = secuData($_POST['mail']);
            $id_role = secuData($_POST['id_role']);
            $id_quotes = secuData($_POST['id_quotes']);
            $idUser = secuData($_POST['submitOrder']);

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
            header('Location: adminCommandes.php');
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
