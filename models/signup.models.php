<?php
//Database related stuff

class Signup extends Dbh {

    protected function setUser($name, $password)
    {
        $stmt = parent::connect()->prepare("INSERT INTO trainers (name, password, level) VALUES (?,?, 1);");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $hashedPassword))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $userId = $this->getUserId($name);

        session_start();
        $_SESSION["id"] = $userId;
        $_SESSION["name"] = $name;

        $stmt = null;
    }

    protected function checkUser($name) {
        $stmt = parent::connect()->prepare("SELECT name FROM trainers WHERE LOWER(name) = LOWER(?);");

        if (!$stmt->execute(array(strtolower($name)))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function getUserId($name) {
        $stmt = $this->connect()->prepare('SELECT id FROM trainers WHERE name = ?;');
    
        if (!$stmt->execute(array($name))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
    
        // Check if the user was found
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
    
        // Fetch the user ID
        $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = null;
    
        return $profileData['id'];
    }
}