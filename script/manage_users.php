<!DOCTYPE html>
<html>

<head>
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Gestion des utilisateurs</h2>
        <a href="dashboard.php" class="btn btn-primary mb-3">Retour au Dashboard</a>
        <a href="add_user.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
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

                    $query = "SELECT * FROM users";
                    $statement = $pdo->query($query);
                    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>{$user['id']}</td>";
                        echo "<td>{$user['username']}</td>";
                        echo "<td>{$user['email']}</td>";
                        echo "<td>{$user['role']}</td>";
                        echo "<td><a href='edit_user.php?id={$user['id']}' class='btn btn-primary'>Modifier</a></td>";
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