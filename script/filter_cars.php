<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les valeurs minimales et maximales des prix, du kilométrage et de l'année de mise en circulation
    $minPriceQuery = "SELECT MIN(prix) AS min_price FROM cars";
    $maxPriceQuery = "SELECT MAX(prix) AS max_price FROM cars";
    $minKilometersQuery = "SELECT MIN(kilometrage) AS min_kilometers FROM cars";
    $maxKilometersQuery = "SELECT MAX(kilometrage) AS max_kilometers FROM cars";
    $minYearQuery = "SELECT MIN(annee) AS min_year FROM cars";
    $maxYearQuery = "SELECT MAX(annee) AS max_year FROM cars";

    $minPriceStmt = $pdo->query($minPriceQuery);
    $maxPriceStmt = $pdo->query($maxPriceQuery);
    $minKilometersStmt = $pdo->query($minKilometersQuery);
    $maxKilometersStmt = $pdo->query($maxKilometersQuery);
    $minYearStmt = $pdo->query($minYearQuery);
    $maxYearStmt = $pdo->query($maxYearQuery);

    $minPrice = $minPriceStmt->fetchColumn();
    $maxPrice = $maxPriceStmt->fetchColumn();
    $minKilometers = $minKilometersStmt->fetchColumn();
    $maxKilometers = $maxKilometersStmt->fetchColumn();
    $minYear = $minYearStmt->fetchColumn();
    $maxYear = $maxYearStmt->fetchColumn();

    // Vérifier si des filtres ont été soumis
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];

        // Récupérer les valeurs filtrées pour le prix, le kilométrage et l'année de mise en circulation
        $filteredPrice = filter_input(INPUT_GET, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $filteredKilometers = filter_input(INPUT_GET, 'kilometers', FILTER_SANITIZE_NUMBER_INT);
        $filteredYear = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_NUMBER_INT);

        // Construire la requête SQL en fonction des filtres sélectionnés
        $query = "SELECT * FROM cars WHERE 1 = 1";

        if ($filteredPrice) {
            $query .= " AND prix >= :minPrice AND prix <= :maxPrice";
        }
        if ($filteredKilometers) {
            $query .= " AND kilometrage >= :minKilometers AND kilometrage <= :maxKilometers";
        }
        if ($filteredYear) {
            $query .= " AND annee >= :minYear AND annee <= :maxYear";
        }

        // Préparer et exécuter la requête avec les paramètres des filtres
        $stmt = $pdo->prepare($query);

        if ($filteredPrice) {
            $stmt->bindParam(':minPrice', $filteredPrice, PDO::PARAM_STR);
            $stmt->bindParam(':maxPrice', $maxPrice, PDO::PARAM_STR);
        }
        if ($filteredKilometers) {
            $stmt->bindParam(':minKilometers', $filteredKilometers, PDO::PARAM_INT);
            $stmt->bindParam(':maxKilometers', $maxKilometers, PDO::PARAM_INT);
        }
        if ($filteredYear) {
            $stmt->bindParam(':minYear', $filteredYear, PDO::PARAM_INT);
            $stmt->bindParam(':maxYear', $maxYear, PDO::PARAM_INT);
        }

        $stmt->execute();
        $filteredCars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Afficher les résultats filtrés
        foreach ($filteredCars as $car) {
            // Affichage de la carte du véhicule
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $car['image'] . '" class="card-img-top" alt="Illustration">';
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

        // Afficher un lien pour réinitialiser les filtres
        echo '<a href="filter_cars.php" class="btn btn-secondary">Réinitialiser</a>';
    } else {
        // Afficher les barres de filtres avec les valeurs minimales et maximales
        echo '<form method="GET" action="filter_cars.php" class="mb-4">';
        echo '<div class="form-row">';
        echo '<div class="form-group col-md-4">';
        echo '<label for="price">Prix :</label>';
        echo '<input type="number" class="form-control" id="price" name="price" min="' . $minPrice . '" max="' . $maxPrice . '">';
        echo '</div>';
        echo '<div class="form-group col-md-4">';
        echo '<label for="kilometers">Kilométrage :</label>';
        echo '<input type="number" class="form-control" id="kilometers" name="kilometers" min="' . $minKilometers . '" max="' . $maxKilometers . '">';
        echo '</div>';
        echo '<div class="form-group col-md-4">';
        echo '<label for="year">Année :</label>';
        echo '<input type="number" class="form-control" id="year" name="year" min="' . $minYear . '" max="' . $maxYear . '">';
        echo '</div>';
        echo '</div>';
        echo '<button type="submit" name="filter" class="btn btn-primary">Filtrer</button>';
        echo '</form>';

        // Afficher tous les véhicules non filtrés
        $query = "SELECT * FROM cars";
        $stmt = $pdo->query($query);
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cars as $car) {
            // Affichage de la carte du véhicule
            echo '<div class="col-md-4 mb-4">';
            echo '<div class="card">';
            echo '<img src="' . $car['image'] . '" class="card-img-top" alt="Illustration">';
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
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
