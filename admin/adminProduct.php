<?php
require_once('../app/AdminProduct.php');
// var_dump($_POST);
// echo "blalazelkalzekae";
var_dump($_SESSION);
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();

$robot->newMaterials();
$material = $robot->getMaterials();

$robot->newCategories();
$getCategories = $robot->getCategories();

$robot->newRobotHead();
$robot->newRobotBody();
$productImage = $robot->getImages();

$headRobot = $robot->getAllHeadRobots();

$bodyRobot = $robot->getAllBodyRobots();
echo "<pre>";
echo "</pre>";

foreach ($bodyRobot as $body) {

    $bodyColor = $body['id_color'];
    $bodyMaterial = $body['id_material'];
    $layer = $body['name'];
    echo "<pre>";
    echo "</pre>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../layouts/a.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="../js/adminRobots.js"></script>
    <link rel="stylesheet" href="css.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <title>Admin-product</title>
</head>

<body>


    <ul>
        <li><a href="">Manage Robot</a></li>
        <li><a href="">Add head & body to robot</a></li>
        <li><a href="">Manage Categories</a></li>
        <li><a href="#form-new-materials">Manage materials</a></li>
        <li><a href="#form-new-color">Manage colors</a></li>
    </ul>

    <!---ROBOT-->
    <!-- <form action="" method="post" enctype="multipart/form-data"> -->
    <label for="">New robot</label>

    <div class="container-filter-robot" id="container-filter-robot">


        <div class="container" id="container" for="label"></div>


    </div>

    <div class="mb-3">
        <input type="text" name="name-robot" id="name-robot" placeholder="name-robot">
    </div>




    <div id="divParent">
        <?php
        foreach ($color as $allColor) :
        ?>
            <button class="filter-color" id="select_color_<?= $allColor['id']; ?>"><?= $allColor['name']; ?></button>


        <?php endforeach; ?>
    </div>

    <div class="mb-3">

        <?php foreach ($material as $mat) : ?>
            <button class="filter-mat" id="select_mat_<?= $mat['id']; ?>"><?= $mat['type']; ?></button>
        <?php endforeach; ?>


    </div>

    <div class="mb-3">
        <select name="categorieNewRobot" id="categorieNewRobot">
            <?php foreach ($getCategories as $cat) : ?>
                <option value="<?= $cat['id']; ?>">
                    <?= $cat['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary" name="submit-robot" id="submit-robot"> submit</button>
    <!-- <input type="submit" > -->
    <!-- </form> -->

    <!---LAYER ROBOT--->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Add new Head</label>
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

    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Add new body</label>
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


    <?php
    // echo "<pre>";
    // var_dump($_POST['head-color']);
    // echo "</pre>";

    ?>


    <!---CATEGORIES-->
    <form action="" method="post" id="form-new-cat">
        <div class="mb-3">
            <input type="text" class="form-control" name="name-categorie" placeholder="New categorie">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" name="submit-categorie" value="Add" class="form-control">
        </div>
    </form>

    <table class="table">
        <tr>
            <th>
                Categorie:
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

    <?php
    if (isset($_GET['id'])) {
        $singleCategorie = $robot->getCategorieById($_GET['id']);
        $robot->updateCategorie($_GET['id']);
        $robot->deleteCategorie($_GET['id']);
    ?>


        <form action="" method="post" id="form-new-cat">
            <div class="mb-3">
                <input type="text" name="update-name-categorie" value="<?= $singleCategorie[0]['name']; ?>">
            </div>
            <div class="mb-3">
                <input type="submit" name="submit-update-categorie">
            </div>
        </form>
        <button type="submit" class="btn btn-danger" name="delete-categorie" value="<?= $singleCategorie[0]['id']; ?>">Delete</button>
    <?php
    }
    ?>

    <!---MATERIALS-->
    <form action="" method="post" id="form-new-materials" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">New Materials</label>
            <input type="text" name="new-material" placeholder="new material">
            <input type="submit" name="submit_material" class="btn btn-primary" value="Add">
        </div>
    </form>

    <form action="" method="post">
        <div class="form-group">
            <label for="">Materials to delete</label>
            <select name="material" class="form-select">
                <?php foreach ($material as $materials) : ?>
                    <option value="<?= $materials['id']; ?>"><?= $materials['type']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="mat_delete" class="btn btn-danger" value="<?= $materials['id']; ?>">Delete</button>
            <?php $robot->deleteMaterials(@$_POST['material']); ?>
        </div>
    </form>

    <!--COLOR-->
    <label for="">New Color</label>
    <form action="" method="post" id="form-new-color" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="new-color" placeholder="new color">
            <input type="submit" name="submit_color" class="btn btn-primary" value="Add">
        </div>
    </form>

    <form action="" method="post">
        <div class="form-group">

            <label for="">Delete color</label>
            <select name="select_delete" id="" class="form-select">
                <?php foreach ($color as $colors) : ?>
                    <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-danger" name="button_delete" value="<?= $colors['id']; ?>">Delete</button>
            <?php $robot->deleteColor(@$_POST['select_delete']); ?>
        </div>
    </form>


</body>

</html>