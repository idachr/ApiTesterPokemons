<?php

class UserManagerModel extends Dbh {
    public function getTermsAcceptedStatus($trainerId) {
        $stmt = parent::connect()->prepare("SELECT terms_accepted FROM trainers WHERE id = ?;");

        if (!$stmt->execute(array($trainerId))) {
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=trainernotfound");
            exit();
        }

        $termsAccepted = $stmt->fetch(PDO::FETCH_ASSOC)['terms_accepted'];
        $stmt = null;

        return $termsAccepted;
    }

    protected function setTerms($trainerId) {
        $stmt = parent::connect()->prepare("UPDATE trainers SET terms_accepted = true WHERE id = ?;");

        if (!$stmt->execute(array($trainerId))) {
            $stmt = null;
            header("Location: ../views/private/terms.views.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
}