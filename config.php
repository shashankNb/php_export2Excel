<?php

define('HOST', 'localhost');
define('USERNAME', 'root');
define("PASSWORD", "");
define('DB', 'angular-jwt');

try {
    $dbcon = new PDO("mysql:host=" . HOST . ";dbname=" . DB . ";", USERNAME, PASSWORD);
    $dbcon->query("SET NAMES 'utf8'");
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If database connection occurs log and error
    error_log($e->getMessage());
    die("Cannot make connetion to database");
}
