<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

$message = ""; // Variable pour stocker le message à afficher

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $title = $_POST["title"];
        $description = $_POST["description"];

        // Insérer le nouveau service dans la base de données
        $query = "INSERT INTO services (title, description) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description]);

        $message = "Le service a été ajouté avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard - Ajouter un service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Ajouter un service</h2>

        <?php if ($message) : ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="add_service.php" method="post">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="manage_services.php" class="btn btn-secondary">Retour aux services</a>
        </form>
    </div>
</body>

</html>