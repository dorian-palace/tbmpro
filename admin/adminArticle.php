<?php
require_once('../app/AdminArticle.php');
require_once('../app/AdminUser.php');

//meta no follow pr panel admin 

$artNew = new AdminArticle();
$articles = $artNew->getAllArticles();
$articlePic = $artNew->createArticle();
$articleDelete = $artNew->deleteArticle();

var_dump($_GET);

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
                    <th>image id</th>
                    <th>image name</th>
                    <th>article id</th>
                    <th>article title</th>
                    <th>text</th>
                </tr>

                    <?php 
                   
                    foreach ($articles as $article) :
              //btn delete avc value 

                    ?>
                <tr>
                    <td><?= $article['id_image']; ?></td>
                    <td><?= $article['name']; ?></td>
                    <td><?= $article['id']; ?></td>
                    <td><?= $article['title']; ?></td>
                    <td><?= $article['text']; ?></td>
                    <td><a href="adminArticle.php?id=<?= $article['id'] ?>">Modify</a></td>
                    
                    
                </tr>
                    <?php
                    endforeach; ?>
            </table>

        </article>

        <article>
                    <form action="" method="post" enctype="multipart/form-data"> 
                        <div class= "form-group">
                            <label class= "text-article" for="text">Pic title:</label><br>
                            <input type= "text"  name= "title-pic" placeholder= "give the pic a name" autocomplete= "off"><br>
                            <label class= "text-article" for="add-pic">Add a pic:</label><br>
                            <input type= "file" name= "add-pic" >
                           
                        </div>
                        <div class= "form-group">
                            <label class= "text-article" for="text">Article title:</label><br>
                            <input type= "text" name= "title-article" placeholder= "give the pic a name" autocomplete= "off"><br>
                            <label class= "text-article" for="text">Text:</label><br>

                            <input type= "text" name= "text" placeholder= "write your article" autocomplete= "off"><br>
                            <button type="submit" name= "submit-text" class="btn ">create an article</button>
                        </div>
                        <div class= "form-group">
                            <label class= "text-article" for="nbr">Delete an article by his ID:</label><br>
                            <input type= "number" name= "nbr" placeholder= "put an ID" autocomplete= "off"><br>
                            <button type="submit" name= "submit-delete" class="btn " value = >Delete</button>
                        </div>
                        <?php 

                        if(isset($_GET['id'])){

                            $idArticle = intval($_GET['id']);
                            $articleSolo = $artNew->getArticleById($idArticle);
                            echo 'kjejhsjkkqjsndkjqs';
                            echo '<pre>';
                            var_dump($articleSolo);
                            echo '</pre>';
                            

                            ?>
                                <label class= "text-article" for="id-img">Image Id</label>
                                <input type="text" name="id-img" value="<?= intval($articleSolo['id_image']); ?>">
                                <label class= "text-article" for="id-img">Image name</label>
                                <input type="text" name="id-img" value="<?= $articleSolo['name']; ?>">
                                <button type="submit" value="<?= intval($articleSolo['article_id']) ; ?>" name="submit-update-article">Update Article</button>
                            <?php }
                            ?>
                       
                    </form>
        </article>
    </main>
</body>
</html>


