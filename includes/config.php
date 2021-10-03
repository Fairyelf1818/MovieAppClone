<?php
ob_start(); // Turns on output buffering
session_start(); // STARTS THE SESSION

date_default_timezone_set("America/Jamaica"); // SETS THE DEFAULT TIMEZONE

try {
    $con = new PDO("mysql:dbname=Watchflix;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>