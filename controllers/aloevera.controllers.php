<?php

require_once "../models/aloevera.models.php"; // Adjust the path as needed

class AloeveraController extends AloeveraModel {

    public function getAloeveraWater($aloeveraCount) {
        $validationResult = $this->validateInput($aloeveraCount);
        if ($validationResult !== true) {
            // Return an error response as JSON
            echo json_encode(["error" => $validationResult]);
            exit();
        }

        return $this->getAloevera($aloeveraCount);
    }

    private function validateInput($aloeveraCount) {
        if (!is_numeric($aloeveraCount) || $aloeveraCount < 1 || $aloeveraCount > 10 || $aloeveraCount == 0) {
            return "Input must be a number between 1 and 10.";
        }
        
        if (empty($aloeveraCount)) {
            return "Input cannot be empty.";
        }
        
        return true;
    }
}
