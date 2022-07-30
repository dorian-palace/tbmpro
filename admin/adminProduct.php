<?php
require_once('../app/AdminProduct.php');

if ($_SESSION['id_role'] == 1) {
    header('Location: ../index.php');
}
// var_dump($_SESSION);
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();

$robot->newMaterials();
$material = $robot->getMaterials();

// $robot->newCategories();
// $getCategories = $robot->getCategories();

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
                <a href=" ../admin.php" class="active">Accueil admin</a>
                <a href="#main-robot" class="link">Robot</a>
                <!-- <a href="#form-new-cat" class="link">Categories</a> -->
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
    <article class="block-aside-robot">
    <aside>
        <section class = "new-robot-section">
            <article class= "first">
                
                <div class="container-filter-robot" id="container-filter-robot">
                    <div class="container" id="container" for="label">
                        <!--append here-->
                    </div>
                <label>Nouveau robot</label>
                </div>
                        <!-- nom du robot -->
                <div class="mb-3">
                    <input type="text" name="name-robot" id="name-robot" placeholder="nom du futur robot">
                </div>

                <label>Filtrer par couleur:</label>
                    <div id="divParent">
                        <?php
                        foreach ($color as $allColor) :
                        ?>
                            <button class="filter-color" id="select_color_<?= $allColor['id']; ?>"><?= $allColor['name']; ?></button>
                        <?php endforeach; ?>
                    </div>

                <label>Filtrer par matière:</label>
                <div class="mb-3">
                    <?php foreach ($material as $mat): ?>
                        <button class="filter-mat" id="select_mat_<?= $mat['id']; ?>"><?= $mat['type']; ?></button>
                    <?php endforeach; ?>
                </div>

                
                    <button type="submit" value="submit-robot" class="btn btn-input btn-primary btn-action" name="submit-robot" id="submit-robot">Créer</button>
                </div>

               
            </article>

            <!---LAYER ROBOT--->
            <article>
                 <form action="" class="form-new-head" method="post" enctype="multipart/form-data">
                    <label for="">Ajout tête</label>
                    <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" class = "btn-input" name="image-head-robot">

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

                    <input type="submit" class = "btn-input btn-primary btn-action" name="submit-head-robot" accept="image/png, image/jpg, image/gif, image/jpeg" value="Add">
                    </form>

                    <form action="" class="form-new-body" method="post" enctype="multipart/form-data">
                        <label for="">Ajout corps</label>
                        <input type="file" accept="image/png, image/jpg, image/gif, image/jpeg" class = "btn-input" name="image-body-robot">

                        <select name="body-color" class="select-list">
                            <?php foreach ($color as $colors) : ?>
                                <option value="<?= $colors['id']; ?>">
                                    <?= $colors['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <select name="body-material" class="select-list">
                            <?php foreach ($material as $mat) : ?>
                                <option value="<?= $mat['id']; ?>">
                                    <?= $mat['type']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" class = "btn-input btn-primary btn-action" name="submit-body-robot" value="Add">
                    </form>
                </article>
        </section>

            <!---DELETE LAYER ROBOT--->
            <section class="miniature">
                <div class="container-delete-head">
                    <fieldset>
                        <label for="">Delete Head</label>
                        <?php foreach ($headRobot as $head) :  ?>
                            <div class="container-delete-head head-robo">
                                <img src="../assets/<?= $head['head_name']; ?>" class="display-robot-head" alt="">
                                <button name="delete-head" value="<?= $head['head_id']; ?>"><i class="fa-regular fa-trash-can" style="color: #bc9b67;"></i></button> 
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                </div>

                <div class="container-delete-body">
                    <fieldset>
                        <label for="">Delete Body</label>
                        <?php foreach ($bodyRobot as $body) : ?>

                            <img src="../assets/<?= $body['body_name']; ?>" class="display-robot-head" alt="">
                            <button name="delete-body" value="<?= $body['body_id']; ?>"><i class="fa-regular fa-trash-can" style="color: #bc9b67;"></i></button>
                        <?php endforeach; ?>
                    </fieldset>
                </div>
            </section>
            
            <!----FIN DELETE ROBOT-->



       

            <!---MATERIALS-->
        <section class="color-material">
            <form action="" method="post" id="form-new-materials" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Nouvelle matière</label>
                    <input type="text" name="new-material" placeholder="new material">
                    <input type="submit" name="submit_material" class="btn-input btn-primary" value="Add">
                </div>
            </form>

            
            <!--COLOR-->
            <label for="">Nouvelle couleur</label>
            <form action="" method="post" id="form-new-color" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="new-color" placeholder="new color">
                <input type="submit" name="submit_color" class="btn-input btn-primary" value="Add">
            </div>
        </form>
        
        <div class="form-group">
            <label for="">Supprimer une matière</label>
            <select name="material" id="mat-delete" class="form-select">
                <?php foreach ($material as $materials) : ?>
                    <option value="<?= $materials['id']; ?>"><?= $materials['type']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="delete-mat" name="mat_delete" class="btn-input btn-danger">Delete</button>
        </div>
        
            <div class="form-group">
                <label for="">Supprimer une couleur</label>
                <select name="select_delete" id="select-delete" class="form-select">
                    <?php foreach ($color as $colors) : ?>
                        <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" id="button-delete" class="btn-input btn-danger" name="button_delete">Delete</button>
            </div>
        </section>  
    </aside>
    
    <article class="flex-central">
        <!-- <section class="visu-robot">

        </section> -->
        <!-- <section class="bottom-robot"> -->
        
                    <div class="block-central">
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
                            <button type="submit" name="delete-robot" class="delete-robot" id="delete-robot" value="<?= $nbRobots['id_robot']; ?>"><i class="fa-regular fa-trash-can" style="color: #bc9b67;"></i></button>
                        </div>
                    </div>
                    <?php
                endforeach; ?>
            </div>
        <!-- </section> -->
    </article>

</article>

</main>
</body>

</html>