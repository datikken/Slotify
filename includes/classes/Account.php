<?php
    class Account {
        private $errorArray;

        public function __construct() {
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
                return true;
            } else {
                return false;
            }
        }

        
        private function validateUsername($un) {
            if(strlen($un) > 25 || strlen($un) < 5) {
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;
            }

            //TODO check if username exists
            
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
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
            //TODO check that username hasn't already been used
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