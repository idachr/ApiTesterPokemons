<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //grabbing the data
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');
    $passwordRepeat = htmlspecialchars($_POST["passwordrepeat"], ENT_QUOTES, 'UTF-8');

    //Instantiate SignUpController class
    include "../classes/dbh.classes.php";
    include "../models/signup.models.php";
    include "../controllers/signup.controllers.php";

    $signup = new SignupContr($name, $password, $passwordRepeat);

    //Running error handlers and user signup
    $signup->signupUser();

    $trainerId = $signup->fetchUserId($name);

    //Instantiate the TrainerProfileController class
    include "../models/trainerprofile.models.php";
    include "../controllers/trainerprofile.controllers.php";

    $trainerProfileInfo = new TrainerProfileController($trainerId, $name);

    $trainerProfileInfo->defaultProfileInfo();


    //Go to home page (logged in)
    header("Location: ../views/private/home.views.php");

}