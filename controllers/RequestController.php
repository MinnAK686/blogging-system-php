<?php

class RequestController {
    public static $error = null;
    public static function server() {
        header('Content-Type: application/json');
        $data = json_encode(App::get("db")->selectAll("todos"));
        echo $data;
    }
    public static function logoutAdmin() {
        session_start();
        session_destroy();
        redirect("/admin/login");
    }
}

class Validate {
    public function validateForm($email,$password) {
        $emailError = null;
        $passwordError = null;
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(empty($email)) {
                $emailError = "Email Address can't be empty";
            }
            if(empty($password)) {
                $passwordError = "Password can't be empty";
            }
            if(!empty($email) && !empty($password)) {
                if(!validateEmail($email)) {
                    $emailError = "Invalid email format";
                }
            }
        }
        return [$emailError, $passwordError];
    }
}
