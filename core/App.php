<?php

class App {
    protected static $data = [];

    public static function bind(string $key,$data) {
        self::$data[$key] = $data;
    }

    public static function get(string $key) {
        return self::$data[$key];
    }

}

// App::bind("key", "data");
// App::get("key");
