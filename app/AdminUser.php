<?php
require_once('../setting/db.php');
require_once('../setting/data.php');
// echo 'class adminUser';
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

        // Si l'utilisateur connecté n'est pas un admin il est redirigé vers la page d'accueil
        if ($_SESSION['id_role'] == 1) {
            header('Location: index.php');
        }
    }

    // Récupère tout les utilisateurs.
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE id_role = 1 LIMIT $this->limite OFFSET $this->debut";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    /**
     * Récupère le nombre total d'utilisateurs pour pagination.
     */
    public function countUser()
    {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $count = $stmt->fetchColumn();
        return $stmt;
    }

    /**
     * Récupère les informations d'un utilisateur.
     */
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

    /**
     * Récupère tout les administrateurs.
     * id_role 10 = administrateur
     */
    public function getAdmin()
    {
        $sql = "SELECT * FROM users WHERE id_role = 10";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }

    /**
     * Permet de modifier les informations d'un utilisateur.
     */
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

    /**
     * permet de supprimer un utilisateur.
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $id
        ]);
    }
}
