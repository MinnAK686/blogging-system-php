<?php

function dd($data) {
    echo "<pre>";
    die(var_dump($data));
}

function view($uri, $data = []) {
    extract($data);
    return include "views/$uri.view.php";
}

function adminView($uri, $data = []) {
    extract($data);
    return include "views/admin/$uri.view.php";
}

function redirect($uri, $data = []) {
    extract($data);
    return header("Location: $uri");
}

function request($name) {
    if($_SERVER["REQUEST_METHOD"] === "GET") {
        return $_GET[$name];
    } elseif($_SERVER["REQUEST_METHOD"] === "POST") {
        return $_POST[$name];
    }
}

function validateEmail($email) {
    // Regex pattern for email validation
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    
    // Check if the email matches the pattern
    if (preg_match($pattern, $email)) {
        return true; // Valid email
    } else {
        return false; // Invalid email
    }
}

function checkMiemType(string $file) : bool {
    $allowedMiemType = [
        "image/png", "image/jpg", "image/jpeg", "image/gif", "application/pdf"
    ];
    if(in_array(mime_content_type($file),$allowedMiemType)) {
        return true;
    }
    return false;
}
