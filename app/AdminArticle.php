<?php
require_once('../setting/db.php');
require_once('../setting/data.php');
class AdminArticle extends Database{

    function __construct(){
        parent::__construct();
    }

    function getAllArticles(){

        $sql = "SELECT *, articles.id FROM articles INNER JOIN images WHERE articles.id_image = images.id";

        $request = $this->pdo->prepare($sql);
        $request->execute();
        $articles = $request->fetchAll();

        return $articles;


    }

    function getArticleById(int $id){

        $sql = "SELECT images.name,articles.text,articles.title,articles.id_image, articles.id AS `article_id` FROM articles INNER JOIN images ON articles.id_image = images.id WHERE articles.id = ?";
        // $sql = "SELECT CONCAT_WS(' ', id) AS `Article info` FROM articles INNER JOIN images WHERE articles.id_image = images.id ";

        $request = $this->pdo->prepare($sql);
        $request->execute([$id]);
        $article = $request->fetch();

        // print_r($article) ;
        return $article;

}

    function createArticle(){


        if(isset($_POST['submit-text'])){

            if(isset($_FILES['add-pic'])){
            
                
                $tmpName = $_FILES['add-pic']['tmp_name'];
                $name = $_FILES['add-pic']['name'];
                $size = $_FILES['add-pic']['size'];
                $type = $_FILES['add-pic']['type'];
                $error = $_FILES['add-pic']['error'];

                $namePic = secuData($_POST['title-pic']);
                $titleArticle = secuData($_POST['title-article']);
                $textArticle = secuData($_POST['text']);
                
                $picExtension = explode('.', @$name);
                $extension = strtolower(end($picExtension));
                $extensionsAllowed = ['jpg','png','jpeg','gif'];
                
                $way = "/Applications/MAMP/htdocs/tbmpro/assets/img/".$namePic.'.'.$extension;
                //Taille max en bytes acceptée, correspond à 4 mo  
                $maxSize = 400000;
                
                if(in_array($extension, $extensionsAllowed)&& $size <= $maxSize && $error == 0){
                    
                    if (isset($namePic) && isset($textArticle)){
                    
                        $namePicToRegister = $namePic.'.'.$extension;

                        $sql = "SELECT * FROM images WHERE name = ?";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        $requestImg = $request->fetchAll();
                        $titlePic = $request->rowCount();
                        // var_dump($titlePic);
                    

                        if($titlePic == 0){
                        
                            $sql = "INSERT INTO  `images`(`name`) VALUES (?)";
                            $request = $this->pdo->prepare($sql);
                            $request->execute([$namePicToRegister]);
                            
                            $sql = "SELECT images.id FROM `images` WHERE name = ? ORDER BY id DESC LIMIT 1";
                            $requestPic = $this->pdo->prepare($sql);
                            $requestPic->execute([$namePicToRegister]);
                            $idPic = $requestPic->fetch();

                            $idPicToRegister = intval($idPic['id']);
                        

                            //select pr recup l'id a inserer ds id_img de la table articles
                            $sqlTxt = "INSERT INTO  `articles`(`id_image`,`title`,`text`) VALUES (?,?,?)";
                            $requestText = $this->pdo->prepare($sqlTxt);
                            $requestText->execute([$idPicToRegister,$titleArticle,$textArticle]);
                            
                            //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.
                            move_uploaded_file($tmpName, $way);
                            
                            echo ("Picture successfully uploaded");

                            header("Location: adminArticle.php");
                        }else{
                            echo ("the name already exist");
                        }
                        
                        
                    }else{
                        echo ("<p class = error>file should less than 4mo</p>");
                    }
                
                    
                }else{
                    echo ("<p class = error>file should less than 4mo</p>");
                }
            }
                
        }

    }

    function deleteArticle(){
    
        if(isset($_POST['nbr']))
        $idToDelete = intval($_POST['nbr']);
    
        if(isset($idToDelete)){
            if(isset($_POST['submit-delete'])){
                $sql = "DELETE FROM articles WHERE `id` = ?";
            
                $request = $this->pdo->prepare($sql);
                $request->execute([$idToDelete]);

                header("Location: adminArticle.php");
                echo ("<p class = error>sucessfully deleted");
            
            }
        }
    
    }

