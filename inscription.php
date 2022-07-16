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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style/inscription.css">
</head>

<body>
    <main>
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
            </form>
        </div>
    </main>
</body>

</html>