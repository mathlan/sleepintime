<?php
	require 'config.php';
  $sleepintime = Database::connect();
  
  if (!isset($_SESSION)) { session_start(); }

	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FROM
		$firstname_user = $_POST['firstname_user'];
		$nickname_user = $_POST['nickname_user'];
		$password_user = $_POST['password_user'];
		$email_user = $_POST['email_user'];

		if($firstname_user == '')
			$errMsg = 'Entrez votre prénom';
		if($nickname_user == '')
			$errMsg = 'Entrez votre identifiant';
		if($password_user == '')
			$errMsg = 'Entrez votre mot de passe';
		if($email_user == '')
			$errMsg = 'Entrez votre adresse email';

		if($errMsg == ''){
			try {
				$stmt = $sleepintime->prepare('INSERT INTO user_db (firstname_user, nickname_user, password_user, email_user) VALUES (:firstname_user, :nickname_user, :password_user, :email_user)');
				$stmt->execute(array(
					':firstname_user' => $firstname_user,
					':nickname_user' => $nickname_user,
					':password_user' => $password_user,
					':email_user' => $email_user
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = '<span style="color:#4848c2; font-size:1.5rem;">Votre inscription a bien été effecutée.</br> Vous pouvez maintenant vous <a href="login.php">connecter</a></span>';
	}
?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"> 

    <title>Inscription</title>
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

            <div class="create-title"><b>Créer mon compte</b></div>
            <div style="margin: 30px">

              <form action="" method="post">

                <input type="text" name="firstname_user" placeholder="Prénom" value="<?php if(isset($_POST['firstname_user'])) echo $_POST['firstname_user'] ?>" autocomplete="off" class="box"/><br /><br />
                <input type="text" name="nickname_user" placeholder="Identifiant" value="<?php if(isset($_POST['nickname_user'])) echo $_POST['nickname_user'] ?>" autocomplete="off" class="box"/><br /><br />
                <input type="password_user" name="password_user" placeholder="Mot de passe" value="<?php if(isset($_POST['password_user'])) echo $_POST['password_user'] ?>" class="box" /><br/><br />
                <input type="email" name="email_user" placeholder="Email" value="<?php if(isset($_POST['email_user'])) echo $_POST['email_user'] ?>" autocomplete="off" class="box"/><br /><br />
                
                <input type="submit" name='register' value="Valider" class='btn'/><br />

              </form>
            </div>

            <?php
              if(isset($errMsg)){
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
              }
            ?>

      </div>
    
          <div class="col-lg-3 col-md-6 col-sm-12">
            <img src="img/pika.png" class="sleepika">
          </div>
    
        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~ Bootstrap ~~~~~~~~~~~~~~~~~~~~ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>

