<?php

require 'config.php';
$sleepintime = Database::connect();

if (!isset($_SESSION)) { session_start(); }

$id_user = $_SESSION['id_user'];

$hours = $_POST['hours'];
$minutes = $_POST['minutes'];

$date = date('Y-m-d', strtotime(str_replace('/','-',$_POST['date_sleep'])));

    if (empty($hours)) {
        $hours = 0;
    }
    if (empty($minutes)) {
        $minutes = 0;
    }

$time_sleep = ($hours * 60) + $minutes;

    if ($id_user !== FALSE && $date !== FALSE && $time_sleep !== FALSE) {
        $req = $sleepintime->prepare('INSERT INTO sleep_db (id_user, date_sleep, time_sleep) VALUES (:id_user, :date_sleep, :time_sleep)');
        $req->execute(array(
            ':id_user' => $id_user,
            ':date_sleep' => $date,
            ':time_sleep' => $time_sleep,
        ));
    }
    else{
        echo 'error';
    }

header('Location: dashboard.php');
?>

</body>
</html>