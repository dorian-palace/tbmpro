<?php
require_once('setting/data.php');
require_once('app/User.php');
require_once('app/Robots.php');

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
    <script src="js/canvas.js"></script>
    <script src="js/creation.js"></script>
    <script src="js/html2canvas.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function mooveBody(id) {
            console.log(id)
            const leftContainer = document.getElementsByClassName("bodyComponent");
            const mainContainer = document.getElementsByClassName("bodyContainer");

            // console.log(leftContainer[0].children[0].children[0].children[0].getAttribute("value"))
            // incremente all the value of the body component
            console.log(leftContainer[0].children)
            for (let i = 0; i < leftContainer[0].children.length; i++) {
                const o = leftContainer[0].children[i].children[0].children[0].getAttribute("value")
                if (o == id) {
                    console.log(leftContainer[0].children[i])

                    if (mainContainer[0].children.length == 0) {
                        $(mainContainer).append(leftContainer[0].children[i])
                    } else {
                        // mainContainer[0].insertBefore(leftContainer[0].children[i], mainContainer[0].children[0])
                        $(leftContainer).append(mainContainer[0].children[0])
                        $(mainContainer).append(leftContainer[0].children[i])

                    }
                }
            }

            for (let i = 0; i < leftContainer[0].children.length; i++) {
                const a = leftContainer[i];
                // console.log(a)
            }
        }

        function mooveHead(id) {
            console.log(id)
            const leftContainer = document.getElementsByClassName("headComponent");
            const mainContainer = document.getElementsByClassName("headContainer");
            console.log(leftContainer)

            // console.log(leftContainer[0].children[0].children[0].children[0].getAttribute("value"))
            // incremente all the value of the body component
            console.log(leftContainer[0].children)
            for (let i = 0; i < leftContainer[0].children.length; i++) {
                const o = leftContainer[0].children[i].children[0].children[0].getAttribute("value")
                if (o == id) {
                    console.log(leftContainer[0].children[i])

                    if (mainContainer[0].children.length == 0) {
                        $(mainContainer).append(leftContainer[0].children[i])
                    } else {
                        // mainContainer[0].insertBefore(leftContainer[0].children[i], mainContainer[0].children[0])
                        $(leftContainer).append(mainContainer[0].children[0])
                        $(mainContainer).append(leftContainer[0].children[i])

                    }
                }
            }

            for (let i = 0; i < leftContainer[0].children.length; i++) {
                const a = leftContainer[i];
                // console.log(a)
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation</title>
</head>

<body>
    <style>
        #box-head-filter,
        #box-body-filter,
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

        .test {
            display: flex;
            justify-content: center;
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
    <aside>
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
        </div>
    </aside>

    <main>
        <div class="displayRobot" id="displayRobot">

            <div class="headContainer" id="headContainer">

            </div>

            <div class="bodyContainer" id="bodyContainer">

            </div>

        </div>

        <button type="submit" class="screenshot" id="screenshot" name="submit-robot">Screen</button>
    </main>

    <footer>
        <!-- <?php require_once("layouts/footer.php") ?> -->
    </footer>
</body>

</html>