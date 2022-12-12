<?php

namespace app;

class application {

    public $database;

    public function __construct() {
        $this->database = new Databse();
    }

    public function run() {
        return $this->database->host;
    }
}
?>