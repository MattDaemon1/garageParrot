<?php
require 'db.php';  // Fichier contenant les informations de connexion à votre base de données

session_start();

// Vérifie si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hash du mot de passe pour la sécurité
    $role = $_POST['role'];  // Le rôle de l'utilisateur (administrateur, employé, etc.)

    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();

    echo "Compte utilisateur créé avec succès.";
} else {
?>
<form method="POST" action="">
    Nom d'utilisateur: <input type="text" name="username" required><br>
    Mot de passe: <input type="password" name="password" required><br>
    Rôle: <select name="role">
              <option value="admin">Administrateur</option>
              <option value="employee">Employé</option>
          </select><br>
    <input type="submit" value="Créer un compte">
</form>
<?php
}
?>
