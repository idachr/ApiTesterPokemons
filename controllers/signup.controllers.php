<?php

class SignupContr extends Signup {
    private $name;
    private $password;
    private $passwordRepeat;

    public function __construct($name, $password, $passwordRepeat)
    {
        $this->name = $name;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function signupUser() {
        if ($this->emptyInput() == false){
            header("Location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidName() == false){
            header("Location: ../index.php?error=invalidname");
            exit();
        }
        if ($this->passwordMatch() == false){
            header("Location: ../index.php?error=passwordmatch");
            exit();
        }
        if ($this->checkIfNameTaken() == false){
            header("Location: ../index.php?error=checkiftaken");
            exit();
        }

        $this->setUser($this->name, $this->password);
    }

    //Error handling
    private function emptyInput() {
        $result = false;
        if (empty($this->name) || empty($this->password) || empty($this->passwordRepeat)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function invalidName () {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*/", $this->name)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch () {
        $result = false;
        if ($this->password !== $this->passwordRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function checkIfNameTaken() {
        $result = false;
        if (!$this->checkUser($this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    
    public function fetchUserId($name) {
        $userId = $this->getUserId($name);
        return $userId;
    }    
}