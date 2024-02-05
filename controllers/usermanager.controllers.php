<?php

class UserManagerController extends UserManagerModel {
    private $trainerId;

    public function __construct($trainerId)
    {
        $this->trainerId = $trainerId;
    }

    public function trainerAcceptTerms($acceptedTerms) {
        if ($this->checkCheckbox($acceptedTerms)){
            header("Location: ../views/private/terms.views.php?error=checkboxNotChecked");
            exit();
        }

        $this->setTerms($this->trainerId, $acceptedTerms);
    }

    private function checkCheckbox($acceptedTerms) {
        $result = false;
        if ($acceptedTerms == true) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
}