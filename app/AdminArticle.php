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

    $sql = "SELECT * FROM  articles INNER JOIN images WHERE articles.id_image = images.id";

    $request = $this->pdo->prepare($sql);
    $request->execute();
    $article = $request->fetch();

    // echo $article;
    return $article;

}

function createArticle(){


    if(isset($_POST['submit-text'])){

        echo 'ok';
        if(isset($_FILES['add-pic'])){
            echo 'ok';
            
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
            
            $way = "/Applications/MAMP/htdocs/tbmpro/assets".$name.'.'.$extension;
            //Taille max en bytes acceptée, correspond à 4 mo  
            $maxSize = 4194304;
            //table intermediaire
            
            if(in_array($extension, $extensionsAllowed)<= $maxSize && $error == 0){
                
                echo 'ok2';
                
                if (isset($namePic) && isset($textArticle)){
                    echo 'ok3';
                   
                    $namePicToRegister = $namePic.'.'.$extension;
                    
                    $sql = "SELECT * FROM images WHERE name = ?";
                    $request = $this->pdo->prepare($sql);
                    $request->execute([$namePic]);
                    $requestImg = $request->fetchAll();

                    // var_dump($requestImg);
                    
                    $titlePic = $request->rowCount();
                    // var_dump($titlePic);

                    //input hidden qui recupère l'id de l'article

                    if($titlePic == 0){
                        
                        echo 'ok4';

                        
                        $sql= "INSERT INTO  `images`(`name`) VALUES (?)";
                        $request = $this->pdo->prepare($sql);
                        $request->execute([$namePicToRegister]);
                        //select pr recup l'id a 
                        //table de liaisons obligatoire

                        $sqlTxt = "INSERT INTO  `articles`(`id_image`,`title`,`text`) VALUES (?,?,?)";
                        $requestText = $this->pdo->prepare($sqlTxt);
                        $requestText->execute([$titleArticle,$textArticle ]);
                        
                        move_uploaded_file($way, $namePicToRegister);
                        
                        echo ("Picture successfully uploaded");
                    }else{
                        echo ("the name already exist");
                    }
                    
                    
                }else{
                    echo ("<p class = error>file should less than 4mo</p>");
                }
                //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.
                
            }else{
                echo ("<p class = error>file should less than 4mo</p>");
            }
            // }
        }
            
        }else{
        echo ("<p class = error>a problem has occured</p>");
    
    }
    


echo "<pre>";
// var_dump($_FILES);
// var_dump($_POST);
echo "</pre>";



}

}


