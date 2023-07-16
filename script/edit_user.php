<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous d'inclure votre code de connexion à la base de données ici
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "garage";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST["id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $role = $_POST["role"];

        // Mettre à jour l'enregistrement utilisateur dans la base de données
        $query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $email, $role, $id]);

        // Rediriger vers la page de gestion des utilisateurs après la mise à jour réussie
        header("Location: manage_users.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}

if (isset($_GET["id"])) {
    // Assurez-vous d'inclure votre code de connexion à la base de données ici
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "garage";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_GET["id"];

        // Récupérer l'enregistrement utilisateur à modifier depuis la base de données
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Utilisateur non trouvé, rediriger vers la page de gestion des utilisateurs
            header("Location: manage_users.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
} else {
    // Paramètre "id" non fourni, rediriger vers la page de gestion des utilisateurs
    header("Location: manage_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Modifier un utilisateur</h2>
        <form action="edit_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
        <a href="manage_users.php" class="btn btn-secondary mt-3">Retour aux utilisateurs</a>
    </div>
</body>

</html>