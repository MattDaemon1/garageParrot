<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM cars";
    $stmt = $pdo->query($query);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="row">';
    foreach ($cars as $car) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';
        
        // Requête pour récupérer l'image principale de la table car_images
        $imageQuery = "SELECT image FROM car_images WHERE car_id = :carId AND top_image = 1";
        $imageStmt = $pdo->prepare($imageQuery);
        $imageStmt->execute(['carId' => $car['id']]);
        $image = $imageStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($image) {
            echo '<img src="' . $image['image'] . '" class="card-img-top" alt="Image véhicule">';
        } else {
            echo '<img src="default-image.jpg" class="card-img-top" alt="Image véhicule">';
        }
        
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $car['marque'] . ' ' . $car['modele'] . '</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">' . $car['annee'] . '</h6>';
        echo '<p class="card-text">Prix : ' . $car['prix'] . ' €</p>';
        echo '<p class="card-text">Kilométrage : ' . $car['kilometrage'] . ' km</p>';
        echo '<a href="details_car.php?id=' . $car['id'] . '" class="btn btn-primary">Détails</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
