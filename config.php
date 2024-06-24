<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aplikacja_wyborcza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

session_start();
?>
