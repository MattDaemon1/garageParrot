<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer tous les véhicules de la table cars
    $query = "SELECT * FROM cars";
    $stmt = $pdo->query($query);
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .car-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .car-card {
            width: 300px;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .car-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .car-card h3 {
            margin-top: 10px;
        }

        .car-card p {
            margin-bottom: 5px;
        }

        .buttons {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mt-5 mb-3">Manage Cars</h2>

        <a href="add_car.php" class="btn btn-primary mb-3">Ajouter un véhicule</a>

        <div class="car-list">
            <?php foreach ($cars as $car) : ?>
                <div class="car-card">
                    <img src="<?php echo $car['top_image']; ?>" alt="Image véhicule">
                    <h3><?php echo $car['marque'] . ' ' . $car['modele']; ?></h3>
                    <p>Prix : <?php echo $car['prix']; ?> €</p>
                    <p>Année : <?php echo $car['annee']; ?></p>
                    <p>Kilométrage : <?php echo $car['kilometrage']; ?> km</p>
                    <div class="buttons">
                        <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn btn-secondary">Modifier</a>
                        <a href="delete_car.php?id=<?php echo $car['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>