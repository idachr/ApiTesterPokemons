<?php
//Database related stuff

class Login extends Dbh {

    protected function getUser($name, $password) {
        $stmt = parent::connect()->prepare("SELECT password FROM trainers WHERE name = ?;");

        if (!$stmt->execute(array($name))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../index.php?error=trainernotfound1");
            exit();
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]["password"]);

        if ($checkPassword == false) {
            $stmt = null;
            header("Location: ../index.php?error=wrongpassword");
            exit();
        }
        elseif ($checkPassword == true) {
            $stmt = parent::connect()->prepare("SELECT * FROM trainers WHERE name = ?;");

            if (!$stmt->execute(array($name))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("Location: ../index.php?error=trainernotfound2");
                exit();
            }
            $trainer = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["id"] = $trainer[0]["id"];
            $_SESSION["name"] = $trainer[0]["name"];

            $stmt = null;
        }
        
        $stmt = null;
    }
}