<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "viajes_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Error de conexión a la base de datos. Por favor, intente más tarde. DEBUG: " . $conn->connect_error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>