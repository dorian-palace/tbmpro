<?php
require_once('setting/data.php');
// require_once('app/AdminUser.php');
require_once('app/User.php');

if (isset($_SESSION)){

    if(isset($_POST['submit_new'],$_POST['name_new'],$_POST['surname_new'],$_POST['email_new'],$_POST['login_new'],$_POST['password_new'],$_POST['confirm_password_new']) ){ 
        
        $login = secuData($_POST['login_new']);
        $password = secuData($_POST['password_new']);
        $confPassword = secuData($_POST['confirm_password_new']);
        $name = secuData($_POST['name_new']);
        $surname = secuData($_POST['surname_signUp']);
        $mail = secuData($_POST['email_new']);
        $userUpdate = new User();
        $userUpdate->updateUser($name, $surname, $mail, $login, $password);
    }
    }
    
// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <?php require_once("layouts/navbar.php")?>
    </header>
    <main>
    <div class="modal">
    <div class="form_box">
        <h1>Bienvenue <span><?= $_SESSION['name']; ?></span> </h1>
            <form class="modal-content animate" action="" method="post">
                <div class="user-box">
                <input type="text" placeholder="name" name="name_new" value="<?= $_SESSION['name']; ?>">
                <label>Prénom</label>
                </div>
                <div class="user-box">
                <input type="text" placeholder="surname" name="surname_new" value="<?= $_SESSION['surname']; ?>">
                <label>Nom</label>
                </div>
                <div class="user-box">
                <input type="email" placeholder="mail" name="mail_new" value="<?= $_SESSION['mail']; ?>">
                <label>Mail</label>
                </div>
                <div class="user-box">
                <input type="text" placeholder="login" name="login_new" value="<?= $_SESSION['login']; ?>">
                <label>Login</label>
                </div>
                <div class="user-box">
                <input type="password" placeholder="" name="password_new">
                <label>Mot de passe</label>
                </div>
                <div class="user-box">
                <input type="password" placeholder="" name="confirm_password_new">
                <label>Confirmer</label>
                </div>
                <input class= "btn_submit" type="submit" name="submit_new">
    </div>
                
            </form>
        </div>
        </div>
    </main>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>
</body>
</html>