<?php
// Inclure votre code de connexion à la base de données ici
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

        // Vérifier s'il y a des fichiers téléchargés
        if (isset($_FILES['top_image']) && !empty($_FILES['top_image']['name'])) {
            $fileName = $_FILES['top_image']['name'];
            $fileSize = $_FILES['top_image']['size'];
            $fileTmp = $_FILES['top_image']['tmp_name'];
            $fileType = $_FILES['top_image']['type'];
            $fileError = $_FILES['top_image']['error'];

            // Vérifier si le fichier est une image
            if (exif_imagetype($fileTmp)) {
                // Préparer le dossier de destination pour l'image principale
                $uploadDir = 'images/';
                $uniqueFileName = uniqid() . '_' . $fileName;

                // Déplacer le fichier vers le dossier de destination
                if (move_uploaded_file($fileTmp, $uploadDir . $uniqueFileName)) {
                    // Insérer les données du véhicule dans la table cars
                    $insertQuery = "INSERT INTO cars (marque, modele, prix, annee, kilometrage, caracteristiques, equipements, options, description, top_image) VALUES (:marque, :modele, :prix, :annee, :kilometrage, :caracteristiques, :equipements, :options, :description, :top_image)";
                    $insertStmt = $pdo->prepare($insertQuery);
                    $insertStmt->bindParam(':marque', $marque, PDO::PARAM_STR);
                    $insertStmt->bindParam(':modele', $modele, PDO::PARAM_STR);
                    $insertStmt->bindParam(':prix', $prix, PDO::PARAM_STR);
                    $insertStmt->bindParam(':annee', $annee, PDO::PARAM_INT);
                    $insertStmt->bindParam(':kilometrage', $kilometrage, PDO::PARAM_INT);
                    $insertStmt->bindParam(':caracteristiques', $caracteristiques, PDO::PARAM_STR);
                    $insertStmt->bindParam(':equipements', $equipements, PDO::PARAM_STR);
                    $insertStmt->bindParam(':options', $options, PDO::PARAM_STR);
                    $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);
                    $insertStmt->bindParam(':top_image', $uniqueFileName, PDO::PARAM_STR);
                    $insertStmt->execute();

                    // Récupérer l'ID du véhicule inséré
                    $carId = $pdo->lastInsertId();

                    // Rediriger vers la page de détails du véhicule
                    header("Location: details_car.php?id=$carId");
                    exit();
                }
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>

<!-- Code HTML pour le formulaire d'ajout de véhicule -->
<h2>Ajouter un véhicule</h2>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="marque">Marque :</label>
        <input type="text" class="form-control" name="marque" id="marque">
    </div>

    <div class="form-group">
        <label for="modele">Modèle :</label>
        <input type="text" class="form-control" name="modele" id="modele">
    </div>

    <div class="form-group">
        <label for="prix">Prix :</label>
        <input type="text" class="form-control" name="prix" id="prix">
    </div>

    <div class="form-group">
        <label for="annee">Année de mise en circulation :</label>
        <input type="number" class="form-control" name="annee" id="annee">
        <div class="form-group">
            <label for="kilometrage">Kilométrage :</label>
            <input type="number" class="form-control" name="kilometrage" id="kilometrage">
        </div>

        <div class="form-group">
            <label for="caracteristiques">Caractéristiques :</label>
            <textarea class="form-control" name="caracteristiques" id="caracteristiques"></textarea>
        </div>

        <div class="form-group">
            <label for="equipements">Équipements :</label>
            <textarea class="form-control" name="equipements" id="equipements"></textarea>
        </div>

        <div class="form-group">
            <label for="options">Options :</label>
            <textarea class="form-control" name="options" id="options"></textarea>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>

        <div class="form-group">
            <label for="top_image">Image principale :</label>
            <input type="file" class="form-control-file" name="top_image" id="top_image">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le véhicule</button>
</form>
<?php
