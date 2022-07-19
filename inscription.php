<?php
require_once('app/User.php');
require_once('setting/data.php');

if (isset($_POST['submit_signUp'])) {

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <header>
        <?php require_once("layouts/navbar.php")?>
    </header>
    <main>
        <div class="form_singUp">
            <form action="" method="post">
                <input type="text" placeholder="name" name="name_signUp">
                <input type="text" placeholder="surname" name="surname_signUp">
                <input type="email" placeholder="mail" name="mail_singUp">
                <input type="text" placeholder="login" name="login_singUp">
                <input type="password" placeholder="password" name="password_singUp">
                <input type="password" placeholder="paswword" name="confirm_password_singUp">
                <input type="submit" name="submit_signUp">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>
</body>

</html>