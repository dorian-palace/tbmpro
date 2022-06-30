<?php
require_once('../app/AdminProduct.php');
var_dump($_POST);
echo "blalazelkalzekae";
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
// $headColor = $headRobot['id_color'];
echo "<pre>";
// var_dump($robot->getHeadRobots());
// var_dump($robot->getBodyRobots());
// $headColor;
echo "</pre>";
// foreach ($headRobot as $head) {


//     $headMaterial = $head['id_material'];
//     $layer = $head['name'];
//     echo " <img src='../assets/" . $head['name'] . "' height=250 width=400 />";
//     echo "<pre>";

//     // var_dump($head);
//     // var_dump($headColor);
//     // var_dump($headMaterial);
//     // var_dump($layer);
//     echo "</pre>";
// }

foreach ($bodyRobot as $body) {

    $bodyColor = $body['id_color'];
    $bodyMaterial = $body['id_material'];
    $layer = $body['name'];
    echo "<pre>";

    // var_dump($body);
    // var_dump($bodyColor);
    // var_dump($bodyMaterial);
    // var_dump($layer);
    echo "</pre>";
}

// $robot->getHeadByColorAndMaterial();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="admin.js"></script>

    <title>Admin-product</title>
</head>

<body>

    <div class="container" id="container"></div>

    <ul>
        <li><a href="">Manage Robot</a></li>
        <li><a href="">Add head & body to robot</a></li>
        <li><a href="">Manage Categories</a></li>
        <li><a href="#form-new-materials">Manage materials</a></li>
        <li><a href="#form-new-color">Manage colors</a></li>
    </ul>

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


    <!---ROBOT-->
    <!-- <form action="" method="post" enctype="multipart/form-data"> -->
    <label for="">New robot</label>
    <div class="mb-3">
        <input type="text" name="name-robot" placeholder="name-robot">
    </div>

    <div class="mb-3">
        <label for="">Choose Color</label>
        <select name="select-co" id="">
            <?php foreach ($color as $co) : ?>
                <option value="<?= $co['id']; ?>"><?= $co['name']; ?></option>
            <?php endforeach; ?>
        </select>

    </div>

    <div id="divParent">
        <?php
        foreach ($color as $allColor) :
        ?>
            <button class="test" id="select_color_<?= $allColor['id']; ?>"><?= $allColor['name']; ?></button>


        <?php endforeach; ?>
    </div>

    <div class="mb-3">

        <?php foreach ($material as $mat) : ?>
            <button class="mat_robots" id="select_mat_<?= $mat['id']; ?>"><?= $mat['type']; ?></button>
        <?php endforeach; ?>


    </div>

    <div class="mb-3">
        <label for="">Choose head</label>

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
        <label for="">Choose body</label>

        <?php foreach ($productImage as $productImages) : ?>
            <ul>
                <li>
                    <input type="checkbox" id="myCheckbox1" value="<?= $productImages['id']; ?>">
                    <label for="myCheckbox1"><?= '<img src="../assets/' . $productImages['name'] . '" height=250 width=400 />'; ?></label>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>

    <input type="submit" class="btn btn-primary" name="submit-robot">
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
    echo "<pre>";
    var_dump($_POST['head-color']);
    echo "</pre>";

    ?>

</body>

</html>