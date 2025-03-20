<?php
$host = "localhost:3307"; // Change if needed (e.g., localhost:3307)
$user = "root"; 
$pass = ""; 
$db = "admin_login";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
} ?>