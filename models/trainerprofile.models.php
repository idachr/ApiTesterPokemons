<?php

class TrainerProfileModel extends Dbh {
    protected function getTrainerInfo($trainerId) {
        $stmt = parent::connect()->prepare('SELECT * FROM trainer_profiles WHERE trainer_id = ?;');
    
        if (!$stmt->execute(array($trainerId))) {
            $stmt = null;
            header("Location: ../views/private/trainerprofile.views.php?error=stmtfailed");
            exit();
        }
    
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../views/private/trainerprofile.views.php?error=profilenotfound");
            exit();
        }
    
        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $profileData;
    }

    protected function setNewTrainerInfo($trainerProfilePic, $trainerFunFact, $trainerDescription, $trainer_id) {
        $stmt = parent::connect()->prepare('UPDATE trainer_profiles SET profile_pic = ?, fun_fact = ?, description = ? WHERE trainer_id = ?;');

        if (!$stmt->execute(array($trainerProfilePic, $trainerFunFact, $trainerDescription, $trainer_id))) {
            $stmt = null;
            header("Location: ../views/private/trainerprofile.views.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function setTrainerInfo($trainerFunFact, $trainerDescription, $profilePicUrl, $trainer_id) {
        $stmt = parent::connect()->prepare('INSERT INTO trainer_profiles (trainer_id, fun_fact, description, profile_pic) VALUES (?,?,?,?);');

        if (!$stmt->execute(array($trainer_id, $trainerFunFact, $trainerDescription, $profilePicUrl))) {
            $stmt = null;
            header("Location: ../views/private/trainerprofile.views.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}