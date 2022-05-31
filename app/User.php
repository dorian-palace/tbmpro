<?php
var_dump(__DIR__);
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// require_once('../setting/db.php');

// /Applications/MAMP/htdocs/tbmpro/setting/db.php
require_once('/Applications/MAMP/htdocs/tbmpro/setting/data.php');
class User extends Database
{

    public function __construct()
    {
        parent::__construct();
    }

    public function signUp()
    {

        if (isset($_POST['submit_signUp'])) {

            $name = secuData($_POST['name_signUp']);
            $surname = secuData($_POST['surname_signUp']);
            $mail = secuData($_POST['mail_singUp']);
            $login = secuData($_POST['login_singUp']);
            $password = secuData($_POST['password_singUp']);
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (name, surname, mail, login, password, id_role) VALUES (:name, :surname, :mail, :login, :password, 1)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':surname' => $surname,
                ':mail' => $mail,
                ':login' => $login,
                ':password' => $hashed_password
            ]);
        }
    }

    public function userExist()
    {
        $login = secuData($_POST['login_singUp']);
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':login' => $login
        ]);
        $user = $stmt->fetch();
        if (!$user) {
            $this->signUp();
        } else {
            return true;
            // return false;

        }
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
