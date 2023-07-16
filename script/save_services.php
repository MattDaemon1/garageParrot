<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "garage";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $title = $_POST["title"];
        $description = $_POST["description"];

        $stmt = $pdo->prepare("INSERT INTO services (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);

        header("Location: dashboard.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
