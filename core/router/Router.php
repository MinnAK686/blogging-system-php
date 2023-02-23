<?php

class Router {

    protected static $routes = [
        "GET" => [],
        "POST" => []
    ];
    public static function load($routes) {
        $router = new Router;
        require "$routes.php";
        return $router;
    }
    public static function get($uri,$controller) {
        self::$routes["GET"][$uri] = $controller;
    }
    public static function post($uri,$controller) {
        self::$routes["POST"][$uri] = $controller;
    }
    public function direct($uri,$method) {
        if(array_key_exists($uri,self::$routes[$method])) {
            $controller = self::$routes[$method][$uri];
            $this->callAction($controller[0],$controller[1]);
        }else{
            require "views/404.php";
        }
    }
    public function callAction($class, $method) {
        return $class::$method();
    }
}

// Router::load("Routes.php")->direct("","GET"); return PagesController::home();
// Router::get("uri",[Controller::class,"method"]);
