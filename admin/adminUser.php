<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once('../app/AdminUser.php');
$userAdmin = new AdminUser();
$users = $userAdmin->getAllUsers();
$getAdmin = $userAdmin->getAdmin();

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    $delete = (int)$_GET['delete'];
    $userAdmin->deleteUser($delete);
}

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = (int) strip_tags($_GET['page']); //strip_tags — Supprime les balises HTML et PHP d'une chaîne
} else {
    $page = 1;
}

$start = $userAdmin->countUser();
$nbUsers = $start->fetchColumn();
$limit = 5;
$total = ceil($nbUsers / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    <title>Admin-user</title>
</head>

<body>

    <table>
        <tr>
            <legend>Gestion des users</legend>
            <th>name</th>
            <th>surname</th>
            <th>mail</th>
            <th>login</th>
            <th>id_role</th>
            <th>id_quotes</th>
        </tr>

        <?php foreach ($users as $user) :

        ?>
            <tr>
                <td><?= $user['name']; ?></td>
                <td><?= $user['surname']; ?></td>
                <td><?= $user['mail']; ?></td>
                <td><?= $user['login']; ?></td>
                <td><?= $user['id_role']; ?></td>
                <td><a href="adminUser.php?id=<?= $user['id'] ?>">User management</a></td>
            </tr>
        <?php
        endforeach; ?>
    </table>



    <table>

        <tr>
            <legend>Gestion des admin</legend>
            <th>name</th>
            <th>surname</th>
            <th>mail</th>
            <th>login</th>
            <th>id_role</th>
            <th>id_quotes</th>
        </tr>

        <?php
        if ($_SESSION['id_role'] == 100) :
            foreach ($getAdmin as $admin) : ?>
                <tr>
                    <td><?= $admin['name']; ?></td>
                    <td><?= $admin['surname']; ?></td>
                    <td><?= $admin['mail']; ?></td>
                    <td><?= $admin['login']; ?></td>
                    <td><?= $admin['id_role']; ?></td>
                    <?php if ($_SESSION['id_role'] == 100) { ?>
                        <td><a href="adminUser.php?id=<?= $admin['id'] ?>">User management</a></td>
                    <?php } else {
                        echo "<td>Uniquement le super admin peux manage les admin</td>";
                    } ?>
                </tr>
        <?php
            endforeach;
        endif;
        ?>
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
            <button type="submit" value="<?= $singleUser['id']; ?>" name="submitUser">Update User</button>
            <a class="a_admin" href="adminUser.php?delete=<?= $singleUser['id']; ?>">Delete User</a>
        </form>
    <?php }
    ?>




    <ul class="pagination" style="align-items:center;">
        <li class="disabled"><?php if ($page > 1) { ?><a href="?page=<?= $page - 1  ?>"><i class="material-icons">
                        < </i></a><?php } ?></li>

        <li class="waves-effect"> <?php for ($i = 1; $i <= $total; $i++) {
                                    ?><a href="?page=<?= $i; ?>"><?= $i; ?></a> <?php } ?></li>

        <li class="disabled"><?php if ($page < $total) { ?><a href="?page=<?= $page + 1; ?>"><i class="material-icons"> > </i></a><?php } ?></li>
    </ul>
</body>

</html>