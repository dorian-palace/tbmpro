<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once('../app/AdminProduct.php');
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();

$robot->newMaterials();
$material = $robot->getMaterials();

$robot->newCategories();
$getCategories = $robot->getCategories();

$robot->newRobotBody();
$productImage = $robot->getImages();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">New robot</label>
        <div class="mb-3">
            <input type="text" name="description-robot" placeholder="description">
        </div>
        <div class="mb-3">
            <input type="text" name="name-robot" placeholder="name-robot">
        </div>
        <div class="mb-3">
            <label for="">Choose head or body</label>

            <?php foreach ($productImage as $productImages) : ?>
                <ul>
                    <li>
                        <input type="checkbox" id="myCheckbox1" value="<?= $productImages['id']; ?>">
                        <label for="myCheckbox1"><?= '<img src="../assets/' . $productImages['name'] . '" height=250 width=400 />'; ?></label>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>

        <div class="mb-3">
            <label for="">Choose Color</label>
            <select name="color-robot" id="">
                <?php foreach ($color as $co) : ?>
                    <option value="<?= $co['id']; ?>">
                        <?= $co['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Choose Material</label>
            <select name="materials-robot" id="">
                <?php foreach ($material as $mat) : ?>
                    <option value="<?= $mat['id']; ?>">
                        <?= $mat['type']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" name="submit-robot">
    </form>

    <!---LAYER ROBOT--->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Add new Head / body</label>
        <input type="text" name="description-layer" placeholder="Description">
        <input type="text" name="name-layer" placeholder="Layer name">
        <input type="file" name="image-layer">

        <select name="categorie-layer" id="">
            <?php foreach ($getCategories as $select_Cat) : ?>
                <option value="<?= $select_Cat['id']; ?>">
                    <!--Categorie du robot-->
                    <?= $select_Cat['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="submit-layer" value="Add">
    </form>

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
            <input type="file" name="material" class="form-control-file" placeholder="New Materials">
            <input type="submit" name="submit_material" class="btn btn-primary" value="Add">
        </div>
    </form>

    <form action="" method="post">
        <div class="form-group">
            <label for="">Materials to delete</label>
            <select name="material" class="form-select">
                <?php foreach ($material as $materials) { ?>
                    <option value="<?= $materials['id']; ?>"><?= $materials['type']; ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="mat_delete" class="btn btn-danger" value="<?= $materials['id']; ?>">Delete</button>
            <?php $robot->deleteMaterials(@$_POST['material']); ?>
        </div>
    </form>

    <!--COLOR-->
    <label for="">New Color</label>
    <form action="" method="post" id="form-new-color" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" class="form-control-file" name="color" placeholder="color">
            <input type="submit" name="submit_color" class="btn btn-primary" value="Add">
        </div>
    </form>

    <form action="" method="post">
        <div class="form-group">

            <select name="select_delete" id="" class="form-select">
                <?php foreach ($color as $colors) { ?>
                    <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
                <?php } ?>
            </select>

            <button type="submit" class="btn btn-danger" name="button_delete" value="<?= $colors['id']; ?>">Delete</button>
            <?php $robot->deleteColor(@$_POST['select_delete']); ?>
        </div>
    </form>


</body>

</html>