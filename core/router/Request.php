<?php

class Request {
    public static function URI() {
        $currentUrl = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH); // localhost:8000/admin 
        $trimmedUrl = parse_url(trim($_SERVER["REQUEST_URI"],"/"),PHP_URL_PATH);
        if($currentUrl !== $trimmedUrl) {
            return $trimmedUrl;
        }
        // return parse_url(trim($_SERVER["REQUEST_URI"],"/"),PHP_URL_PATH);
    }
    public static function METHOD() {
        return $_SERVER["REQUEST_METHOD"];
    }
}
