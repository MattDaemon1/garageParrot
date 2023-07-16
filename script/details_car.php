<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'identifiant du véhicule est passé en paramètre GET
    if (isset($_GET['id'])) {
        $carId = $_GET['id'];

        // Requête pour récupérer les détails du véhicule
        $query = "SELECT * FROM cars WHERE id = :carId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':carId', $carId);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        // Requête pour récupérer les images du véhicule depuis la table car_images
        $imageQuery = "SELECT * FROM car_images WHERE car_id = :carId";
        $imageStmt = $pdo->prepare($imageQuery);
        $imageStmt->bindParam(':carId', $carId);
        $imageStmt->execute();
        $images = $imageStmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des détails du véhicule
        echo '<h2>' . $car['marque'] . ' ' . $car['modele'] . '</h2>';
        echo '<p>Prix : ' . $car['prix'] . ' €</p>';
        echo '<p>Année de mise en circulation : ' . $car['annee'] . '</p>';
        echo '<p>Kilométrage : ' . $car['kilometrage'] . ' km</p>';

        // Affichage de la galerie d'images
        echo '<div class="gallery">';
        foreach ($images as $image) {
            echo '<img src="' . $image['image'] . '" alt="Image véhicule">';
        }
        echo '</div>';
    } else {
        echo "Identifiant du véhicule non spécifié.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>