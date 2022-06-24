<?php

error_reporting(0);
ini_set('display_errors', 0);


require_once('../app/AdminUser.php');
$userAdmin = new AdminUser();
$users = $userAdmin->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-commandes</title>
</head>

<body>

    <table>
        <tr>
            <th>name</th>
            <th>surname</th>
            <th>mail</th>
            <th>login</th>
            <th>id_role</th>
            <th>id_quotes</th>
        </tr>

        <?php foreach ($users as $user) : ?>
            <tr>
                <a href="adminUser.php?id=<?= $user['id'] ?>"><?= $user['id'] ?>">super lien fils de pute</a>
                <td><?= $user['name']; ?></td>
                <td><?= $user['surname']; ?></td>
                <td><?= $user['mail']; ?></td>
                <td><?= $user['login']; ?></td>
                <td><?= $user['id_role']; ?></td>
                <td><?= $user['id_quotes']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php
    if (isset($_GET['id'])) {
        $singleUser = $userAdmin->getSingleUser($_GET['id']);
        // $id = $_GET['id'];
        $userAdmin->updateUser($_GET['id']);
        // echo "<pre>";
        // var_dump($singleUser);
        // echo "</pre>";
        // echo "ok";
    ?>
        <form action="" method="post">
            <input type="text" name="nameUser" value="<?= $singleUser['name']; ?>">
            <input type="text" name="surnameUser" value="<?= $singleUser['surname']; ?>">
            <input type="text" name="mailUser" value="<?= $singleUser['mail']; ?>">
            <input type="text" name="id_role" value="<?= $singleUser['id_role']; ?>">
            <input type="text" name="id_quotes" value="<?= $singleUser['id_quotes']; ?>">
            <button type="submit" value="<?= $singleUser['id']; ?>" name="submitUser">
                <!--Submit update order-->super bouton
            </button>
            <a href="">
                <!---DELETE-->
            </a>
        </form>
    <?php
    }
    ?>
</body>

</html>