<?php
require_once('app/User.php');
require_once('setting/data.php');


if (isset($_POST['mail_singUp']) && !empty ($_POST['mail_singUp'])) {

    if (isset($_POST['login_singUp'], $_POST['password_singUp'], $_POST['confirm_password_singUp'], $_POST['name_signUp'], $_POST['surname_signUp'], $_POST['mail_singUp'])) {

        $login = secuData($_POST['login_singUp']);
        $password = secuData($_POST['password_singUp']);
        $confPassword = secuData($_POST['confirm_password_singUp']);
        $name = secuData($_POST['name_signUp']);
        $surname = secuData($_POST['surname_signUp']);
        $mail = secuData($_POST['mail_singUp']);
        $user = new User();
        $user->confirmSignUp($login, $password, $name, $surname, $mail);


    }


}

if (isset($_POST['lol'])){
    echo ' <div class="msg"> ' . "Certains champs sont vides" . '</div> <img src="assets/img/iconrobot.png" alt="Petit robot">';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <script src="scriptModal.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style/inscription.css">
</head>

<body>
    <header>
        <?php require_once("layouts/navbar.php")?>
    </header>
    <main>
<<<<<<< HEAD
        <div class="form_singUp">
            <form action="" method="post">
                <input type="text" placeholder="name" name="name_signUp">
                <input type="text" placeholder="surname" name="surname_signUp">
                <input type="email" placeholder="mail" name="mail_singUp">
                <input type="text" placeholder="login" name="login_singUp">
                <input type="password" placeholder="password" name="password_singUp">
                <input type="password" placeholder="paswword" name="confirm_password_singUp">

                <button class="button" type="submit" id = "buttonregister" name = "lol">
                <img src="assets/img/suivantrobot.png" alt="Bouton suivant technology based magic" id ="nextimg">
					<i class="button__icon fas fa-chevron-right"></i>
				</button>		
=======
    <div class="modal">
        <div class="form_box">
        <h1>Inscription</h1>
            <form class="modal-content animate" action="" method="post">
                <div class="user-box">
                <input type="text"  name="name_signUp" autocomplete="off">
                <label>Prénom</label>
                </div>
                <div class="user-box">
                <input type="text" name="surname_signUp" autocomplete="off">
                <label>Nom</label>
                </div>
                <div class="user-box">
                <input type="email"  name="mail_singUp" autocomplete="off">
                <label>Mail</label>
                </div>
                <div class="user-box">
                <input type="text"  name="login_singUp" autocomplete="off">
                <label>Login</label>
                </div>
                <div class="user-box">
                <input type="password" name="password_singUp" autocomplete="off">
                <label>Mot de passe</label>
                </div>
                <div class="user-box">
                <input type="password" placeholder="confirmer le mot de passe" name="confirm_password_singUp" autocomplete="off">
                <label>Confirmer</label>
                </div>
                <input class= "btn_submit" type="submit" name="submit_signUp">
>>>>>>> f52947ac5c239320fee1c7eb4750930743aef0a2
            </form>
        </div>
    </div>
    </main>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>
</body>

</html>