<?php
require_once('../app/AdminArticle.php');
require_once('../app/AdminUser.php');

//meta no follow pr panel admin 

$artNew = new AdminArticle();
$articles = $artNew->getAllArticles();
$articlePic = $artNew->createArticle();
$articleDelete = $artNew->deleteArticle();



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

                            <textarea type= "text" name= "text" placeholder= "write your article" autocomplete= "off"> </textarea><br>
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
                            $articleUpdate = $artNew->updateArticle($idArticle);
                            // echo 'kjejhsjkkqjsndkjqs';
                            echo '<pre>';
                            // var_dump($articleSolo);
                            echo '</pre>';
                            

                            ?>
                              
                                <label class= "text-article" for="update-img-name">Image name</label>
                                <input type="text" name="update-img-name" value="<?= $articleSolo['name']; ?>">
                                <label class= "text-article" for="update-pic">Add a pic:</label><br>
                                <input type= "file" name= "update-pic" >

                                <label class= "text-article" for="article-title">Article title</label>
                                <input type="text" name="article-title" value="<?= ($articleSolo['title']); ?>">

                                <label class= "text-article" for="article-text"> Article content</label>
                                <textarea type= "text" name= "article-text" 
                                autocomplete= "off"><?= ($articleSolo['text']); ?></textarea>

                                <button type="submit" value="<?= intval($articleSolo['article_id']) ; ?>" name="submit-update-article">Update Article</button>
                            <?php }
                            ?>
                       
                    </form>
        </article>
    </main>
</body>
</html>


