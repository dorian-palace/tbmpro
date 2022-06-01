<?php
var_dump(__DIR__);
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// require_once('../setting/db.php');
// /Applications/MAMP/htdocs/tbmpro/setting/db.php
require_once('/Applications/MAMP/htdocs/tbmpro/setting/data.php');
class User extends Database
{
    private $login;
    private $password;
    private $confPassword;
    private $name;
    private $surname;
    private $mail;
    private $id;

    public function __construct($login, $password, $confPassword, $name, $surname, $mail)
    {
        parent::__construct();

        $this->login = secuData($login);
        $this->password = secuData($password);
        $this->confPassword = secuData($confPassword);
        $this->name = secuData($name);
        $this->surname = secuData($surname);
        $this->mail = secuData($mail);
    }

    public function signUp()
    {

        if (isset($_POST['submit_signUp'])) {

            // if ($this->password == $this->confPassword) {

            $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);


            $sql = "INSERT INTO users (name, surname, mail, login, password, id_role) VALUES (?, ?, ?, ?, ?, 1)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $this->name,
                $this->surname,
                $this->mail,
                $this->login,
                $hashed_password
            ]);

            // }
        }
    }


    public function userExist()
    {

        $sql = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $this->login
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
        if ($this->password == $this->confPassword) {

            return true;
        } else {
            return false;
        }
    }
    public function valideEmail()
    {

        if (filter_var($this->mail, FILTER_VALIDATE_EMAIL)) {
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


    public function confirmSignUp()
    {
        if ($this->confPassword()) {

            if ($this->valideEmail()) {

                if ($this->userExist()) {

                    $this->signUp();
                    $this->displayMessage('Votre compte a bien été créé');
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
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $_SESSION['id']
        ]);
        $user = $stmt->fetch();
        return $user;
    }

    public function signIn()
    {
        $sql = "SELECT * FROM users WHERE login = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $this->login,
            $this->password
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
}
