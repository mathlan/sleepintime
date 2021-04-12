<?php
  require 'config.php';
  $sleepintime = Database::connect();

  if (!isset($_SESSION)) { session_start(); }

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet"> 
    <title>Quel est votre temps de sommeil idéal?</title>
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
        <div class="row justify-content-center margin-1st-box box-align">

          <div class="col-lg-3 col-md-6 col-sm-12">
            <h1 class="margin-heading">Bienvenue sur votre interface!</h1>
            </br>
            <p>Est-ce que vous avez bien dormi cette nuit? Informez en SleepInTime en remplissant le champ se situant un peu plus bas. </p>
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
        <div class="row justify-content-center">

          <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="img/girl.jpg" class="sleepigirl">
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 box-align2">

            <h1 class="h1-box2">Combien de temps avez-vous dormi cette nuit?</h1></br>

            <form action="date_post.php" method="post">

              <label for="hours"></label>
              <input   class="box-hour-minute" list="hour" name="hours" placeholder="Heures">
                  <datalist  id="hour">
                    <option value="0">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                    <option value="6">
                    <option value="7">
                    <option value="8">
                    <option value="9">
                    <option value="10">
                    <option value="11">
                    <option value="12">
                    <option value="13">
                    <option value="14">
                  </datalist>

              <label for="minutes"><span style="color: #4848c2; font-size:xx-large;";>:</span></label>
              <input   class="box-hour-minute" list="minute" name="minutes" placeholder="Minutes">
              <datalist  id="minute">
                <option value="0">
                <option value="5">
                <option value="10">
                <option value="15">
                <option value="20">
                <option value="25">
                <option value="30">
                <option value="35">
                <option value="40">
                <option value="45">
                <option value="50">
                <option value="55">
              </datalist>


              </br><input type="date" class="box-date" size="30" name="date_sleep" class="box-date" placeholder="Date du jour"/></br>
                
              <?php
                $id_user = $_SESSION['id_user'];

                /*Creating the var for each DAY data*/

                $arraydaydata = array();
                $req = "SELECT date_sleep FROM `sleep_db` WHERE id_user ='{$_SESSION['id_user']}' ORDER BY date_sleep DESC";
                foreach  ($sleepintime->query($req) as $row) {
                $arraydaydata[] = $row['date_sleep'];
                }

                for($i = 0; $i < 7; ++$i) {
                  if (isset($arraydaydata[$i])) {
                    $day[$i] = $arraydaydata[$i];
                  }else {
                    $day[$i] = "Date non définie";
                  }
                }

                /*Creating the var for each TIME data*/

                $arraytimedata = array();
                $req = "SELECT time_sleep FROM `sleep_db` WHERE id_user ='{$_SESSION['id_user']}' ORDER BY date_sleep DESC";
                foreach  ($sleepintime->query($req) as $row) {
                $arraytimedata[] = $row['time_sleep'];
                }

                for($i = 0; $i < 7; ++$i) {
                  if (isset($arraytimedata[$i])) {
                    $time[$i] = $arraytimedata[$i];
                  }else {
                    $time[$i] = 0;
                  }
                }
              ?>

            <input class="btn btn-hour-minute" name="send_date" type="submit" value="Enregistrer">

            </form>
          </div>

        </div>
      </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~ BOX 3 ~~~~~~~~~~~~~~~~~~~~ -->
    <section id="data" class= "no-class">
      <div class="container-fluid no-padding-left">
        <div class="row justify-content-center">

          <div class="col-lg-6 col-md-6 col-sm-12 box-align2">
            <div>
              <h1>Graphique de votre sommeil en ligne</h1></br>
            </div>

            <div class="chart-area">
                <canvas id="myLineChart"></canvas>
            </div>

            <div>
              </br><img src="img/wondering.gif" class="">
            </div>

            <div>
              </br><h1>Graphique de votre sommeil en barres</h1></br>
            </div>

            <div class="chart-area">
                <canvas id="myBarChart"></canvas></br>
            </div>

          </div>

        </div>
      </div>
    </section>

    <div class="row">


    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~ Graph ~~~~~~~~~~~~~~~~~~~~ -->
    <script type="text/javascript">
    var day1 = <?php echo json_encode($day[0], JSON_HEX_TAG); ?>;
    var day2 = <?php echo json_encode($day[1], JSON_HEX_TAG); ?>;
    var day3 = <?php echo json_encode($day[2], JSON_HEX_TAG); ?>;
    var day4 = <?php echo json_encode($day[3], JSON_HEX_TAG); ?>;
    var day5 = <?php echo json_encode($day[4], JSON_HEX_TAG); ?>;
    var day6 = <?php echo json_encode($day[5], JSON_HEX_TAG); ?>;
    var day7 = <?php echo json_encode($day[6], JSON_HEX_TAG); ?>;

    var time1 = <?php echo json_encode($time[0], JSON_HEX_TAG); ?>;
    var time2 = <?php echo json_encode($time[1], JSON_HEX_TAG); ?>;
    var time3 = <?php echo json_encode($time[2], JSON_HEX_TAG); ?>;
    var time4 = <?php echo json_encode($time[3], JSON_HEX_TAG); ?>;
    var time5 = <?php echo json_encode($time[4], JSON_HEX_TAG); ?>;
    var time6 = <?php echo json_encode($time[5], JSON_HEX_TAG); ?>;
    var time7 = <?php echo json_encode($time[6], JSON_HEX_TAG); ?>;
    </script>

    <script src="js/Chart.min.js"></script>
    <script src="js/chart-line.js"></script>
    <script src="js/chart-bar.js"></script>

    <!-- ~~~~~~~~~~~~~~~~~~~~ Bootstrap ~~~~~~~~~~~~~~~~~~~~ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
