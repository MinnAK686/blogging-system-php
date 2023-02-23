<?php

ob_start();
header('Access-Control-Allow-Origin: *');


declare(strict_type = 1);
error_reporting(E_ALL);
ini_set('display_errors',1);


require "vendor/autoload.php";
require "core/boot.php";

Router::load("Routes")->direct(Request::URI(),Request::METHOD());

