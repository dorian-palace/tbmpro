<?php
// var_dump(__DIR__);
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// /Applications/MAMP/htdocs/tbmpro/setting/db.php
require_once('/Applications/MAMP/htdocs/tbmpro/setting/data.php');
// require_once('../setting/db.php');
// require_once('../setting/data.php');
class User extends Database
{
    private $login;
    private $password;
    private $confPassword;
    private $name;
    private $surname;
    private $mail;
    private $id;

    private $loginSignIn;
    private $passwordSignIn;

    public function __construct()
    {
        parent::__construct();
    }

    public function signUp($login, $password, $name, $surname, $mail)
    {

        if (isset($_POST['submit_signUp'])) {

            $login = secuData($_POST['login_singUp']);
            $password = secuData($_POST['password_singUp']);
            $name = secuData($_POST['name_signUp']);
            $surname = secuData($_POST['surname_signUp']);
            $mail = secuData($_POST['mail_singUp']);

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users (name, surname, mail, login, password, id_role) VALUES (?, ?, ?, ?, ?, 1)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $name,
                $surname,
                $mail,
                $login,
                $hashed_password
            ]);
        }
    }


    public function userExist()
    {
        $login = secuData($_POST['login_singUp']);
        $sql = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $login
        ]);
        $user = $stmt->rowCount();
        if ($user == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confPassword()
    {
        $password = secuData($_POST['password_singUp']);
        $confPassword = secuData($_POST['confirm_password_singUp']);
        if ($password == $confPassword) {

            return true;
        } else {
            return false;
        }
    }
    public function valideEmail()
    {
        $mail = secuData($_POST['mail_singUp']);
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function displayMessage($msg)
    {

        if (isset($msg)) {

            echo '<div class="msg">' . $msg . '</div>';
        }
    }


    public function confirmSignUp($login, $password, $name, $surname, $mail)
    {
        if ($this->confPassword()) {

            if ($this->valideEmail()) {

                if ($this->userExist()) {

                    $this->signUp($login, $password, $name, $surname, $mail);
                    header('Location: connexion.php');
                }
            } else {
                $this->displayMessage('Votre adresse mail n\'est pas valide');
            }
        } else {
            $this->displayMessage('Vos mots de passe ne correspondent pas');
        }
    }

    public function getUserInfo()
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $_SESSION['id']
        ]);
        $user = $stmt->fetch();
        return $user;
    }

    public function signIn($login, $password)
    {
        $sql = "SELECT * FROM users WHERE login = ? AND password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $login,
            $password
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
            $msg = "error";
        }
    }

    public function connect($login, $password)
    {
        $sql = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $login
        ]);
        $user = $stmt->rowCount();

        if ($user == 1) {

            $info = $stmt->fetch();

            if (password_verify($password, $info['password'])) {
                $_SESSION['id'] = $info['id'];
                $_SESSION['name'] = $info['name'];
                $_SESSION['surname'] = $info['surname'];
                $_SESSION['mail'] = $info['mail'];
                $_SESSION['login'] = $info['login'];
                $_SESSION['id_role'] = $info['id_role'];
            } else {
                $msg = "error";
            }
        }
    }

    public function updateUser(){

        if (isset($_POST['submit_new'],$_POST['name_new'],$_POST['surname_new'],$_POST['email_new'],$_POST['login_new'],$_POST['password_new'],$_POST['confirm_password_new'])){

            $name = secuData($_POST['name_new']);
            $surname = secuData($_POST['surname_new']);
            $login = secuData($_POST['login_new']);
            $mail = secuData($_POST['mail_new']);
            $newPassword = secuData($_POST['password_new']);
            $idUser = intval($_SESSION["id"]);
           
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $password = $newPassword;


            $sql = "UPDATE users SET name = :name, surname = :surname, login = :login, mail = :mail, password = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":name" => $name,
                ":surname" => $surname,
                ":login" => $login,
                ":mail" => $mail,
                ":password" => $password,
                "id" => $idUser
            ]);
        }

       
    }
}
