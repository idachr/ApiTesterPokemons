<?php

class TrainerProfileController extends TrainerProfileModel {

    private $trainerId;
    private $name;

    public function __construct($trainerId, $name)
    {
        $this->trainerId = $trainerId;
        $this->name = $name;
    }

    public function defaultProfileInfo () {
        $trainerFunFact = "This is a funfact about me!";
        $trainerDescription = "Hi, I'm " . ucfirst($this->name) . "!";
        $profilePicUrl = "https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png";

        $this->setTrainerInfo($trainerFunFact, $trainerDescription, $profilePicUrl, $this->trainerId);
    }

    public function updateTrainerInfo($trainerProfilePic, $trainerFunFact, $trainerDescription) {
        if ($this->emtpyInputCheck($trainerProfilePic, $trainerFunFact, $trainerDescription) == true) {
            header("Location: ../views/private/trainerprofilesettings.views.php?error=stmtfailed");
            exit();
        }

        //add lenght check later

        $this->setNewTrainerInfo($trainerProfilePic, $trainerFunFact, $trainerDescription, $this->trainerId);
    }

    private function emtpyInputCheck($trainerProfilePic, $trainerFunFact, $trainerDescription) {
        $results = true;

        if (empty($trainerProfilePic) || empty($trainerFunFact) || empty($trainerDescription)) {
            $results = true;
        }
        else {
            $results = false;
        }

        return $results;
    }
    
}