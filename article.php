<?php

// require_once('setting/data.php');
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// require_once('app/AdminArticle.php');
require_once('/Applications/MAMP/htdocs/tbmpro/app/AdminArticle.php');
// require_once('app/User.php');



if (isset($_GET['article'])){
    $articleId = intval($_GET['article']);
};

$getArticle = new AdminArticle();
$article = $getArticle->getArticleById($articleId);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script type="text/javascript" src="layouts/scriptNav.js"></script>
        <script type="text/javascript" src="js/gallery.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="layouts/styleNav.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Article</title>
    </head>
    <body>
        <header>
            <?php require_once("layouts/navbar.php")?>
        </header>
        <main class="main-article">
            <section class="banner">
            <span class="background"><img src="assets/img/<?=$article['name']?>" alt="logo technologie based magic"></span>
            <h1><?=$article['title']?></h1>
            </section>


            <article class = "article-solo form_box" >
            <p><?=$article['text']?></p>
            </article>
                 
        </main>
        <footer>
            <?php require_once("layouts/footer.php")?>
        </footer>

    </body>
</html>