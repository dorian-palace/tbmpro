<?php
require_once('setting/data.php');
require_once('app/User.php');
require_once('app/Robots.php');

if (isset($_SESSION['id_role']))
$userId = intval($_SESSION['id_role']);

$robot = new Robots();

$getColor = $robot->getColor();
$getMaterial = $robot->getMaterials();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="footer, address, phone, icons" />
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <script src="js/canvas.js"></script>
    <script src="js/creation.js"></script>
    <script src="js/html2canvas.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styleModule.css">
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
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
   
    <title>Creation</title>
</head>

<body>
    
    <header>
        <nav>
            <div class="topnav" id="myTopnav">
                 
                 <?php if(isset($userId)&&($userId === 1)){ ?>
                     
                    <ul id="myLinks">
                        <a href="./index.php" class="active">Accueil</a>
                        <a href="./galerie.php" class="link">Galerie</a>
                        <!-- <a href="./products.php" class="link">Produits</a> -->
                        <a href="./creation.php" class="link">Module</a>
                        <a href="./profil.php" class="link">Profil</a>
                        <a href="./setting/deconnexion.php"class="link">Deconnexion</a>
                    </ul> 
                    <?php  } ?> 

                <?php if(isset($userId)&&($userId === 10)){ ?>
                    <ul id="myLinks">     
                        <a href="./index.php" class="active">Accueil</a>
                        <a href="./galerie.php" class="link">Galerie</a>
                        <!-- <a href="./products.php" class="link">Produits</a> -->
                        <a href="./creation.php" class="link">Module</a>
                        <a href="./admin.php" class="link">Admin</a>
                        <a href="./setting/deconnexion.php"class="link">Deconnexion</a>
                    </ul>            
                <?php  } ?>    

                <?php if(isset($userId)&&($userId === 100)){ ?>
                    <ul id="myLinks">     
                        <a href="./index.php" class="active">Accueil</a>
                        <a href="./galerie.php" class="link">Galerie</a>
                        <!-- <a href="./products.php" class="link">Produits</a> -->
                        <a href="./creation.php" class="link">Module</a>
                        <a href="./admin.php" class="link">Admin</a>
                        <a href="./setting/deconnexion.php"class="link">Deconnexion</a>
                    </ul>            
                <?php  } ?> 
                <?php if(empty($_SESSION)){ ?>
                    <ul id="myLinks">     
                    <a href="./index.php" class="active">Accueil</a>
                    <a href="./inscription.php"class="link">Inscription</a>
                    <a href="./connexion.php" class="link">Connexion</a>
                    <a href="./galerie.php" class="link">Galerie</a>
                    <a href="./products.php" class="link">Produits</a>
                    </ul>            
                <?php  } ?> 
                <a 
                class="icon" >
                <i class="fa fa-bars"></i>
                </a>
            </div>
        </nav>
    </header>
    <!-----

Modification des foreach pour les filtres, un bouton couleur pour les têtes.

Un bouton couleur pour les corps.
Un bouton matériau pour les corps.
Un bouton matériau pour les têtes.

---->
   
    <main> 
        <section class="scene">
            <aside>
                <div class="leftMenu">

                    <div class="headComponent" id="headComponent">

                    </div>

                    <div class="bodyComponent" id="bodyComponent">

                    </div>

                    <div class="filterColorHead">

                    <h3>Heads Colors</h3><br>

                    <?php foreach ($getColor as $color) : ?>

                        <button name="select-color-head" class="select-color-head" id="select-color-<?= $color['id']; ?>"><?= $color['name']; ?></button>

                    <?php endforeach; ?>
                    </div>

                    <div class="filterMaterialHead">
                        <h3>Heads Materials</h3><br>

                        <?php foreach ($getMaterial as $material) : ?>

                            <button name="select-material" class="select-material-head" id="select-material-<?= $material['id']; ?>"><?= $material['type']; ?></button>

                        <?php endforeach; ?>
                    </div>

                    <div class="filterColorBody">
                        <h3>Body Colors</h3><br>

                        <?php foreach ($getColor as $color) : ?>

                            <button name="select-color-body" class="select-color-body" id="select-color-<?= $color['id']; ?>"><?= $color['name']; ?></button>

                        <?php endforeach; ?>

                    </div>

                    <div class="filterMaterialBody">
                        <h3>Body Materials</h3><br>

                        <?php foreach ($getMaterial as $material) : ?>

                            <button name="select-material" class="select-material-body" id="select-material-<?= $material['id']; ?>"><?= $material['type']; ?></button>

                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>

        </section>
                <?php
                $_SESSION;
                ?>
                <div class="displayRobot" id="displayRobot">

                    <div class="headContainer" id="headContainer">

                    </div>

                    <div class="bodyContainer" id="bodyContainer">

                    </div>

                </div>
            <div class="screen-div">
                <input type="text" name="name" placeholder="name" id="name-robot" class="name-robot">
                <button type="submit" class="screenshot btn_submit" id="screenshot" name="submit-robot">Sauvegarder</button>
            </div>
    </main>

    <footer class="footer-distributed">

        <div class="footer-left">

            <h3>Technology<span>BasedMagic</span></h3>

            <p class="footer-links">
                <a href="#">Accueil</a>
                ·
                <a href="#">Nous</a>
                ·
                <a href="#">Connexion</a>
                ·
                <a href="#">Inscription</a>
                ·
                <a href="#">Galerie</a>
                
            </p>

            <p class="footer-company-name">technologybasedmagic &copy; 2022</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span></span> Aix en Provence, France</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>Tél +33.(0).6.26.02.49.04</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:contact@tbm-studio.com">contact@tbm-studio.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>

            </div>

        </div>

    </footer>
</body>

</html>