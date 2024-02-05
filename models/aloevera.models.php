<?php

require_once "../classes/dbh.classes.php";

class AloeveraModel extends Dbh
{

    protected function getAloevera($aloeveraCount)
    {
        $stmt = parent::connect()->prepare("SELECT flavor FROM aloevera_water ORDER BY RAND() LIMIT :aloeveraCount;");
        $stmt->bindParam(':aloeveraCount', $aloeveraCount, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            // Handle the error as needed
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=aloeveranotfound");
            exit();
        }

        $aloevera = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $stmt = null;
    
        return $aloevera;
    }
}