<?php
require_once('../app/AdminProduct.php');
$robot = new AdminRobot();
$robot->newColor();
$robot->getColor();
$color = $robot->getColor();

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
    <!--COLOR-->
    <label for="">New Color</label>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="color" placeholder="color">
        <input type="submit" name="submit_color" value="submit">
    </form>

    <form action="" method="post">

        <select name="select_delete" id="">
            <?php foreach ($color as $colors) { ?>
                <option value="<?= $colors['id']; ?>"><?= $colors['name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="button_delete" value="<?= $colors['id']; ?>">DELETE</button>
        <?php $robot->deleteColor(@$_POST['select_delete']); ?>
    </form>




    <form action="" method="post" name="form_robot">
        <input type="text" name="description">
        <input type="text" name="name">
        <input type="text" name="image">
        <input type="text" name="color">
        <input type="text" name="material">
        <input type="submit" name="submit_robot">
    </form>
</body>

</html>