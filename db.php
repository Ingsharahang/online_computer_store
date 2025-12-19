<?php
// db.php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "computer_store";
$port = 3306; 

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
