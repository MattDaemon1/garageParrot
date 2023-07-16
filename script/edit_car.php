<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'ID du véhicule est passé en paramètre GET
    if (isset($_GET['id'])) {
        $carId = $_GET['id'];

        // Récupérer les données du véhicule à partir de la table cars
        $query = "SELECT * FROM cars WHERE id = :carId";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':carId', $carId);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $marque = $_POST['marque'];
            $modele = $_POST['modele'];
            $prix = $_POST['prix'];
            $annee = $_POST['annee'];
            $kilometrage = $_POST['kilometrage'];
            $caracteristiques = $_POST['caracteristiques'];
            $equipements = $_POST['equipements'];
            $options = $_POST['options'];
            $description = $_POST['description'];

            // Mettre à jour les données du véhicule dans la table cars
            $updateQuery = "UPDATE cars SET marque = :marque, modele = :modele, prix = :prix, annee = :annee, kilometrage = :kilometrage, caracteristiques = :caracteristiques, equipements = :equipements, options = :options, description = :description WHERE id = :carId";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':marque', $marque, PDO::PARAM_STR);
            $updateStmt->bindParam(':modele', $modele, PDO::PARAM_STR);
            $updateStmt->bindParam(':prix', $prix, PDO::PARAM_STR);
            $updateStmt->bindParam(':annee', $annee, PDO::PARAM_INT);
            $updateStmt->bindParam(':kilometrage', $kilometrage, PDO::PARAM_INT);
            $updateStmt->bindParam(':caracteristiques', $caracteristiques, PDO::PARAM_STR);
            $updateStmt->bindParam(':equipements', $equipements, PDO::PARAM_STR);
            $updateStmt->bindParam(':options', $options, PDO::PARAM_STR);
            $updateStmt->bindParam(':description', $description, PDO::PARAM_STR);
            $updateStmt->bindParam(':carId', $carId, PDO::PARAM_INT);
            $updateStmt->execute();

            // Rediriger vers la page de détails du véhicule
            header("Location: details_car.php?id=$carId");
            exit();
        }
    } else {
        // Rediriger vers la page de gestion des véhicules si l'ID n'est pas spécifié
        header("Location: manage_cars.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un véhicule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5 mb-3">Modifier un véhicule</h2>

        <form method="POST">
            <div class="form-group">
                <label for="marque">Marque :</label>
                <input type="text" class="form-control" name="marque" id="marque" value="<?php echo $car['marque']; ?>">
            </div>

            <div class="form-group">
                <label for="modele">Modèle :</label>
                <input type="text" class="form-control" name="modele" id="modele" value="<?php echo $car['modele']; ?>">
            </div>

            <div class="form-group">
                <label for="prix">Prix :</label>
                <input type="text" class="form-control" name="prix" id="prix" value="<?php echo $car['prix']; ?>">
            </div>

            <div class="form-group">
                <label for="annee">Année de mise en circulation :</label>
                <input type="number" class="form-control" name="annee" id="annee" value="<?php echo $car['annee']; ?>">
            </div>

            <div class="form-group">
                <label for="kilometrage">Kilométrage :</label>
                <input type="number" class="form-control" name="kilometrage" id="kilometrage" value="<?php echo $car['kilometrage']; ?>">
            </div>

            <div class="form-group">
                <label for="caracteristiques">Caractéristiques :</label>
                <textarea class="form-control" name="caracteristiques" id="caracteristiques"><?php echo $car['caracteristiques']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="equipements">Équipements :</label>
                <textarea class="form-control" name="equipements" id="equipements"><?php echo $car['equipements']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="options">Options :</label>
                <textarea class="form-control" name="options" id="options"><?php echo $car['options']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" name="description" id="description"><?php echo $car['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="details_car.php?id=<?php echo $carId; ?>" class="btn btn-secondary">Retour aux détails</a>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>