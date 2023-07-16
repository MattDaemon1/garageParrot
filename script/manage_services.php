<!DOCTYPE html>
<html>

<head>
    <title>Gestion des services</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Gestion des services</h2>
        <a href="dashboard.php" class="btn btn-primary mb-3">Retour au dashboard</a>
        <a href="add_service.php" class="btn btn-primary mb-3">Ajouter un service</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
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

                    $query = "SELECT * FROM services";
                    $statement = $pdo->query($query);
                    $services = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($services as $service) {
                        echo "<tr>";
                        echo "<td>{$service['id']}</td>";
                        echo "<td>{$service['title']}</td>";
                        echo "<td>{$service['description']}</td>";
                        echo "<td>";
                        echo "<a href='edit_service.php?id={$service['id']}' class='btn btn-primary'>Modifier</a>";
                        echo "<a href='delete_service.php?id={$service['id']}' class='btn btn-danger ml-2'>Supprimer</a>";
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