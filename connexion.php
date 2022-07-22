<?php
require_once('app/User.php');

if (isset($_POST['password_connexion'])) {
    if (isset($_POST['login_connexion'], $_POST['password_connexion'])) {

        $loginSignIn = $_POST['login_connexion'];
        $passwordSignIn = $_POST['password_connexion'];
        $user = new User();
        $user->connect($loginSignIn, $passwordSignIn);

<<<<<<< HEAD
        echo "<pre>";
        echo ' <div class="msg"> ' . "Bienvenue" . '</div> <img src="assets/img/iconrobot.png" alt="Petit robot">';
        echo "</pre>";
        header("Refresh:2; url=http://localhost/tbm/", true, 303);
=======
        // echo "<pre>";
        // var_dump($_SESSION);
        // echo "</pre>";
>>>>>>> f52947ac5c239320fee1c7eb4750930743aef0a2
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/connexion.css">
</head>

<body>
    <header>
        <?php require_once("layouts/navbar.php")?>
    </header>
    <main>
<<<<<<< HEAD
    <div class="form_singUp">

            <form action="" method="post">
                <input type="text" placeholder="login" name="login_connexion">
                <input type="password" placeholder="password" name="password_connexion">
                <button class="button" type="submit" id = "buttonregister" name = "lol">
                <img src="assets/img/suivantrobot.png" alt="Bouton suivant technology based magic" id ="nextimg">
					<i class="button__icon fas fa-chevron-right"></i>
				</button>		

=======
    <div class="modal">
        <div class="form_box">
        <h1>Connexion</h1>
            <form action="" method="post">
                <div class="user-box">
                <input type="text"  name="login_connexion" autocomplete="off">
                <label for="login_connexion">Login</label>
                </div>
                <div class="user-box">
                <input type="password" name="password_connexion" autocomplete="off">
                <label for="password_connexion">Mot de passe</label>
                </div>
                <input class= "btn_submit" type="submit" name="submit_connexion">
>>>>>>> f52947ac5c239320fee1c7eb4750930743aef0a2
            </form>
        </div>
    </div>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>
</body>

</html>