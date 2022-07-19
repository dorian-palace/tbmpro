<?php
require_once('setting/data.php');
require_once('app/User.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <header>
    <?php require_once("layouts/navbar.php")?>
    </header>
    <main>
        <section class="acceuil_logo">
                <img src="assets/img/bck_techM_1920.jpg" alt="logo technologie based magic">
        </section>
        <section>
            

        </section>
        <section>

        </section>
        <footer>
        <?php require_once("layouts/footer.php")?>
        </footer>
    </main>
</body>
</html>