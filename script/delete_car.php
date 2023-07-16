<?php
// Assurez-vous d'avoir établi la connexion à votre base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer l'ID de la voiture depuis les paramètres de requête
        $carId = $_POST["carId"];

        // Supprimer la voiture de la base de données
        $query = "DELETE FROM cars WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$carId]);

        // Rediriger vers la page de gestion des voitures après la suppression réussie
        header("Location: manage_cars.php");
        exit;
    } else {
        // Rediriger vers la page de gestion des voitures si la requête n'est pas une requête POST
        header("Location: manage_cars.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
