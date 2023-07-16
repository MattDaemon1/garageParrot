<!DOCTYPE html>
<html>

<head>
    <title>Gestion des horaires d'ouverture</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Gestion des horaires d'ouverture</h2>

        <?php
        // Assurez-vous que vous avez établi la connexion à votre base de données MySQL
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "garage";

        $message = ""; // Variable pour stocker le message à afficher

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Mettre à jour les horaires d'ouverture dans la base de données
                $query = "UPDATE opening_hours SET start_time = ?, end_time = ? WHERE day = ?";
                $stmt = $pdo->prepare($query);

                $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                foreach ($days as $day) {
                    $start_time = $_POST[$day . '_start_time'];
                    $end_time = $_POST[$day . '_end_time'];
                    $stmt->execute([$start_time, $end_time, $day]);
                }

                $message = "Les horaires d'ouverture ont été mis à jour avec succès.";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
        ?>

        <?php if ($message) : ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="manage_hours.php" method="post">
            <?php
            $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

            foreach ($days as $day) {
                $start_time = getOpeningHour($day, 'start_time');
                $end_time = getOpeningHour($day, 'end_time');

                echo '<div class="form-group">';
                echo '<label for="' . $day . '_start_time">' . ucfirst($day) . ' - Heure d\'ouverture</label>';
                echo '<input type="time" class="form-control" id="' . $day . '_start_time" name="' . $day . '_start_time" value="' . $start_time . '" required>';
                echo '</div>';

                echo '<div class="form-group">';
                echo '<label for="' . $day . '_end_time">' . ucfirst($day) . ' - Heure de fermeture</label>';
                echo '<input type="time" class="form-control" id="' . $day . '_end_time" name="' . $day . '_end_time" value="' . $end_time . '" required>';
                echo '</div>';
            }
            ?>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

        <a href="dashboard.php" class="btn btn-primary">Retour au dashboard</a>
    </div>
</body>

</html>

<?php
// Fonction pour récupérer l'horaire d'ouverture d'un jour spécifique depuis la base de données
function getOpeningHour($day, $field)
{
    global $pdo;

    $query = "SELECT $field FROM opening_hours WHERE day = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$day]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result[$field];
    }

    return "";
}
?>