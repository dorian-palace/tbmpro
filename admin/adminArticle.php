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
    <script type="text/javascript" src="../layouts/scriptNav.js"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favIcon.ico">
    <!-- CSS only -->
    <script src="../js/adminRobots.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>AdminArticle</title>
</head>
<body>
<header>
        <nav class="topnav robot-nav" id="myTopnav">
            <ul class="link-to myLinks">
                <a href=" ../admin.php" class="active">Accueil admin</a>
                <!-- <a href="#main-robot" class="link">Robot</a> -->
                <!-- <a href="#form-new-cat" class="link">Categories</a> -->
                <!-- <a href="#form-new-materials" class="link">Matières</a> -->
                <!-- <a href="#form-new-color" class="link">Couleurs</a> -->
               <a href="../setting/deconnexion.php" class="link">Deconnexion</a>
               <a 
                class="icon" >
                <i class="fa fa-bars"></i>
                </a>
            </ul>
        </nav>
    </header>
    <main class = "main-admin-article">
        <article >
            <table class="form_box table">
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
                    <td class="text-scroll"><div class="scroll"><?= $article['text']; ?></div></td>
                    <td ><a href="adminArticle.php?id=<?= $article['id'] ?>">Modify</a></td>
                    
                    
                </tr>
                    <?php
                    endforeach; ?>
            </table>

        </article>

        <article>
                <div class="modal modal-admin">
                    <form class="form_box" action="" method="post" enctype="multipart/form-data"> 
                        <div class= "user-box">
                            <label class= "text-article" for="text">Titre de l'image:</label><br>
                            <input type= "text"  name= "title-pic" placeholder= "titre" autocomplete= "off"><br>
                            <label class= "text-article" for="add-pic">Ajout d'une image:</label><br>
                            <input type= "file" name= "add-pic" >
                           
                        </div>
                        <div class="user-box">
                            <label class= "text-article" for="text">Titre de l'article:</label><br>
                            <input type= "text" name= "title-article" placeholder= "titre" autocomplete= "off"><br>
                            <label class= "text-article" for="text">Texte:</label><br>

                            <textarea type= "text" name= "text" placeholder= "article" autocomplete= "off"> </textarea><br>
                            <button type="submit" name= "submit-text" class="btn ">Créer</button>
                        </div>
                        <div class="user-box">
                            <label class= "text-article" for="nbr">Delete an article by his ID:</label><br>
                            <input type= "number" name= "nbr" placeholder= "put an ID" autocomplete= "off"><br>
                            <button type="submit" name= "submit-delete" class="btn btn-input btn-primary btn-action" value = >Delete</button>
                        </div>
                        <?php 

                        if(isset($_GET['id'])){

                            $idArticle = intval($_GET['id']);
                            $articleSolo = $artNew->getArticleById($idArticle);
                            $articleUpdate = $artNew->updateArticle($idArticle);
                           
                            

                            ?>
                                <div class="user-box update-article">
                                    <input type="text" name="update-img-name" value="<?= $articleSolo['name']; ?>">
                                    <label for="update-img-name">Nom de l'image:</label>
                                </div>
                                <div class="user-box">
                                    <label  for="update-pic">Ajouter une image</label><br>
                                    <input type= "file" name= "update-pic" >
                                </div>
                                <div class="user-box">
                                    <input type="text" name="article-title" value="<?= ($articleSolo['title']); ?>">
                                    <label class="user-box" for="article-title">Titre</label>
                                    </div>
                                <div class="user-box">
                                    <label class="user-box" for="article-text"></label>
                                    <textarea type= "text" name= "article-text" 
                                    autocomplete= "off"><?= ($articleSolo['text']); ?></textarea>
                                </div>
                                <button type="submit" class= "btn_submit" value="<?= intval($articleSolo['article_id']) ; ?>" name="submit-update-article">Mise à jour</button>
                            <?php }
                            ?>
                       
                    </form>
                </div>
        </article>
    </main>
    
</body>
</html>


