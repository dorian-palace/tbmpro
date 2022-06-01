<?php
require_once('../app/AdminArticle.php');
require_once('../app/AdminUser.php');


$artnew = new AdminArticle();
$articleSolo = $artnew->getArticleById(1);
$articles = $artnew->getAllArticles();

var_dump($articles);

var_dump($articleSolo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminArticle</title>
</head>
<body>
    <main>
        <article>
            <table>
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>text</th>
                </tr>

            <?php foreach ($articles as $article) :
                echo "<pre>";
                var_dump($article['text']);
                echo "</pre>";

            ?>
                <tr>
                    <td><?= $article['id']; ?></td>
                    <td><?= $article['id_image']; ?></td>
                    <td><?= $article['text']; ?></td>
                    <td><a href="adminArticle.php?id=<?= $article['id'] ?>">Modify</a></td>
                </tr>
            <?php
            endforeach; ?>
        </table>

        </article>
    </main>
</body>
</html>


