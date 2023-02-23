<?php

abstract class Connection {
    public $pdo;
    public function make() {
        try {
            return $this->pdo = new PDO("mysql:host=localhost;dbname=?","?","?");
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }
}