    function updateArticle(int $id ){

        if(isset($_GET['id']));
        $idArticle = intval($_GET['id']);
         // inner join les deux requetes 
        $articleSolo = $this->getArticleById($idArticle);
        echo 'update';
        if(isset($_POST["submit-update-article"])){
            $sql = "SELECT * FROM images WHERE name = ?";
            $request = $this->pdo->prepare($sql);
            $request->execute([$newPicName]);
            $titlePic = $request->rowCount();
         
            if("" == trim($_POST['update-img-name'])){
                $newPicName = $articleSolo['name'];
            }elseif(isset($_POST['update-img-name'])){
                $newPicName = secuData($_POST['update-img-name']);
            }
            if("" == trim($_POST['article-title'])){
                $newTitleArticle  = $articleSolo['title'];
            }elseif(isset($_POST['article-title'])){
                $newTitleArticle = secuData($_POST['article-title']);
            }
            if("" == trim($_POST['article-text'])){
                $newText = $articleSolo['text'];
            }elseif(isset($_POST['article-text'])){
                $newText = secuData($_POST['article-text']);
            }

            echo 'updatevfr';
           
            $tmpName = $_FILES['update-pic']['tmp_name'];
            $name = $_FILES['update-pic']['name'];

            $picExtension = explode('.', $name);
            $extension = strtolower(end($picExtension));
            $extensionsAllowed = ['jpg','png','jpeg','gif'];

            $way = "/Applications/MAMP/htdocs/tbmpro/assets/img/".$newPicName.'.'.  $extension;
            $maxSize = 400000;

            //pour reparer mettre la condition si dessus dans une condition si file n'existe pas 
            if(in_array($extension, $extensionsAllowed)&& $size <= $maxSize && $error == 0){
                echo 'update  s  a';
                if($titlePic == 0){
                    echo 'update fooool';
                    $namePicToRegister = $newPicName.'.'.$extension;

                    // $folderPic = "/Applications/MAMP/htdocs/tbmpro/assets/img/";
                    // $scanned_directory = array_diff(scandir($folderPic), array('..', '.'));
                    // var_dump($scanned_directory);
                    // var_dump(file_exists('img.jpg'));

                    // if(file_exists($filename)) 
                    //faire une alerte si c'est possible d'utiliser la meme img sinon cas l'écrase si elle ne se nomme pas pareil 


                    move_uploaded_file($tmpName, $way);

                    $sql = "UPDATE articles INNER JOIN images ON images.id = articles.id_image SET articles.title = :newTitleArticle, articles.text = :newText, images.name = :newPicName WHERE articles.id = :id";

                    $update = $this->pdo->prepare($sql);
                    $update->execute([
                        ":newTitleArticle" => $newTitleArticle,
                        ":newText" => $newText,
                        ":newPicName" => $newPicName,
                        ":id" => $idArticle,
                    ]);

                    header("Refresh:0");
                }
                // elseif($titlePic != 0){

                
                //     $newPicName = $articleSolo['name'];
                //     $namePicToRegister = $newPicName;

                //     $sql = "UPDATE articles INNER JOIN images ON images.id = articles.id_image SET articles.title = :newTitleArticle, articles.text = :newText, images.name = :newPicName WHERE articles.id = :id";

                //     $update = $this->pdo->prepare($sql);
                //     $update->execute([
                //         ":newTitleArticle" => $newTitleArticle,
                //         ":newText" => $newText,
                //         ":newPicName" => $newPicName,
                //         ":id" => $idArticle,
                //     ]);

                //     header("Refresh:0");
                // }
            }
        }
       
        // $picExtension = explode('.', $newPicName);
        // $extension = strtolower(end(  $picExtension ));
        // $extensionsAllowed = ['jpg','png','jpeg','gif'];


        // echo($newPicName.'.'. $extension);


    }

}

