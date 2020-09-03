<?php

class Account{

    /**
     * @var PDO
     */
    private $con;
    private $errorArray = array();

    public function __construct($con){
        $this->con = $con;
    }

    public function register($un, $pd, $pd2, $em, $name, $lastName){
        $this->validateFirstName($name);
        $this->validateLastName($lastName);
        $this->validateUsername($un);
        $this->validateEmails($em);
        $this->validatePasswords($pd, $pd2);

        if(empty($this->errorArray)){
            return $this->insertUserDetails($un, $pd, $em, $name, $lastName);
        }

        return false;
    }

    public function login($un, $pw){
        $pw = md5($pw);

        $query = $this->con->prepare("SELECT * FROM users WHERE Login=:un AND Password=:pw AND UserType=1 ");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 1){
            return true;
        }

        array_push($this->errorArray, Constants::$incorrectCredits);
        return false;
    }

    public function loginAdmin($un, $pw){


        $query = $this->con->prepare("SELECT * FROM users WHERE Login=:un AND Password=:pw AND UserType=2 ");
        $query->bindValue(":un", $un);
        $query->bindValue(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 1){
            return true;
        }

        array_push($this->errorArray, Constants::$incorrectCredits);
        return false;
    }

    private function insertUserDetails($un, $pd, $em, $name, $lastName){

        $pd = md5($pd);

        $query = $this->con->prepare("INSERT INTO users (Login, Password, FirstName, LastName, Email)
                                        VALUES (:un, :pd, :name, :lastName, :em)");
        $query->bindValue(":un", $un);
        $query->bindValue(":pd", $pd);
        $query->bindValue(":name", $name);
        $query->bindValue(":lastName", $lastName);
        $query->bindValue(":em", $em);

        return $query->execute();
    }

    private function validateFirstName($fn){
        if(strlen($fn) < 2 || strlen($fn) > 50){
            array_push($this->errorArray, Constants::$firstNameCharacters);
        }
    }

    private function validateLastName($ln){
        if(strlen($ln) < 2 || strlen($ln) > 50){
            array_push($this->errorArray, Constants::$lastNameCharacters);
        }
    }

    private function validateUsername($un){
        if(strlen($un) < 2 || strlen($un) > 26){
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE Login=:un");
        $query->bindValue(":un", $un);

        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray, Constants::$checkUsernameQuery);
        }
    }

    private function validateEmails($em){

        if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray, Constants::$emailInvalid);
            return;
        }

        $query = $this->con->prepare("SELECT * FROM users WHERE Email=:em");
        $query->bindValue(":em", $em);

        $query->execute();

        if($query->rowCount() != 0){
            array_push($this->errorArray, Constants::$checkEmailQuery);
        }
    }

    private function validatePasswords($pw, $pw2){
        if($pw != $pw2){
            array_push($this->errorArray, Constants::$passwordsDoNoMatch);
            return;
        }

        if(strlen($pw) < 5 || strlen($pw) > 32){
            array_push($this->errorArray, Constants::$passwordCharacters);
        }
        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
        }
    }

    public function getError($error){
        if(in_array($error, $this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }

}

?>