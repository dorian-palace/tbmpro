`<?php
    require_once('app/Devis.php');

    $devis = new Devis();
    $userData = $devis->getAllInfosFromUser();
    $robotData = $devis->getLastRobotFromUser();
    $quote = $devis->getLastQuotes();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/devis.js"></script>
    <script src="js/html2canvas.js"></script>
    <link rel="stylesheet" href="layouts/devis.css">

    <title>devis</title>
</head>


<body>
    <header>
        <?php require_once("layouts/navbar.php") ?>
    </header>

    <main>
        <?php foreach ($quote as $quotes) :  ?>

            <div class="container-quotes" id="container">
                <div class="client">
                    <label for="">Devis</label></br>
                    <tr>Nom: </tr>
                    <td><?= $quotes['name']; ?></td></br>
                    <tr>Prenom: </tr>
                    <td><?= $quotes['surname']; ?></td></br>
                    <tr>Mail :</tr>
                    <td><?= $quotes['mail']; ?></td></br>
                    <tr>Nom du Robot :</tr>
                    <td><?= $quotes['name_robot']; ?></td></br>
                </div>
                <div class="robot">

                    <div class="head">
                        <img src="assets/<?= $quotes['head_name']; ?>" alt="">
                    </div>

                    <div class="body">
                        <img src="assets/<?= $quotes['body_name']; ?>" alt="">
                    </div>

                </div>

            </div>
            <div class="button-container">
                <button class="screen-shot-devis" id="screen-shot-devis">DEVIS</button>
            </div>
        <?php endforeach ?>
    </main>
    <footer>
        <?php require_once("layouts/footer.php") ?>
    </footer>
</body>

</html>