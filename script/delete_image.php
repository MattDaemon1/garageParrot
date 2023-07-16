<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'ID de l'image et de la voiture sont passés en paramètres
    if (isset($_GET['id']) && isset($_GET['carId'])) {
        $imageId = $_GET['id'];
        $carId = $_GET['carId'];

        // Supprimer l'image de la table car_images
        $deleteQuery = "DELETE FROM car_images WHERE id = :imageId";
        $deleteStmt = $pdo->prepare($deleteQuery);
        $deleteStmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
        $deleteStmt->execute();

        // Rediriger vers la page d'édition du véhicule
        header("Location: edit_car.php?id=$carId");
        exit();
    } else {
        // Rediriger vers la page de gestion des véhicules si les paramètres ne sont pas spécifiés
        header("Location: manage_cars.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
