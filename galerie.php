<?php
// require_once('setting/data.php');
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// require_once('app/AdminArticle.php');
require_once('/Applications/MAMP/htdocs/tbmpro/app/AdminArticle.php');
// require_once('app/User.php');

$allArticle = new AdminArticle();
$articles = $allArticle->getAllArticles();

// echo '<pre>';
// var_dump($articles);
// echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <script type="text/javascript" src="js/gallery.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
</head>
<body>
    <header>
        <?php require_once("layouts/navbar.php")?>
    </header>
    <main class="main-galerie">
            <?php foreach ($articles as $article) :?>
                        <?php 
                            // echo('<img id="'.$article['id'].'" alt= "'.$article['title'].'" class = "img-galerie" src="assets/img/'.$article['name'].'" alt="Snow" >'); 888 spannnnii<3 <span class="close">&times;</span>
                            echo ('<div id="myModal" class = "image-galerie modal-test"><a href="article.php?article='.$article['id'].'"><img id="'.$article['id_image'].'" class= "modal-content img-galerie" src="assets/img/'.$article['name'].'"/></a></div>');

                        ?>
            <?php endforeach; ?>
                 
    </main>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>

</body>
</html>