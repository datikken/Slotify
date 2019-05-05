<?php
    class Account {
        private $errorArray;
        private $con;

        public function login($un, $pw) {
            $pw = md5($pw);
            $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pw'");
            if(mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }
        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }
        public function register($un, $fn, $ln, $em, $pw) {

            $this->validateUsername($un);
            $this->validateFirstname($fn);
            $this->validateLastname($ln);
            $this->validateEmail($em);
            $this->validatePassword($pw);

            if(empty($this->errorArray)) {
                //Insert into db
                return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            } else {
                return false;
            }
        }

        private function insertUserDetails($un, $fn, $ln, $em, $pw) {
            $encryptedPw = md5($pw);
            $profilePic = "assets/images/profile-pics/avatar.jpeg";
            $date = date("Y-m-d");
            $result = mysqli_query($this->con, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
            
            return $result;

        }
        private function validateUsername($un) {
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;
            }

            //TODO check if username exists
            $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery) != 0) {
                array_push($this->errorArray, Constants::$userNameTaken);
                return;
            }
            
        }
        private function validateFirstname($fn) {
            if(strlen($fn) > 25 || strlen($fn) < 2) {
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;
            }
        }
        private function validateLastname($ln) {
            if(strlen($ln) > 25 || strlen($ln) < 2) {
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }
        }
        private function validateEmail($em) {
            //TODO check that username hasn't already been used
            $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");

            if(mysqli_num_rows($checkEmailQuery) != 0) {
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }
        private function validatePassword($pw) {
            if(preg_match('/[^A-Za-z0-9]/', $pw)) {
                array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
                return;
            }
            if(strlen($pw) > 30 || strlen($pw) < 5) {
                array_push($this->errorArray, Constants::$passwordCharachters);
                return;
            }
        }
        
    }
?>