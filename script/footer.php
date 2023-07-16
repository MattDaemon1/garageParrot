<footer class="footer bg-dark text-white text-center py-3">
    <div class="container-fluid">
        <div class="row">

            <!-- Colonne 1 : Réseaux sociaux -->
            <div class="col-md-3 text-center">
                <h5 class="mb-4">Suivez-nous</h5>
                <div class="row">
                    <div class="col-6 px-1">
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-3x mb-3"></i></a><br>
                        <a href="#" class="text-white"><i class="fab fa-facebook-f fa-3x mb-3"></i></a>
                    </div>
                    <div class="col-6 px-1">
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-3x mb-3"></i></a><br>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-3x mb-3"></i></a>
                    </div>
                </div>
            </div>

            <!-- Colonne 2 : Horaires d'ouverture -->
            <div class="col-md-3">
                <h4>Horaires d'ouverture</h4>
                <ul>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "garage";

                    try {
                        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query = "SELECT * FROM opening_hours";
                        $stmt = $pdo->query($query);
                        $openingHours = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Afficher chaque horaire d'ouverture dans le format souhaité
                        foreach ($openingHours as $openingHour) {
                            $startTime = date("H\h", strtotime($openingHour['start_time']));
                            $endTime = date("H\h", strtotime($openingHour['end_time']));
                            echo "<li>{$openingHour['day']}: $startTime - $endTime</li>";
                        }
                    } catch (PDOException $e) {
                        echo "Erreur de connexion à la base de données : " . $e->getMessage();
                    }
                    ?>
                </ul>
            </div>

            <!-- Colonne 3 : Navigation -->
            <div class="col-md-3">
                <h5>Navigation</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white">Accueil</a></li>
                    <li><a href="Nos services.php" class="text-white">Nos services</a></li>
                    <li><a href="Nos occasions.php" class="text-white">Nos occasions</a></li>
                    <li><a href="Se connecter.php" class="text-white">Se connecter</a></li>
                </ul>
            </div>

            <!-- Colonne 4 : Logo -->
            <div class="col-md-3">
                <img src="logo.png" alt="Logo" class="img-fluid">
            </div>

        </div>
    </div>
</footer>