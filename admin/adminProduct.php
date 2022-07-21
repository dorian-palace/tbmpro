<?php
require_once('../app/AdminProduct.php');

if ($_SESSION['id_role'] == 1) {
    header('Location: ../index.php');
}

$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();

$robot->newMaterials();
$material = $robot->getMaterials();

$robot->newCategories();
$getCategories = $robot->getCategories();

$productImage = $robot->getImages();

$robot->newRobotHead();
$robot->newRobotBody();
$headRobot = $robot->getAllHeadRobots();
$bodyRobot = $robot->getAllBodyRobots();
$allRobots = $robot->getAllRobots();


if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = (int) strip_tags($_GET['page']); // On récupère la page courante 
    //strip_tags — Supprime les balises HTML et PHP d'une chaîne
} else {
    $page = 1;
}

$start = $robot->countRobots();
$nbStart = $start->fetchColumn();
$limit = 5;
$total = ceil($nbStart / $limit);
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

    <title>Admin-product</title>
</head>

<body class = body-robot>
    <header>
        <nav class="topnav robot-nav" id="myTopnav">
            <ul class="link-to myLinks">
                <a href="" class="active">Accueil admin</a>
                <a href="" class="link">Robot</a>
                <a href="#form-new-cat" class="link">Categories</a>
                <a href="#form-new-materials" class="link">Matières</a>
                <a href="#form-new-color" class="link">Couleurs</a>
               <a href="../setting/deconnexion.php" class="link">Deconnexion</a>
               <a 
                class="icon" >
                <i class="fa fa-bars"></i>
                </a>
            </ul>
        </nav>
    </header>
    <main class = "main-robot">
    <!---ROBOT-->
    <aside>
    <section class = "new-robot-section">
        <article class= "first">
        <label>Nouveau robot</label>
        <div class="container-filter-robot" id="container-filter-robot">
            <div class="container" id="container" for="label">
                <!--append here-->
            </div>
        </div>

        <div class="mb-3">
            <input type="text" name="name-robot" id="name-robot" placeholder="nom du futur robot">
        </div>

        <label>Couleur diponible</label>
        <div id="divParent">
            <?php
            foreach ($color as $allColor) :
            ?>
                <button class="filter-color" id="select_color_<?= $allColor['id']; ?>"><?= $allColor['name']; ?></button>
            <?php endforeach; ?>
        </div>
        <label>Matière disponible</label>
        <div class="mb-3">
            <?php foreach ($material as $mat): ?>
                <button class="filter-mat" id="select_mat_<?= $mat['id']; ?>"><?= $mat['type']; ?></button>
            <?php endforeach; ?>
        </div>

        <div class="mb-3">
            <select name="categorieNewRobot" id="categorieNewRobot">
                <?php foreach ($getCategories as $cat): ?>
                    <option value="<?= $cat['id']; ?>">
                        <?= $cat['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" value="submit-robot" class="btn btn-primary btn-action" name="submit-robot" id="submit-robot">submit</button>
    </div>
    </article>
    <!---LAYER ROBOT--->
    <article>
    <form action="" class="form-new-head" method="post" enctype="multipart/form-data">
        <label for="">Ajout tête</label>
        <input type="file" name="image-head-robot">

        <select name="head-color" id="">
            <?php foreach ($color as $colors) : ?>
                <option value="<?= $colors['id']; ?>">
                    <?= $colors['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="head-material" id="">
            <?php foreach ($material as $mat) : ?>
                <option value="<?= $mat['id']; ?>">
                    <?= $mat['type']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submit-head-robot" value="Add">
    </form>

    <form action="" class="form-new-body" method="post" enctype="multipart/form-data">
        <label for="">Ajout corps</label>
        <input type="file" name="image-body-robot">

        <select name="body-color" id="">
            <?php foreach ($color as $colors) : ?>
                <option value="<?= $colors['id']; ?>">
                    <?= $colors['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select name="body-material" id="">
            <?php foreach ($material as $mat) : ?>
                <option value="<?= $mat['id']; ?>">
                    <?= $mat['type']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="submit-body-robot" value="Add">
    </form>
    </article>
    </section>

    <!---DELETE LAYER ROBOT--->
    <div class="miniature">
        <div class="container-delete-head">
            <fieldset>
                <label for="">Delete Head</label>
                <?php foreach ($headRobot as $head) :  ?>
                    <div class="container-delete-head">
                        <img src="../assets/<?= $head['head_name']; ?>" class="display-robot-head" alt="">
                        <button name="delete-head" value="<?= $head['head_id']; ?>">Delete head</button>
                    </div>
                <?php endforeach; ?>
            </fieldset>
        </div>

        <div class="container-delete-body">
            <fieldset>
                <label for="">Delete Body</label>
                <?php foreach ($bodyRobot as $body) : ?>

                    <img src="../assets/<?= $body['body_name']; ?>" class="display-robot-head" alt="">
                    <button name="delete-body" value="<?= $body['body_id']; ?>">Delete body</button>
                <?php endforeach; ?>
            </fieldset>
        </div>
    </div>
    
    <!----FIN DELETE ROBOT-->



    <!-- <ul class="pagination" style="align-items:center;">
        <li class="disabled"><?php if ($page > 1) { ?><a href="?page=<?= $page - 1  ?>"><i class="material-icons">
                        < </i></a><?php } ?></li>

        <li class="waves-effect"> <?php for ($i = 1; $i <= $total; $i++) {
                                    ?><a href="?page=<?= $i; ?>"><?= $i; ?></a> <?php } ?></li>

        <li class="disabled"><?php if ($page < $total) { ?><a href="?page=<?= $page + 1; ?>"><i class="material-icons"> > </i></a><?php } ?></li>
    </ul> -->



    <!---CATEGORIES-->
    <div class="cat-robot">
    <form action="" method="post" id="form-new-cat">
        <div class="mb-3">
            <input type="text" class="form-control" name="name-categorie" placeholder="New categorie">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" name="submit-categorie" value="Add" class="form-control">
        </div>
    </form>

    <table>
        <th>
            Update Categorie:
        </th>
        </tr>

        <tr>
            <?php foreach ($getCategories as $categories) : ?>
                <td>
                    <?= $categories['name']; ?>
                </td>
                <td> <a href="adminProduct.php?id=<?= $categories['id']; ?>">Update categorie</a></td>

        </tr>
    <?php endforeach; ?>
    </table>


    <select name="select-category-delete" id="select-category-delete">
        <?php foreach ($getCategories as $categories) : var_dump($categories) ?>
            <option value="<?= $categories['id']; ?>">
                <?= $categories['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" id="delete-category" name="delete-category">Delete</button>




    <?php
    if (isset($_GET['id'])) {
        $singleCategorie = $robot->getCategorieById($_GET['id']);
    ?>

        <!-- <form action="" method="post" id="form-new-cat"> -->
        <div class="mb-3">
            <input type="text" id="name-cat" name="update-name-categorie" value="<?= $singleCategorie[0]['name']; ?>">
        </div>
        <div class="mb-3">
            <button type="submit" id="update-cat" name="submit-update-categorie" value="<?= $singleCategorie[0]['id']; ?>">Update</button>
        </div>
        <!-- </form> -->
        <button type=" submit" id="delete-cat" class="btn btn-danger" name="delete-categorie" value="<?= $singleCategorie[0]['id']; ?>">Delete</button>

</div>
        <?php
        } ?>

        <!---MATERIALS-->
        <form action="" method="post" id="form-new-materials" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">New Materials</label>
                <input type="text" name="new-material" placeholder="new material">
                <input type="submit" name="submit_material" class="btn btn-primary" value="Add">
            </div>
        </form>

        <!-- <form action="" method="post"> -->
        <div class="form-group">
            <label for="">Materials to delete</label>
            <select name="material" id="mat-delete" class="form-select">
                <?php foreach ($material as $materials) : ?>
                    <option value="<?= $materials['id']; ?>"><?= $materials['type']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="delete-mat" name="mat_delete" class="btn btn-danger">Delete</button>
        </div>
        <!-- </form> -->

        <!--COLOR-->
        <label for="">New Color</label>
        <form action="" method="post" id="form-new-color" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="new-color" placeholder="new color">
                <input type="submit" name="submit_color" class="btn btn-primary" value="Add">
            </div>
        </form>

        <!-- <form action="" method="post"> -->
        <div class="form-group">

            <label for="">Delete color</label>
            <select name="select_delete" id="select-delete" class="form-select">
                <?php foreach ($color as $colors) : ?>
                    <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="button-delete" class="btn btn-danger" name="button_delete">Delete</button>
        </div>
        <!-- </form> -->
        </aside>


    <?php foreach ($allRobots as $nbRobots) : ?>

<div class="display-robot">
    <div class="display-robot-name">
        <b> Nom du robot <?= $nbRobots['name_robot']; ?> </b>
    </div>
    <div class="display-robot-material">

        <b> crée par <?= $nbRobots['surname'] ?></b>

    </div>
    <!-- <div class="display-robot-head"> -->
    <img src="../assets/<?= $nbRobots['head_name']; ?>" alt="" class="display-robot-head">
    <!-- </div> -->
    <!-- <div class="display-robot-body"> -->
    <img src="../assets/<?= $nbRobots['body_name']; ?>" alt="" class="display-robot-body">
    <!-- </div> -->
    <div class="display-robot-delete">
        <button type="submit" name="delete-robot" class="delete-robot" id="delete-robot" value="<?= $nbRobots['id_robot']; ?>">DELETE</button>
    </div>
</div>
<?php
endforeach; ?>
</main>
</body>

</html>