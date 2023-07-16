<!DOCTYPE html>
<html>

<head>
    <title>Gestion des voitures d'occasion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Gestion des voitures d'occasion</h2>
        <a href="dashboard.php" class="btn btn-primary mb-3">Retour au dashboard</a>
        <a href="add_car.php" class="btn btn-success mb-3">Ajouter une voiture d'occasion</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Prix</th>
                    <th>Année</th>
                    <th>Kilométrage</th>
                    <th>Description</th>
                    <th>Caractéristiques</th>
                    <th>Équipements</th>
                    <th>Options</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "garage";

                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $query = "SELECT * FROM cars";
                    $statement = $pdo->query($query);
                    $cars = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($cars as $car) {
                        echo "<tr>";
                        echo "<td>{$car['id']}</td>";
                        echo "<td>{$car['marque']}</td>";
                        echo "<td>{$car['modele']}</td>";
                        echo "<td>{$car['prix']}</td>";
                        echo "<td>{$car['annee']}</td>";
                        echo "<td>{$car['kilometrage']}</td>";
                        echo "<td>{$car['description']}</td>";
                        echo "<td>{$car['caracteristiques']}</td>";
                        echo "<td>{$car['equipements']}</td>";
                        echo "<td>{$car['options']}</td>";
                        echo "<td>";
                        echo "<a href='edit_car.php?id={$car['id']}' class='btn btn-primary'>Modifier</a>";
                        echo "<a href='delete_car.php?id={$car['id']}' class='btn btn-danger ml-2'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erreur de connexion à la base de données : " . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>