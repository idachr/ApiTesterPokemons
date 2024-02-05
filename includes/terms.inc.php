<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $trainerId = $_SESSION["id"];
    $acceptedTerms = isset($_POST["terms_accepted"]) ? 1 : 0;

    include "../classes/dbh.classes.php";
    include "../models/usermanager.models.php";
    include "../controllers/usermanager.controllers.php";

    $acceptTerms = new UserManagerController($trainerId);
    $acceptTerms->trainerAcceptTerms($acceptedTerms);

    header("Location: ../views/private/trainerprofile.views.php");
}