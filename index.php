<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <title>Home</title>
  </head>
  <body>

    <!-- ~~~~~~~~~~~~~~~~~~~~ NAVBAR ~~~~~~~~~~~~~~~~~~~~ -->

    <nav class="navbar navbar-expand-lg bg-nav">
        <div class="container-fluid">
          <a class="navbar-brand nav-title-font" href="<?php if (empty($_SESSION)) {echo 'index.php';} else {echo 'dashboard.php';} ?>">Sleepin'time</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="" role="button" ><i class="fas fa-cloud-moon" aria-hidden="true" style="color:black"></i></span>
          </button>
          <div class="collapse navbar-collapse justify-content-left margin-nav-menu" id="navbarNav">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
              <a class="nav-link orange-font-nav-item" href="login.php">Connexion</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>

    <!-- ~~~~~~~~~~~~~~~~~~~~ BOX 1 ~~~~~~~~~~~~~~~~~~~~ -->
    <section id="home">
      <div class="container-fluid">
        <div class="row justify-content-center margin-1st-box box-align">

          <div class="col-lg-3 col-md-6 col-sm-12">
            <h1 class="margin-heading">Une compil' de données pour adapter son sommeil...</h1>
            <p>Pour les caféinomanes qui ne dorment pas assez, les passionnés de l'oreiller ou les rêveurs surbookés.<br> Même si on le sait tous, le mieux reste de se coucher et de se lever à heures régulières!</p>
            <a href="register.php" class="btn">Découvrir</a>
          </div>
    
          <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="img/pika.png" class="sleepika">
          </div>
    
        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~ BOX 2 ~~~~~~~~~~~~~~~~~~~~ -->
    <section id="data" class= "bg-data">
      <div class="container-fluid no-padding-left">
        <div class="row">

          <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="img/girl.jpg" class="sleepigirl">
          </div>

          <div class="col-lg-3 col-md-6 col-sm-12 offset-lg-1 margin-1st-box box-align2">

            <h1 class="margin-heading">Un compte personnalisé</h1>
            <p>Créez votre propre compte et notez chaque jour votre temps de sommeil pour pouvoir suivre son évolution au cours du temps.</p>
            <a href="register.php" class="btn">C'est parti!</a>

          </div>

        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~ BOX 3 ~~~~~~~~~~~~~~~~~~~~ -->
    <section id="graph" class= "bg-footer">
      <div class="container-fluid">
        <div class="row justify-content-center box3-align">

          <div class="col-lg-3 col-md-6 col-sm-12 box-align2">

            <h1 class="margin-heading">Un graphique de votre sommeil</h1>
            <p>Observez l'évolution de votre sommeil au cours de la semaine et adaptez vos futures nuits en fonction des données graphiques.</p>
            <a href="register.php" class="btn">M'inscrire</a>

          </div>

          <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="img/wondering.gif" class="wondering">
          </div>

        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~ Bootstrap ~~~~~~~~~~~~~~~~~~~~ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>