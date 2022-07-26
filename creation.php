<?php
require_once('C:\wamp64\www\tbmpro\setting\db.php');
require_once('C:\wamp64\www\tbmpro\setting\data.php');
require_once('C:\wamp64\www\tbmpro\app\User.php');
require_once('C:\wamp64\www\tbmpro\app\Robots.php');

$robot = new Robots();

$getColor = $robot->getColor();
$getMaterial = $robot->getMaterials();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/creation.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation</title>
</head>

<body>
    <style>
        #box-robots-filter,
        #box-color-body,
        #box-color-head {
            max-width: 100px;
        }

        #headContainer {
            display: flex;
            justify-content: center;
            background-color: red;
            border-color: red;
        }
    </style>
    <header>
        <?php require_once("layouts/navbar.php") ?>
    </header>
    <!-----

Modification des foreach pour les filtres, un bouton couleur pour les têtes.

Un bouton couleur pour les corps.
Un bouton matériau pour les corps.
Un bouton matériau pour les têtes.

---->
    <div class="leftMenu">

        <div class="headComponent" id="headComponent">

        </div>

        <div class="bodyComponent" id="bodyComponent">

        </div>

        <div class="filterColorHead">

            <b>Heads Colors</b>

            <?php foreach ($getColor as $color) : ?>

                <button name="select-color-head" class="select-color-head" id="select-color-<?= $color['id']; ?>"><?= $color['name']; ?></button>

            <?php endforeach; ?>
        </div>

        <div class="filterMaterialHead">
            <b>Heads Materials</b>

            <?php foreach ($getMaterial as $material) : ?>

                <button name="select-material" class="select-material-head" id="select-material-<?= $material['id']; ?>"><?= $material['type']; ?></button>

            <?php endforeach; ?>
        </div>

        <div class="filterColorBody">
            <b>Body Colors</b>

            <?php foreach ($getColor as $color) : ?>

                <button name="select-color-body" class="select-color-body" id="select-color-<?= $color['id']; ?>"><?= $color['name']; ?></button>

            <?php endforeach; ?>

        </div>

        <div class="filterMaterialBody">
            <b>Body Materials</b>

            <?php foreach ($getMaterial as $material) : ?>

                <button name="select-material" class="select-material-body" id="select-material-<?= $material['id']; ?>"><?= $material['type']; ?></button>

            <?php endforeach; ?>
        </div>

        <div class="displayRobot">

            <div class="headContainer" id="headContainer">

            </div>

            <div class="bodyContainer">

            </div>

            <button type="submit" class="submit-robot" id="submit-robot-" name="submit-robot">Submit</button>
        </div>

        <footer>
            <!-- <?php require_once("layouts/footer.php") ?> -->
        </footer>
</body>

</html>