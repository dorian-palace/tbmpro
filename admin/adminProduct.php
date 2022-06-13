<?php
require_once('../app/AdminProduct.php');
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();
$robot->newMaterials();
$material = $robot->getMaterials();


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

    <!---MATERIALS-->
    <label for="">New Materials</label>
    <form action="" method="post" enctype="multipart/form-data">
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
        <?php $robot->deleteMaterials(@$_POST['mat_delete']); ?>
    </form>

    <!--COLOR-->
    <label for="">New Color</label>
    <form action="" method="post" enctype="multipart/form-data">
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