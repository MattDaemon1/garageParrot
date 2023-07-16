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



      <?php include './script/cars.php'; ?>

      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicateurs -->
            <ol class="carousel-indicators">
              <?php
              // Récupérer les avis approuvés depuis la base de données
              $query = "SELECT * FROM testimonials WHERE approuve = 1";
              $stmt = $pdo->query($query);
              $testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);

              // Afficher les indicateurs du carrousel
              foreach ($testimonials as $index => $testimonial) {
                echo '<li data-target="#testimonialCarousel" data-slide-to="' . $index . '"';
                if ($index === 0) {
                  echo ' class="active"';
                }
                echo '></li>';
              }
              ?>
            </ol>

            <!-- Slides du carrousel -->
            <div class="carousel-inner">
              <?php
              // Afficher les slides du carrousel
              foreach ($testimonials as $index => $testimonial) {
                echo '<div class="carousel-item';
                if ($index === 0) {
                  echo ' active';
                }
                echo '">';
                echo '<div class="testimonial-content">';
                echo '<h3>' . $testimonial['nom'] . '</h3>';
                echo '<p>' . $testimonial['commentaire'] . '</p>';
                echo '<div class="rating">';
                $rating = $testimonial['note'];
                for ($i = 1; $i <= 5; $i++) {
                  echo '<span class="fa fa-star';
                  if ($i <= $rating) {
                    echo ' checked';
                  }
                  echo '"></span>';
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
              }
              ?>
            </div>

            <!-- Contrôles du carrousel -->
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
              <span class="carousel-control-next-icon text-dark" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Formulaire pour laisser un avis -->
      <div class="row mt-4">
        <div class="col-md-6 offset-md-3">
          <div class="testimonial-form">
            <h3>Laissez votre avis</h3>
            <form method="POST">
              <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
              </div>
              <div class="form-group">
                <label for="commentaire">Commentaire :</label>
                <textarea class="form-control" name="commentaire" id="commentaire" required></textarea>
              </div>
              <div class="form-group">
                <label for="note">Note :</label>
                <select class="form-control" name="note" id="note" required>
                  <option value="5">5 étoiles</option>
                  <option value="4">4 étoiles</option>
                  <option value="3">3 étoiles</option>
                  <option value="2">2 étoiles</option>
                  <option value="1">1 étoile</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </main>




  <footer class="footer">
    <div class="container">
      <?php include './script/footer.php'; ?>
    </div>
  </footer>


</body>

</html>