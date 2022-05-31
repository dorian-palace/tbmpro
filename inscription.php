<?php
// var_dump(__DIR__);
require_once('app/User.php');
$user = new User();
$user->userExist();
$user->signUp();
echo "<pre>";
// var_dump($user->signUp());
echo "</pre>";
//add script formulaire dynamioque sans reload pour inscription check todolist
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <form action="" method="post">
            <input type="text" value="name" name="name_signUp">
            <input type="text" value="surname" name="surname_signUp">
            <input type="email" value="mail" name="mail_singUp">
            <input type="text" value="login" name="login_singUp">
            <input type="password" value="password" name="password_singUp">
            <input type="submit" name="submit_signUp">
        </form>
    </main>
</body>

</html>