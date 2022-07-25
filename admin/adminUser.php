<?php
require_once('../app/AdminUser.php');
$userAdmin = new AdminUser();
$users = $userAdmin->getAllUsers();
$getAdmin = $userAdmin->getAdmin();

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
if (isset($_GET['delete']) && !empty($_GET['delete'])) {

    $delete = (int)$_GET['delete'];
    $userAdmin->deleteUser($delete);
}

// if (isset($_GET['page']) && !empty($_GET['page'])) {
//     $page = (int) strip_tags($_GET['page']); //strip_tags — Supprime les balises HTML et PHP d'une chaîne
// } else {
//     $page = 1;
// }

$start = $userAdmin->countUser();
$nbUsers = $start->fetchColumn();
// $limit = 5;
// $total = ceil($nbUsers / $limit);

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../layouts/scriptNav.js"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favIcon.ico">
    <!-- CSS only -->
    <script src="../js/adminRobots.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
<header>
        <nav class="topnav robot-nav" id="myTopnav">
            <ul class="link-to myLinks">
                <a href=" ../admin.php" class="active">Accueil admin</a>
                <!-- <a href="#main-robot" class="link">Robot</a> -->
                <!-- <a href="#form-new-cat" class="link">Categories</a> -->
                <!-- <a href="#form-new-materials" class="link">Matières</a> -->
                <!-- <a href="#form-new-color" class="link">Couleurs</a> -->
               <a href="../setting/deconnexion.php" class="link">Deconnexion</a>
               <a 
                class="icon" >
                <i class="fa fa-bars"></i>
                </a>
            </ul>
        </nav>
    </header>
    
    <main class= "main-admin-user">
        <article class= "gestionnaire">
            <table class="form_box table">
                <h2>Gestion des users</h2>
            
                <tr>
                    <th>name</th>
                    <th>surname</th>
                    <th>mail</th>
                    <th>login</th>
                    <th>role</th>
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
                        <td><a href="adminUser.php?id=<?= $user['id'] ?>">Modifier</a></td>
                    </tr>
                <?php
                endforeach; ?>
            </table>

            <table class="form_box table">

                <tr>
                    <h2>Gestion des admins</h2>
                    <th>name</th>
                    <th>surname</th>
                    <th>mail</th>
                    <th>login</th>
                    <th>role</th>
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
                                <td><a href="adminUser.php?id=<?= $admin['id'] ?>">Modifier</a></td>
                            <?php } else {
                                echo "<td>Uniquement le super admin peux manage les admins</td>";
                            } ?>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </table>
        </article>
        <article class="update-user">
            <?php
            
            if (isset($_GET['id'])) {

                $singleUser = $userAdmin->getSingleUser($_GET['id']);
                $userAdmin->updateUser($_GET['id']); ?>

                <form class="form_box form-update" action="" method="post">
                <h2>Gestion de profil</h2>
                <div class="user-box">
                    <input type="text" name="nameUser" value="<?= $singleUser['name']; ?>" placeholder="">
                    <label class="user-box" for="article-title">Prénom:</label>
                </div>
                <div class="user-box">
                    <input type="text" name="surnameUser" value="<?= $singleUser['surname']; ?>">
                    <label class="user-box" for="article-title">Nom:</label>
                </div>
                <div class="user-box">
                    <input type="email" name="mailUser" value="<?= $singleUser['mail']; ?>">
                    <label class="user-box" for="article-title">Mail:</label>
                </div>
                <div class="user-box">
                    <input type="text" name="loginUser" value="<?= $singleUser['login']; ?>">
                    <label class="user-box" for="article-title">Login:</label>
                </div>
                <div class="user-box">
                    <input type="text" name="id_role" value="<?= $singleUser['id_role']; ?>">
                    <label class="user-box" for="article-title">Role:</label>
                </div>
                <div class="user-box">
                    <button type="submit" value="<?= $singleUser['id']; ?>" name="submitUser">Mettre à jour</button>
                    <a class="a_admin" href="adminUser.php?delete=<?= $singleUser['id']; ?>">Supprimer le profil</a>
                </form>
            <?php }
            ?>

        </article>
</main>


    <!-- <ul class="pagination" style="align-items:center;">
        <li class="disabled"><?php if ($page > 1) { ?><a href="?page=<?= $page - 1  ?>"><i class="material-icons">
                        < </i></a><?php } ?></li>

        <li class="waves-effect"> <?php for ($i = 1; $i <= $total; $i++) {
                                    ?><a href="?page=<?= $i; ?>"><?= $i; ?></a> <?php } ?></li>

        <li class="disabled"><?php if ($page < $total) { ?><a href="?page=<?= $page + 1; ?>"><i class="material-icons"> > </i></a><?php } ?></li>
    </ul> -->
</body>

</html>