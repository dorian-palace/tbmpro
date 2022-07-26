<?php
require_once('C:\wamp64\www\tbmpro\setting\db.php');
require_once('C:\wamp64\www\tbmpro\setting\data.php');
require_once('C:\wamp64\www\tbmpro\app\User.php');
require_once('C:\wamp64\www\tbmpro\app\Robots.php');

$robot = new Robots();

$getColor = $robot->getColor();
$getMaterial = $robot->getMaterials();
Robots::LoadHEADS();
Robots::LoadBODIES();
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="assets/img/favIcon.ico">
    <script type="text/javascript" src="layouts/scriptNav.js"></script>
    <link href="layouts/styleNav.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/creation.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module robot MOURAD</title>
</head>

<body>
    <header>
        <?php require_once("layouts/navbar.php") ?>
    </header>
    













</body>