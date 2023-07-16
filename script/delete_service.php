<?php
// Vérifier si l'ID du service à supprimer est passé en paramètre
if (isset($_GET["id"])) {
    $serviceId = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "garage";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer le service de la base de données en utilisant l'ID
        $query = "DELETE FROM services WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$serviceId]);

        // Rediriger vers la page de gestion des services après la suppression réussie
        header("Location: manage_services.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
} else {
    // Si l'ID du service n'est pas fourni, rediriger vers la page de gestion des services
    header("Location: manage_services.php");
    exit;
}
