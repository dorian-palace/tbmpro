<?php
session_start();
class Database
{

    protected $pdo;

    function __construct()
    {

        $dns = 'mysql:host=localhost;dbname=tbm;charset=utf8';

        try {

            $pdo = new PDO(
                $dns,
                'root',
                'root',

                [

                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC

                ]
            );


        } catch (PDOException $e) {

            echo "error : " . $e->getMessage();
        }

        // var_dump($pdo);
        $this->pdo = $pdo;
    }
}
