<?php
	require 'config.php';
	$sleepintime = Database::connect();
	
	if (!isset($_SESSION)) { session_start(); }

	if(empty($_SESSION['firstname_user'] && $_SESSION['password_user']))
		header('Location: login.php');

	if(isset($_POST['update'])) {
		$errMsg = '';

		$firstname_user = $_POST['firstname_user'];
		$email_user = $_POST['email_user'];
		$password_user = $_POST['password_user'];
		$password_userChange = $_POST['password_userChange'];

		if($password_user != $password_userChange)
			$errMsg = 'Le mot de passe ne correspond pas';

		if($errMsg == '') {
			try {
		      $sql = "UPDATE user_db SET firstname_user = :firstname_user, password_user = :password_user, email_user = :email_user WHERE nickname_user = :nickname_user";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
		        ':firstname_user' => $firstname_user,
		        ':email_user' => $email_user,
		        ':password_user' => $password_user,
		        ':nickname_user' => $_SESSION['nickname_user']
		      ));
				header('Location: update.php?action=updated');
				exit;

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		$errMsg = 'Successfully updated. <a href="logout.php">Logout</a> and login to see update.';
?>


<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"> 

    <title>Mon compte</title>
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
			<p style="font-size: 1rem; color: white; padding-right: 50px; padding-top: 15px; padding-bottom: 0px;">Bonjour, <span style="color: #FFAF32"><?php echo $_SESSION['firstname_user']; ?></span></p>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link margin-font-nav-item" href="update.php">Mon compte</a>
					</li>
				</ul>
					<ul class="navbar-nav mr-auto">
					<li class="nav-item">
					<a class="nav-link orange-font-nav-item" href="logout.php">Déconnexion</a>
					</li>
				</ul>
          </div>
        </div>
    </nav>

    <!-- ~~~~~~~~~~~~~~~~~~~~ BOX 1 ~~~~~~~~~~~~~~~~~~~~ -->
    <section id="home">
      <div class="container-fluid">
        <div class="row justify-content-center margin-1st-box update-br box-align">

          <div class="col-lg-3 col-md-6 col-sm-12">

            <div class="create-title"><b>Mon compte</b></div>
            <div style="margin: 30px">

				<form action="" method="post">
					Prénom <br>
					<input type="text" name="firstname_user" value="<?php echo $_SESSION['firstname_user']; ?>" autocomplete="off" class="box"/><br /><br />
					Identifiant <br>
					<input type="text" name="nickname_user" value="<?php echo $_SESSION['nickname_user']; ?>" disabled autocomplete="off" class="box"/><br /><br />
					Code PIN <br>
					<input type="text" name="email_user" value="<?php echo $_SESSION['email_user']; ?>" autocomplete="off" class="box"/><br /><br />
					<hr>
					Mot de passe <br>
					<input type="password_user" name="password_user" value="<?php echo $_SESSION['password_user'] ?>" class="box" /><br/><br />
					Nouveau mot de passe <br>
					<input type="password_user" name="password_userChange" value="<?php echo $_SESSION['password_user'] ?>" class="box" /><br/><br />
					<input type="submit" name='update' value="Mettre à jour" class='btn'/><br />
				</form>
				<a class="nav-link orange-font-anchor" href="remove.php">Supprimer mon compte</a>
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