<?php session_start();
require 'danesql.php';
$connect =  new MYSQLI(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$uid = $_SESSION['uid'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include 'vendor/autoload.php';

$check = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid'");
$c = $cheack->fetch_assoc();
if($c['uprawnienia'] == '0') {
  header('location: /');
  exit;
} elseif (empty($uid)) {
	header('location: /');
  exit;
}

if(isset($_POST['wycisz'])) {
	if($_POST['h'] < '24') {
		$czasw = $_POST['h'].' godzin/y';
		$use = '1';
	} else {
		$use = '0';
	}
	$unix = time();
	$wstaw = $_POST['h'] * '3600' + $unix;
    if($_POST['h'] % 2 == 1 || $_POST['h'] < 1) {
      $say = 'Czas wyciszenia musi być liczbą naturalną!';
    } else {
      $uidI = $_POST['id'];
       $p = $connect->query("SELECT * FROM viddle_users WHERE uid='$uidI'");
      $users = $p->num_rows;
      if($users == '0') {
        $say = 'Użytkownik o podanym id nie istnieje';
      } else {
        if(!empty($_POST['uzasadnienie'])) {
          $wynik = $_POST['h'] / 24;
          if($wynik % 2 == 0) {
		  if($use == '0') {
            		$czasw = $wynik.' dni';
		  }
    
          } elseif ($wynik > 1) {
            $dni = round($wynik, 0);
            $dniII = $dni * '24';
            $godziny = $_POST['h'] - $dniII;
            $czasw = $dni.' dni/dzień i '.$godziny.' godzin/y';
          } else {
		  $dni = round($wynik, 0);
		  $czasw = $dni.' dni/dzień';
	  }
          $daneusera = $p->fetch_assoc();
          
          require 'danemail.php';
          $mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8'; // Send using SMTP
    $mail->Host       = MAILHOST;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = MAILUSER;                     // SMTP username
    $mail->Password   = MAILPASS;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = MAILPORT;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(MAILUSER, MAILNAME);
    $mail->addAddress($daneusera['email']);     // Add a recipient



			$body = '<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <script src="https://kit.fontawesome.com/ca8376a2f4.js" crossorigin="anonymous"></script>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto");

            * {
                font-family: Roboto;
                color: white;
            }

            #header {
                padding: 10px;
                background-color: #313539;
                text-align: center;
            }

            #body {
                padding: 10px;
                background-color: #212529;
                justify-content: center;
            }

            #text-container {
                padding-left: 10%;
                padding-right: 10%;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <h1>Twój kanał otrzymał tymczasową blokadę.</h1>
        </div>
        <div id="body">
            <div id="text-container">
                <p>
                    Witaj, <b>'.$daneusera['login'].'.</b><br><br>
                    Chcemy poinformować, że mimo nakładanych ostrzeżeń na Twój kanał, nie stosowałeś/aś się do regulaminu serwisu.<br><br>
                    Na Twój kanał nałożyliśmy tymczasową blokadę, która potrwa '.$czasw.'<br>
                    Powód blokady: '.$_POST['uzasadnienie'].'.<br><br>
                    Jeżeli uważasz, że ta decyzja była niesłuszna, skontaktuj się z nami drogą mailową lub na <a href="https://discord.gg/QsrbDtxWpn">naszym serwerze Discord.</a><br><br>
                    Pozdrawiamy,<br>
                    Viddle Developers
                </p>
                <br><hr>
                <p style="text-align: center; font-size: small;">
                    Wiadomość została wygenerowana automatycznie. Prosimy na nią nie odpisywać.<br>
                    Jeżeli chcesz się odwołać od naszej decyzji, napisz wiadomość mailową w nowym wątku lub skontaktuj się z nami na naszym serwerze Discord i otwórz ticket do supportu.
                </p>
            </div>
        </div>
    </body>
</html>';


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Dostałeś tymczasową blokade na viddle';
    $mail->Body    = $body;
    if($mail->send()) {
      $uz = $_POST['uzasadnienie'];
      $today = date("Y-m-d");
        $dupa = $connect->query("INSERT INTO `viddle_mutes` VALUES (NULL, '$uidI', '$today', '$wstaw', '$uz', '$uid')");
        $dupaII = $connect->query("UPDATE `viddle_users` SET `mute`='$wstaw' WHERE `uid`='$uidI'");
        $say = 'Wyciszono użytkownika!';
    }
          
        } else {
          $say = 'Musisz uzasadnić dlaczego chcesz wyciszyć daną osobe';
        }
      }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<script src="/cdn-cgi/apps/head/KXVv_VQyBtibcmvK-FYml_HDUsM.js"></script><link rel="stylesheet" href="https://midacss.ml/assets/master.min.css" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Panel moderatora - usuwanie filmu</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<meta property="og:title" content="Viddle">
<meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
<script src="script.js"></script>
<script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
</head>
<body class="bg-img img-fluid" style="align-items: center; justify-content: center; text-align: center;">
<div class="card-login" style="width: 550px; height: auto; align-items: center; padding: 15px 0 15px 0;">
<div class="card-body">
<h3 style="font-weight: bold;">Wycisz użytkownika</h3>
<p>Wycisz jakąkolwiek osobe na viddle</p><br>
<form method="post">
<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
<input type="text" name="id" class="form-control" placeholder="id użytkownika" aria-label="Id filmu" aria-describedby="material-addon1">
</div>
  <div class="md-form input-group mb-3" style="margin: auto; width: 100%">
<input type="text" name="h" class="form-control" placeholder="Czas wyciszenia (w godzinach)" aria-label="Czas wyciszenia (w godzinach)" aria-describedby="material-addon1">
</div>
<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
<input type="text" name="uzasadnienie" class="form-control" placeholder="uzasadnienie" aria-label="uzasadnienie" aria-describedby="material-addon1">
</div><br>
<center>
<div class="container row" style="justify-content: center;">
<input type="submit" value="Wycisz użytkownika" name="wycisz" class="btn btn-success" style="padding: 10px; color: white;"><br>
 <?php echo $say ?>
</form>
</div>
</center>
</div>
</div><br>
</body>
</html>
