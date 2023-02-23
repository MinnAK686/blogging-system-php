<?php

class PagesController {
    public static function home() {
        // $todos = App::get("db")->selectAll("todos");
        // dd($todos);
        view("home", [
            // "todos" => $todos
        ]);
    }

    public static function blogDetail() {
        
        view("blog.detail");
    }

    public static function about() {
        view("about");
    }
}
