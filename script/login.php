<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "garage";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Vérifier si l'utilisateur existe et que le mot de passe est correct
        if ($user && $password === $user["password"]) {  // comparaison directe ici
            // L'utilisateur est connecté
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user["id"];
            header("location: dashboard.php");
            exit;
        } else {
            // Message d'erreur
            echo "Invalid email or password.";
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
