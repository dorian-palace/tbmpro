<?php
// require_once('setting/data.php');
require_once('/Applications/MAMP/htdocs/tbmpro/setting/db.php');
// require_once('app/AdminArticle.php');
require_once('/Applications/MAMP/htdocs/tbmpro/app/AdminArticle.php');
// require_once('app/User.php');

$allArticle = new AdminArticle();
$articles = $allArticle->getAllArticles();
echo '<pre>';
var_dump($articles);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
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
    <main class="galerie">
        <div class="responsive">
                <?php foreach ($articles as $article) :?>
                <div class="gallery">
                    <div class="image-article">
                        <?php 
                            echo ('<a target="_blank" href="assets/img/'.$article['name'].'">');
                            echo ('<img src="assets/img/'.$article['name'].'" height="400" width="200"/>');
                        ?>
                    </div>
                    <div class="desc"><h2><?=$article['title']?></h2></div>
                </div>
                <?php
                endforeach; ?>
            </div>
    </main>
    <footer>
        <?php require_once("layouts/footer.php")?>
    </footer>
</body>
</html>