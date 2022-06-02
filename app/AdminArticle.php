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

    // $sql = "INSERT INTO `articles`(`id_image`, `text`) VALUES (:id_image, :text)";
    
    // $request = $this->pdo->prepare($sql);
    // $request->execute(array(
    //     ':id_image' => $id_image,
    //     ':text' => $text
    // ));

    if(isset($_FILES['file'])){
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
    }
    
    
    $picExtension = explode('.', $name);
    $extension = strtolower(end($picExtension));
    $extensionsAllowed = ['jpg','png','jpeg','gif'];
    
    if(in_array($extension, $extensionsAllowed)){
        
        //2 paramètres : le chemin du fichier que l’on veut uploader et le chemin vers lequel on souhaite l’uploader.
        move_uploaded_file($tmpName, './assets/'.$name);
    }else{
        echo ("<p class = error>a problem has occured</p>");
    }


echo "<pre>";
var_dump($_FILES);
var_dump($_POST);
echo "</pre>";



}

}


