<?php
require_once('app/User.php');

if (isset($_POST['submit_connexion'])) {
    if (isset($_POST['login_connexion'], $_POST['password_connexion'])) {

        $loginSignIn = $_POST['login_connexion'];
        $passwordSignIn = $_POST['password_connexion'];
        $user = new User();
        $user->connect($loginSignIn, $passwordSignIn);

        echo "<pre>";
        var_dump($_SESSION);
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
</head>

<body>
    <main>
        <div class="container_form_connexion">
            <form action="" method="post">
                <input type="text" placeholder="login" name="login_connexion">
                <input type="password" placeholder="password" name="password_connexion">
                <input type="submit" name="submit_connexion">
            </form>
        </div>
    </main>
</body>

</html>