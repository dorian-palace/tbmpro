<?php 

// require_once('../app/User.php');
// require_once('./setting/data.php');
if (isset($_SESSION['id_role']))
$userId = intval($_SESSION['id_role']);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="./assets/img/favIcon.ico">
    <link href="styleNav.css" rel="stylesheet" />
    <script type="text/javascript" src="scriptNav.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <a href="./devis.php" class="link">Devis</a>
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
                    </ul>            
                <?php  } ?> 
                <a 
                class="icon" >
                <i class="fa fa-bars"></i>
                </a>
            </div>
        </nav>
   </header> 
</body>
</html>


  
