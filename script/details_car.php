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
        echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
        echo '<ol class="carousel-indicators">';
        foreach ($images as $index => $image) {
            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $index . '"';
            if ($index === 0) {
                echo ' class="active"';
            }
            echo '></li>';
        }
        echo '</ol>';
        echo '<div class="carousel-inner">';
        foreach ($images as $index => $image) {
            echo '<div class="carousel-item';
            if ($index === 0) {
                echo ' active';
            }
            echo '">';
            echo '<img src="' . $image['image'] . '" class="d-block w-100" alt="Image">';
            echo '</div>';
        }
        echo '</div>';
        echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">';
        echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
        echo '<span class="sr-only">Previous</span>';
        echo '</a>';
        echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">';
        echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
        echo '<span class="sr-only">Next</span>';
        echo '</a>';
        echo '</div>';
    } else {
        echo "Identifiant du véhicule non spécifié.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
