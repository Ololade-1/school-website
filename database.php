<?php

$hostname="Localhost";
$username="root";
$password="";
$dbname="arizona_ict_college";
$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>