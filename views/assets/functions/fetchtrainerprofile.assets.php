<?php

class TrainerProfileView extends TrainerProfileModel {

    public function fetchFunFact($trainerId){
        $trainerInfo = $this->getTrainerInfo($trainerId);
        if ($trainerInfo) {
            echo $trainerInfo[0]["fun_fact"];
        } else {
            echo "Profile not found";
        }
    }

    public function fetchDescription($trainerId){
        $trainerInfo = $this->getTrainerInfo($trainerId);
        if ($trainerInfo) {
            echo $trainerInfo[0]["description"];
        } else {
            echo "Profile not found";
        }
    }

    public function fetchProfilePic($trainerId){
        $trainerInfo = $this->getTrainerInfo($trainerId);
        if ($trainerInfo) {
            echo $trainerInfo[0]["profile_pic"];
        } else {
            echo "Profile not found";
        }
    }
}