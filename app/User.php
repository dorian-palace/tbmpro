<?php
require_once('../setting/db.php');
class User extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function signUp($name, $surname, $mail, $login, $password, $id_role, $id_quotes)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (name, surname, mail, login, password, id_role, id_quotes) VALUES (:name, :surname, :mail, :login, :password, :id_role, :id_quotes)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':surname' => $surname,
            ':mail' => $mail,
            ':login' => $login,
            ':password' => $password,
            ':id_role' => $id_role,
            ':id_quotes' => $id_quotes
        ]);
    }

    public function signIn($login, $password)
    {
        $sql = "SELECT * FROM user WHERE login = :login AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':login' => $login,
            ':password' => $password
        ]);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['mail'] = $user['mail'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['id_role'] = $user['id_role'];
            $_SESSION['id_quotes'] = $user['id_quotes'];
            header('Location: index.php');
        } else {
            echo "error";
        }
    }

    public function userExist($login)
    {
        $sql = "SELECT * FROM user WHERE login = :login";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':login' => $login
        ]);
        $user = $stmt->fetch();
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserInfo()
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $_SESSION['id']
        ]);
        $user = $stmt->fetch();
        return $user;
    }
}
