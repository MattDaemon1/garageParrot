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
        $id = $_POST["id"];
        $title = $_POST["title"];
        $description = $_POST["description"];

        // Mettre à jour le service dans la base de données
        $query = "UPDATE services SET title = ?, description = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $id]);

        $message = "Le service a été mis à jour avec succès.";
    }

    if (isset($_GET["id"])) {
        // Récupérer le service depuis la base de données en fonction de l'ID fourni
        $id = $_GET["id"];

        $query = "SELECT * FROM services WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$service) {
            // Service non trouvé, rediriger vers la page de gestion des services
            header("Location: dashboard.php");
            exit;
        }
    } else {
        // Paramètre "id" non fourni, rediriger vers la page de gestion des services
        header("Location: dashboard.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Dashboard - Modifier le service</h2>

        <?php if ($message) : ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="edit_service.php" method="post">
            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $service['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $service['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>

</html>