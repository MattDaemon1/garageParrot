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

    $rowCount = 0; // Compteur de lignes

    foreach ($cars as $car) {
        // Début d'une nouvelle ligne
        if ($rowCount % 3 == 0) {
            echo '<div class="row">';
        }

        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card">';

        // Requête pour récupérer l'image de la table car_images
        $imageQuery = "SELECT * FROM car_images WHERE car_id = :carId";
        $imageStmt = $pdo->prepare($imageQuery);
        $imageStmt->execute(['carId' => $car['id']]);
        $images = $imageStmt->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="slider">';
        foreach ($images as $image) {
            echo '<div><img src="' . $image['image'] . '" alt="Image véhicule"></div>';
        }
        echo '</div>';

        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $car['marque'] . ' ' . $car['modele'] . '</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">' . $car['annee'] . '</h6>';
        echo '<p class="card-text">Prix : ' . $car['prix'] . '€</p>';
        echo '<p class="card-text">Kilométrage : ' . $car['kilometrage'] . ' km</p>';
        echo '<a href="details.php?id=' . $car['id'] . '" class="btn btn-primary">Détails</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Fin d'une ligne
        if (($rowCount + 1) % 3 == 0) {
            echo '</div>';
        }

        $rowCount++;
    }

    // Fermer la dernière ligne si le nombre de véhicules n'est pas un multiple de 3
    if ($rowCount % 3 != 0) {
        echo '</div>';
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
