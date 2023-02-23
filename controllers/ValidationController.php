<?php

class ValidationController {
    public static function validateAdminLogin($email,$password) {
        $error = null;
        // dd($email . " " . $password);
        if(empty($email)) {
            return $error = "Email Address can't be empty";
        }elseif(empty($password)) {
            return $error = "Password can't be empty";
        }
        if(!validateEmail($email)) {
            return $error = "Invalid email format";
        }
        
    }
}
