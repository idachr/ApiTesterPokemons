<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $trainerId = $_SESSION["id"];
    $name = $_SESSION["name"];
    $trainerProfilePic = htmlspecialchars($_POST["profilepic_url"], ENT_QUOTES, 'UTF-8');
    $trainerFunFact = htmlspecialchars($_POST["funfact"], ENT_QUOTES, 'UTF-8');
    $trainerDescription = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');

    include "../classes/dbh.classes.php";
    include "../models/trainerprofile.models.php";
    include "../controllers/trainerprofile.controllers.php";

    $trainerInfo = new TrainerProfileController($trainerId, $name);

    $trainerInfo->updateTrainerInfo($trainerProfilePic ,$trainerFunFact, $trainerDescription);

    header("Location: ../views/private/trainerprofile.views.php");

}