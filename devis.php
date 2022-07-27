`<?php

    require_once('app/Devis.php');

    $devis = new Devis();
    $userData = $devis->getAllInfosFromUser();
    $robotData = $devis->getLastRobotFromUser();

    // foreach ($userData as $user) {
    //     // $user[$key] = $value;
    //     echo "<pre>";
    //     var_dump($user);
    //     echo "</pre>";
    // }


    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/devis.js"></script>
    <script src="js/html2canvas.js"></script>

    <title>devis</title>
</head>

<body>
    <div class="container" id="container">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, quidem. Earum, praesentium quam autem dolore odit itaque omnis aspernatur provident tenetur doloribus non cupiditate laborum commodi voluptate, similique consectetur sequi.
        <?php

        foreach ($robotData as $robot) {
            // $robot[$key] = $value;
            echo "<pre>";
            var_dump($robotData);
            echo "</pre>";
        }

        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";
        ?>
    </div>
    <button class="screen-shot-devis" id="screen-shot-devis">DEVIS</button>
</body>

</html>