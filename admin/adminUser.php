<?php
require_once('../app/AdminUser.php');
$userAdmin = new AdminUser();
$users = $userAdmin->getAllUsers();

// si la session id role est égale à 100 on affiche toute les fonctionnaitlité du super admin
// si la session id role est égale à 10 on affiche toute les fonctionnalité du admin

//sinon vous n'êtes pas admin headerlocation index.php

if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    $delete = (int)$_GET['delete'];
    $userAdmin->deleteUser($delete);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-user</title>
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

        <?php foreach ($users as $user) :
            echo "<pre>";
            var_dump($user['id_role']);
            echo "</pre>";

        ?>
            <tr>
                <td><?= $user['name']; ?></td>
                <td><?= $user['surname']; ?></td>
                <td><?= $user['mail']; ?></td>
                <td><?= $user['login']; ?></td>
                <td><?= $user['id_role']; ?></td>
                <td><?= $user['id_quotes']; ?></td>
                <td><a href="adminUser.php?id=<?= $user['id'] ?>">User management</a></td>
            </tr>
        <?php
        endforeach; ?>
    </table>

    <?php
    if (isset($_GET['id'])) {

        $singleUser = $userAdmin->getSingleUser($_GET['id']);
        $userAdmin->updateUser($_GET['id']); ?>

        <form action="" method="post">
            <input type="text" name="nameUser" value="<?= $singleUser['name']; ?>" placeholder="">
            <input type="text" name="surnameUser" value="<?= $singleUser['surname']; ?>">
            <input type="email" name="mailUser" value="<?= $singleUser['mail']; ?>">
            <input type="text" name="loginUser" value="<?= $singleUser['login']; ?>">
            <input type="text" name="id_role" value="<?= $singleUser['id_role']; ?>">
            <input type="text" name="id_quotes" value="<?= $singleUser['id_quotes']; ?>">
            <button type="submit" value="<?= $singleUser['id']; ?>" name="submitUser">Update User</button>
            <a class="a_admin" href="adminUser.php?delete=<?= $singleUser['id']; ?>">Delete User</a>
        </form>
    <?php } ?>

</body>

</html>