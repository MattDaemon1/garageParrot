<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Garage V. Parrot</title>
  <meta name="description" content="Bienvenue au garage V. Parrot, votre solution de confiance pour tous vos besoins en matière de réparation automobile et vente de voitures d'occasion. Découvrez notre large gamme de services et notre sélection de véhicules de qualité dès aujourd'hui.">
  <meta name="keywords" content="garage, réparation de voiture, vente de voitures d'occasions, réparation de carrosserie, entretien courant, mécanique">
  <meta name="robots" content="index,follow">
  <meta http-equiv="Content-Language" content="fr">
  <link rel="canonical" href="http://votresite.com" />
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="styles.scss">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">Logo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="occasions.php">Nos occasions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./script/login.html">
              <i class="fas fa-user"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="hero d-flex align-items-center justify-content-center text-center">
    <div class="container">
      <h1>Garage V.Parrot</h1>
      <p>Lorem ipsum dolor sit amet,</p>

      <?php include './script/services.php'; ?>

      <?php include './script/filter_cars.php'; ?>

      <?php include './script/cars.php'; ?>

    </div>
  </main>
  <footer class="footer">
    <div class="container">
      <?php include './script/footer.php'; ?>
    </div>
  </footer>

</body>

</html>