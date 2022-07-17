<?php
require_once('app/User.php');

if (isset($_POST['password_connexion'])) {
    if (isset($_POST['login_connexion'], $_POST['password_connexion'])) {

        $loginSignIn = $_POST['login_connexion'];
        $passwordSignIn = $_POST['password_connexion'];
        $user = new User();
        $user->connect($loginSignIn, $passwordSignIn);

        echo "<pre>";
        echo ' <div class="msg"> ' . "Bienvenue" . '</div> <img src="assets/img/iconrobot.png" alt="Petit robot">';
        echo "</pre>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/connexion.css">
</head>

<body>
    <main>
    <div class="form_singUp">

            <form action="" method="post">
                <input type="text" placeholder="login" name="login_connexion">
                <input type="password" placeholder="password" name="password_connexion">
                <button class="button" type="submit" id = "buttonregister" name = "lol">
                <img src="assets/img/suivantrobot.png" alt="Bouton suivant technology based magic" id ="nextimg">
					<i class="button__icon fas fa-chevron-right"></i>
				</button>		

            </form>
        </div>
    </main>
</body>

</html>