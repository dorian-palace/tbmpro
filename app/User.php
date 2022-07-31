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
        @$this->password = $_POST['password_singUp'];
    }

    /**
     * $_POST sécurisé avec la fonction générique secuData()
     */

    public function signUp($login, $password, $name, $surname, $mail)
    {
        /**
         * Si l'utilisateur valide le formulaire, je récupère les données du formulaire en les sécurisant à l'aide de la fonction générique secuData() et Hash le password à l'aide de PASSWORD_BCRYPT.
         */
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

    /**
     * Je sécurise le login en utilisant la fonction secuData()
     * rowCount permet de vérifier si le login est déjà utilisé.
     * Si il n'est pas déjà utilisé, je peux l'inscrire. (rowCount == 0) return true 
     * Si il est déjà utilisé, je ne peux pas l'inscrire.  false
     */
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

    /**
     * Fonction qui permet de vérifier si le password est indendique avec la confirmation du password. 
     * Si les password son identiques.  true
     * Si les password sont différents.  false
     */
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

    /**
     * Fonction qui permet de vérifier si le mail renseigné est au format mail. 
     * Si le mail est valide.  true
     * Si le mail est invalide.  false
     */
    public function valideEmail()
    {
        $mail = secuData($_POST['mail_singUp']);
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function regexPassword()
    {

        $password = secuData($_POST['password_singUp']);
        // if (preg_match('(?=.*[a-z])(?=.*[A-Z]){8,}', $password)) {
        //     return true;
        // } else {
        //     return false;
        // }
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            // tell the user something went wrong
            return false;
        }
        return true;
    }

    /**
     * Fonction qui permet d'afficher les message d'érreur en placant en paramètres le message d'erreur.
     */
    public function displayMessage($msg)
    {

        if (isset($msg)) {

            echo '<div class="msg">' . $msg . '</div>';
        }
    }


    /**
     * Fonction qui permet de valider l'inscritpion d'un utilisateur.
     */
    public function confirmSignUp($login, $password, $name, $surname, $mail)
    {
        //Si le mot de passe renseigné respecte les conditions de la function regexPassword() 
        if ($this->regexPassword()) {
            //Si les mots de passes sont identiques
            if ($this->confPassword()) {
                //Si le mail est valide
                if ($this->valideEmail()) {
                    //Si le login n'est pas déjà utilisé
                    if ($this->userExist()) {
                        //Si toutes les conditions sont remplies, je peux inscrire l'utilisateur
                        $this->signUp($login, $password, $name, $surname, $mail);
                        //il est donc redirigé vers la page de connexion
                        header('Location: connexion.php');
                    }
                } else {
                    $this->displayMessage('Votre adresse mail n\'est pas valide');
                }
            } else {
                $this->displayMessage('Vos mots de passe ne correspondent pas');
            }
        } else {
            $this->displayMessage('Votre mot de passe doit contenir au moins 8 caractères, une majuscule et une minuscule');
        }
    }

    /**
     * Fonction qui permet de récupèrer les informations de l'utilisateur connecté.
     */
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

    /**
     * Fonction qui permet de connecter un utilisateur.
     * Si le login et le password sont corrects, il est connecté.
     */
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

    /**
     * Fonction qui permet à un utilisateur de modifier ses informations.
     */
    public function updateUser($name, $surname, $mail, $login, $newPassword, $id)
    {

        if ($this->regexPassword()) {
            $password = password_hash($newPassword, PASSWORD_DEFAULT);

            $sql = "UPDATE users SET name = :name, surname = :surname, mail = :mail, login = :login, password = :password WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":name" => $name,
                ":surname" => $surname,
                ":mail" => $mail,
                ":login" => $login,
                ":password" => $password,
                "id" => $id
            ]);
            // return $stmt;
        } else {
            $this->displayMessage('Votre mot de passe doit contenir au moins 8 caractères, une majuscule et une minuscule');
        }
    }
}
