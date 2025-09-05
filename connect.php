<?php
$servername = "127.0.0.1"; // or "localhost"
$username   = "root";
$password   = "";          // leave empty if no password
$dbname     = "job_demo";
$port       = 3300;        // <-- IMPORTANT: your MySQL port

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
