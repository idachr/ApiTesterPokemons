<?php

class LoginContr extends Login {
    private $name;
    private $password;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    public function loginUser() {
        if ($this->emptyInput() == false){
            header("Location: ../index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->name, $this->password);
    }

    //Error handling
    private function emptyInput() {
        $result = false;
        if (empty($this->name) || empty($this->password)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
}