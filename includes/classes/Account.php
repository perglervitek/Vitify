<?php

    class Account{

        private $errorArray;

        public function __construct($con){
            $this->con = $con;
            $this-> errorArray = array();
        }
        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
            $this->validaceUsername($un);
            $this->validaceFirstName($fn);
            $this->validaceLastName($ln);
            $this->validaceEmailu($em, $em2);
            $this->validaceHesel($pw, $pw2);

            if(empty($this->errorArray) == true){
                //Insert into db
                return $this->vlozeniUserDetail($un, $fn, $ln, $em, $pw);
            }else{
                return false;
            }
        }

        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }
        private function vlozeniUserDetail($un, $fn, $ln,$em, $ps){
            $encryptedPw = md5($ps);
            $profilePic = "assets/images/profile-pics/head_emerald.png";
            $date = date("Y-m-d");

            $query = "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')";
            $result = mysqli_query($this->con, $query);

            return $result;
        }
        private function validaceUsername($un){
            if(strlen($un) > 30 || strlen($un) < 5){
                array_push($this->errorArray, Constants::$usernameLength);
                return;
            }
            $checkUsQuery = mysqli_query($this->con,  "SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsQuery) != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
            
        }
        private function validaceFirstName($fn){
            if(strlen($fn) > 30 || strlen($fn) < 2){
                array_push($this->errorArray, Constants::$firstLength);
                return;
            }
        }
        private function validaceLastName($ln){
            if(strlen($ln) > 30 || strlen($ln) < 2){
                array_push($this->errorArray, Constants::$lastLength);
                return;
            }
        }
        private function validaceEmailu($em, $em2){
            if($em != $em2){
                array_push($this->errorArray, Constants::$emailsNotMatch);
                return;
            }
            if(filter_var($em, FITLER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$eamilInvalid);
                return;
            }
            $checkUsQuery = mysqli_query($this->con,  "SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkUsQuery) != 0){
                array_push($this->errorArray, Constants:: $emailUsed);
                return;
            }
        }
        private function validaceHesel($ps, $ps2){
            if($ps != $ps2){
                array_push($this->errorArray, Constants::$passwordsNotMatch);
                return;
            }
            if(preg_match('/[^A-Za-z0-9]/',$ps)){
                array_push($this->errorArray, Constants::$passwordOnlyLetters);
                return;
            }
            if(strlen($ps) > 30 || strlen($ps) < 5){
                array_push($this->errorArray, Constants::$passwordLength);
                return;
            }
        }
}