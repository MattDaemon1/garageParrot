<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Contactez nous</title>
  <meta name="description" content="Contactez notre garage pour tous vos besoins en réparation automobile et vente de voitures d'occasion. Nous sommes impatients de vous fournir des services de qualité qui dépassent vos attentes.">
  <meta name="keywords" content="garage, réparation de voiture, vente voiture d'occasion, réparation de carrosserie, entretien courant, mécanique">
  <meta name="robots" content="index,follow">
  <meta http-equiv="Content-Language" content="fr">
  <link rel="canonical" href="http://votresite.com/services" />
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
  <main>
    <section class="hero d-flex align-items-center justify-content-center text-center">
      <div class="container">
        <h1>Contactez-nous</h1>
        <p>Vous avez des questions ? N'hésitez pas à nous contacter !</p>
      </div>
    </section>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2>Restons en contact</h2>
          <p>Si vous avez des questions sur nos services, si vous avez besoin d'une réparation, d'un véhicule d'occasion ou d'une autre demande, n'hésitez pas à nous contacter en utilisant le formulaire ci-dessous :</p>
        </div>
        <div class="col-md-6">
          <form action="mailto:matt@mattkonnect.com" method="POST" enctype="text/plain">
            <div class="row">
              <div class="col-md-6">
                <input type="text" name="first_name" placeholder="Prénom" required>
              </div>
              <div class="col-md-6">
                <input type="text" name="last_name" placeholder="Nom" required>
              </div>
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <select name="motif" required>
              <option value="">Choisir un motif</option>
              <option value="reparation">Réparation</option>
              <option value="occasion">Véhicule d'occasion</option>
              <option value="autre">Autre</option>
            </select>
            <textarea name="message" placeholder="Votre message" required></textarea>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="consentCheck" required>
              <label class="form-check-label" for="consentCheck">Je consens à ce que mes données soient traitées pour cette demande</label>
            </div>
            <input type="submit" value="Envoyer">
          </form>
        </div>
      </div>
    </div>
  </main>
  <section class="hero d-flex align-items-center justify-content-center text-center">
    <div class="container">
      <?php include './script/footer.php'; ?>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>