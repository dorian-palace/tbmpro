<?php
require_once('../app/AdminProduct.php');
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();
$robot->newMaterials();
$material = $robot->getMaterials();

$robot->newCategories();
$getCategories = $robot->getCategories();

echo "<pre>";
var_dump($getCategories);
echo "</pre>";
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
    <ul>
        <li><a href="">Manage Robot</a></li>
        <li><a href="">Manage Categories</a></li>
        <li><a href="#form-new-materials">Manage materials</a></li>
        <li><a href="#form-new-color">Manage colors</a></li>
    </ul>

    <!---ROBOT-->


    <!---CATEGORIES-->
    <form action="" method="post" id="form-new-cat">
        <input type="text" name="name-categorie" placeholder="New categorie">
        <input type="submit" name="submit-categorie" value="Add">
    </form>

    <table>
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
        <form action="" method="post">
            <input type="text" name="update-name-categorie" value="<?= $singleCategorie[0]['name']; ?>">
            <input type="submit" name="submit-update-categorie">
        </form>
        <button type="submit" name="delete-categorie" value="<?= $singleCategorie[0]['id']; ?>">Delete</button>
    <?php
    }
    ?>




    <!---MATERIALS-->
    <label for="">New Materials</label>
    <form action="" method="post" id="form-new-materials" enctype="multipart/form-data">
        <input type="file" name="material" placeholder="New Materials">
        <input type="submit" name="submit_material" value="Add">
    </form>

    <form action="" method="post">
        <label for="">Materials to delete</label>
        <select name="material">
            <?php foreach ($material as $materials) { ?>
                <option value="<?= $materials['id']; ?>"><?= $materials['type']; ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="mat_delete" value="<?= $materials['id']; ?>">Delete</button>
        <?php $robot->deleteMaterials(@$_POST['material']); ?>
    </form>

    <!--COLOR-->
    <label for="">New Color</label>
    <form action="" method="post" id="form-new-color" enctype="multipart/form-data">
        <input type="file" name="color" placeholder="color">
        <input type="submit" name="submit_color" value="Add">
    </form>

    <form action="" method="post">

        <select name="select_delete" id="">
            <?php foreach ($color as $colors) { ?>
                <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="button_delete" value="<?= $colors['id']; ?>">Delete</button>
        <?php $robot->deleteColor(@$_POST['select_delete']); ?>
    </form>


</body>

</html>