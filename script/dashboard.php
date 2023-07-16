<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tableau de bord</title>
    <meta name="description" content="Bienvenue chez [Nom de votre Garage], votre solution de confiance pour tous vos besoins en matière de réparation automobile et vente de voitures d'occasion. Découvrez notre large gamme de services et notre sélection de véhicules de qualité dès aujourd'hui.">
    <meta name="keywords" content="garage, réparation de voiture, vente de voitures d'occasions, réparation de carrosserie, entretien courant, mécanique">
    <meta name="robots" content="index,follow">
    <meta http-equiv="Content-Language" content="fr">
    <link rel="canonical" href="http://votresite.com/services" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../styles.scss">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../occasions.html">Nos occasions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-4 mb-4">Bienvenue dans le tableau de bord du Garage V. Parrot</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="manage_users.php">Gérer les utilisateurs</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="manage_services.php">Gérer les services</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="manage_hours.php">Gérer les horaires d'ouverture</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="manage_cars.php">Gérer les voitures d'occasion</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="manage_testimonials.php">Gérer les témoignages</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title"><a href="logout.php">Déconnexion</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS de Bootstrap (jQuery, Popper.js, et Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>