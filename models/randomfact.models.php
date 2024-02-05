<?php

class RandomFactModel extends Dbh {

    protected function getRandomFact() {
        $stmt = parent::connect()->prepare("SELECT fact FROM random_fact ORDER BY RAND() LIMIT 1;");

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../views/private/home.views.php?error=factnotfound");
            exit();
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
        return $result['fact'];
    }
}