<?php
	require 'config.php';
  $sleepintime = Database::connect();

  if (!isset($_SESSION)) { session_start(); }

	if(isset($_POST['login'])) {
		$errMsg = '';

		$nickname_user = $_POST['nickname_user'];
		$password_user = $_POST['password_user'];

		if($nickname_user == '')
			$errMsg = 'Entrez un nom d\'utilisateur';
		if($password_user == '')
			$errMsg = 'Entrez un mot de passe';

		if($errMsg == '') {
			try {
				$stmt = $sleepintime->prepare('SELECT id_user, firstname_user, nickname_user, password_user, email_user FROM user_db WHERE nickname_user = :nickname_user');
				$stmt->execute(array(
					':nickname_user' => $nickname_user
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "L'utilisateur $nickname_user est introuvable.";
				}
				else {
					if($password_user == $data['password_user']) {
            $_SESSION['id_user'] = $data['id_user'];
						$_SESSION['firstname_user'] = $data['firstname_user'];
						$_SESSION['nickname_user'] = $data['nickname_user'];
						$_SESSION['password_user'] = $data['password_user'];
						$_SESSION['email_user'] = $data['email_user'];

						header('Location: dashboard.php');
						exit;
					}
					else
						$errMsg = 'Le mot de passe ne correspond pas.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"> 

    <title>Connexion</title>
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

          <div class="col-lg-3 col-md-6 col-sm-12 yellow-border">

            <div class="create-title"><b>Connexion</b></div>
            <div style="margin: 30px">

              <form action="" method="post">

                <input type="text" name="nickname_user" placeholder="Identifiant" value="<?php if(isset($_POST['nickname_user'])) echo $_POST['nickname_user'] ?>" autocomplete="off" class="box"/><br /><br />
                <input type="password_user" name="password_user" placeholder="Mot de passe" value="<?php if(isset($_POST['password_user'])) echo $_POST['password_user'] ?>" autocomplete="off" class="box" /><br/><br />
                <input type="submit" name='login' value="Se connecter" class='btn'/><br />

              </form>

              <?php
              if(isset($errMsg)){
                echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
              }
              ?>

              <hr>
              <button value="Se connecter" class='btn'><a class="button-link-font" href="register.php">S'inscrire</a></button>

            </div>
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