<?php
require_once('../setting/db.php');
class AdminArticle extends Database{

function __construct(){
    parent::__construct();
}

function getAllArticles(){

    $sql = "SELECT * FROM articles INNER JOIN images WHERE articles.id_image = images.id";

    $request = $this->pdo->prepare($sql);
    $request->execute();
    $articles = $request->fetchAll();

    return $articles;


}

function getArticleById(int $id){

    $sql = "SELECT * FROM articles INNER JOIN images WHERE articles.id_image = images.id";

    $request = $this->pdo->prepare($sql);
    $request->execute();
    $article = $request->fetch();

    // echo $article;
    return $article;

}

function createArticle(){


    if(isset($_POST['submit-text'])){

        if(isset($_FILES['file'])){
    
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $error = $_FILES['file']['error'];
    
    
            $picExtension = explode('.', $name);
            $extension = strtolower(end($picExtension));
            $extensionsAllowed = ['jpg','png','jpeg','gif'];
        
            //Taille max en bytes acceptée, correspond à 4 mo  
            $maxSize = 4194304;
            
            if(in_array($extension, $extensionsAllowed)<= $maxSize && $error == 0){
                
            
                if (isset($_POST['title-pic'])){
                    $namePic = $_POST['title-pic'];
        
                    $sql = "SELECT * FROM images WHERE name = ?";
                    $request = $this->pdo->prepare($sql);
                    $request->execute([$namePic]);
        
                    $titlePic = $request->fetch();
                    var_dump($titlePic);
        
                    if(isset($titlePic)){
                        echo ("the name already exist");
                    }else{
                        move_uploaded_file($tmpName, './assets/'.$name);
                    }
    
    
                }else{
                    echo ("the name field is empty");
                }
                //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.

            }else{
                echo ("<p class = error>file should less than 4mo</p>");
            }
        }
    }else{
        echo ("<p class = error>a problem has occured</p>");
    
    }
    


echo "<pre>";
var_dump($_FILES);
var_dump($_POST);
echo "</pre>";



}

}


