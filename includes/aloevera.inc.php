<?php
require_once "../controllers/aloevera.controllers.php";

$aloeveraController = new AloeveraController();

if (isset($_GET['aloeveraCount'])) {
    $aloeveraCount = $_GET['aloeveraCount'];

    $flavors = $aloeveraController->getAloeveraWater($aloeveraCount);

    if (empty($flavors)) {
        echo json_encode(["error" => "No flavors found."]);
    } else {
        echo json_encode(["flavors" => $flavors]);
    }    
} else {
    echo "Invalid request.";
}
?>


