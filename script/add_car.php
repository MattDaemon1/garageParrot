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
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
            // Préparer le dossier de destination pour les images
            $uploadDir = 'images/';
            $uploadedImages = array();

            // Parcourir tous les fichiers téléchargés
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $fileName = $_FILES['images']['name'][$key];
                $fileSize = $_FILES['images']['size'][$key];
                $fileTmp = $_FILES['images']['tmp_name'][$key];
                $fileType = $_FILES['images']['type'][$key];
                $fileError = $_FILES['images']['error'][$key];

                // Générer un nom de fichier unique
                $uniqueFileName = uniqid() . '_' . $fileName;

                // Vérifier si le fichier est une image
                if (exif_imagetype($fileTmp)) {
                    // Déplacer le fichier vers le dossier de destination
                    if (move_uploaded_file($fileTmp, $uploadDir . $uniqueFileName)) {
                        // Enregistrer le chemin de l'image dans la table car_images
                        $insertQuery = "INSERT INTO car_images (car_id, image) VALUES (:carId, :image)";
                        $insertStmt = $pdo->prepare($insertQuery);
                        $insertStmt->bindParam(':carId', $carId, PDO::PARAM_INT);
                        $insertStmt->bindParam(':image', $uniqueFileName, PDO::PARAM_STR);
                        $insertStmt->execute();

                        // Ajouter le nom de fichier à la liste des images téléchargées
                        $uploadedImages[] = $uniqueFileName;
                    }
                }
            }

            // Afficher un message de confirmation pour les images téléchargées
            if (!empty($uploadedImages)) {
                echo 'Les images suivantes ont été téléchargées avec succès : ' . implode(', ', $uploadedImages) . '<br>';
            }
        }

        // Insérer les données du véhicule dans la table cars
        $insertQuery = "INSERT INTO cars (marque, modele, prix, annee, kilometrage, caracteristiques, equipements, options, description) VALUES (:marque, :modele, :prix, :annee, :kilometrage, :caracteristiques, :equipements, :options, :description)";
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
        $insertStmt->execute();

        // Récupérer l'ID du véhicule inséré
        $carId = $pdo->lastInsertId();

        // Rediriger vers la page de détails du véhicule
        header("Location: details_car.php?id=$carId");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
