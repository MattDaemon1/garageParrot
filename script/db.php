<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "garage";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérification de la connexion
if ($conn->connect_error) {
  die("Échec de la connexion: " . $conn->connect_error);
}
?>
