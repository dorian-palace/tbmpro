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

    // $sql = "INSERT INTO articles (`text`)";
    



}

}


