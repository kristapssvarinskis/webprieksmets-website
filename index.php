<?php
// using composer Class autoloader
include "vendor/autoload.php";
include "src/database.php";

use app\database;

$database = new Database();

echo $database ->host;
?>
