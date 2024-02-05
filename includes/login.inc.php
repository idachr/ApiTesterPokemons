<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //grabbing the data
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    //Instantiate LoginController class
    include "../classes/dbh.classes.php";
    include "../models/login.models.php";
    include "../controllers/login.controllers.php";

    $login = new LoginContr($name, $password);

    //Running error handlers and user login

    $login->loginUser();

    //Go to home page (logged in)
    header("Location: ../views/private/home.views.php");

}