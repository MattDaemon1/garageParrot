<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis pour ajouter un nouvel avis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $commentaire = $_POST['commentaire'];
        $note = $_POST['note'];

        // Insérer le nouvel avis dans la table testimonials
        $insertQuery = "INSERT INTO testimonials (nom, commentaire, note, approuve) VALUES (:nom, :commentaire, :note, :approuve)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $insertStmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
        $insertStmt->bindParam(':note', $note, PDO::PARAM_INT);
        $insertStmt->bindValue(':approuve', 0, PDO::PARAM_INT); // Nouvel avis non approuvé par défaut
        $insertStmt->execute();

        // Rediriger vers la page de gestion des témoignages
        header("Location: manage_testimonials.php");
        exit();
    }

    // Vérifier si l'ID de l'avis à approuver ou supprimer est passé en paramètre GET
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $testimonialId = $_GET['id'];
        $action = $_GET['action'];

        if ($action === 'approve') {
            // Approuver l'avis en mettant à jour la colonne "approuve" à 1
            $updateQuery = "UPDATE testimonials SET approuve = 1 WHERE id = :testimonialId";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':testimonialId', $testimonialId, PDO::PARAM_INT);
            $updateStmt->execute();
        } elseif ($action === 'delete') {
            // Supprimer l'avis de la table testimonials
            $deleteQuery = "DELETE FROM testimonials WHERE id = :testimonialId";
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->bindParam(':testimonialId', $testimonialId, PDO::PARAM_INT);
            $deleteStmt->execute();
        }

        // Rediriger vers la page de gestion des témoignages
        header("Location: manage_testimonials.php");
        exit();
    }

    // Récupérer tous les avis depuis la base de données
    $query = "SELECT * FROM testimonials";
    $stmt = $pdo->query($query);
    $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Testimonials - Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <h2>Manage Testimonials</h2>

        <!-- Affichage des avis -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Commentaire</th>
                    <th>Note</th>
                    <th>Approuvé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $testimonial) : ?>
                    <tr>
                        <td><?php echo $testimonial['id']; ?></td>
                        <td><?php echo $testimonial['nom']; ?></td>
                        <td><?php echo $testimonial['commentaire']; ?></td>
                        <td><?php echo $testimonial['note']; ?></td>
                        <td><?php echo $testimonial['approuve'] ? 'Oui' : 'Non'; ?></td>
                        <td>
                            <?php if ($testimonial['approuve'] == 0) : ?>
                                <a href="manage_testimonials.php?id=<?php echo $testimonial['id']; ?>&action=approve" class="btn btn-success btn-sm">Approuver</a>
                            <?php endif; ?>
                            <a href="manage_testimonials.php?id=<?php echo $testimonial['id']; ?>&action=delete" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Formulaire pour ajouter un nouvel avis -->
        <h3>Ajouter un nouvel avis</h3>
        <form method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>
            <div class="form-group">
                <label for="commentaire">Commentaire :</label>
                <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
            </div>
            <div class="form-group">
                <label for="note">Note :</label>
                <select class="form-control" name="note" id="note" required>
                    <option value="5">5 étoiles</option>
                    <option value="4">4 étoiles</option>
                    <option value="3">3 étoiles</option>
                    <option value="2">2 étoiles</option>
                    <option value="1">1 étoile</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

        <!-- Bouton de retour au dashboard -->
        <a href="dashboard.php" class="btn btn-secondary mt-3">Retour au dashboard</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>