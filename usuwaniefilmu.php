<?php session_start();
require 'danesql.php';
$connect =  new MYSQLI(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$uid = $_SESSION['uid'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include 'vendor/autoload.php';

$check = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid' AND uprawnienia NOT LIKE '0'");
$c = $cheack->num_rows;
if($c == '0') {
  header('location: /');
  exit;
}

if(isset($_POST['usun'])) {
  $ok = true;
  $vid = $_POST['id'];
  if($res = $connect->query("SELECT * FROM viddle_videos WHERE video_id='$vid'")) {
      $il = $res->num_rows;
      if($il == '0') {
        $say = 'Złe id';
      } else {
        if(!empty($_POST['uzasadnienie'])) {
            $info = $res->fetch_assoc();
          
            require 'daneftp.php';
							$ftp_conn =  ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
							$login =  ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
          ftp_chdir($ftp_conn, '/videos/'.$vid);
          ftp_delete($ftp_conn, $info['fname']);
          if($info['minname'] == 'x' || $info['minname'] == 'X') {
            
          } else {
            ftp_delete($ftp_conn, $vid.'m.'.$info['minname']);
          }
           ftp_chdir($ftp_conn, '/videos/');
          ftp_rmdir($ftp_conn, $vid);
          ftp_close($ftp_conn);
          $uidII = $info['publisher'];
          $u = $connect->query("SELECT * FROM viddle_users WHERE uid='$uidII'");
          $user = $u->fetch_assoc();
          
          $warnings = $user['warnings'] + '1';
          $data = date('Y-m-d', strtotime($data . "+3 months") );

          require("danemail.php");

// Instantiation and passing `true` enables exceptions
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
    $mail->addAddress($user['email']);     // Add a recipient
  


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
            <h1><i class="fas fa-bomb" style="margin-right: 5px;"></i> Otrzymałeś/aś ostrzeżenie na Viddle.</h1>
        </div>
        <div id="body">
            <div id="text-container">
                <p>
                    Witaj, <b>'.$user['login'].'</b><br><br>
                    Film o nazwie <b>'.$info['title'].'</b> został usunięty z Viddle, a na Twój kanał zostało nałożone ostrzeżenie.<br>
                    Uzasadnienie: '.$_POST['uzasadnienie'].'<br><br>
                    Ostrzeżenie wygaśnie <b>'.$data.'.</b> Do czasu wygaśnięcia ostrzeżenia na Twój kanał mogą zostać nałożone restrykcje.<br><br>
                    Obecnie posiadasz '.$warnings.' ostrzeżenie/nia. Jeśli na twój kanał w przeciągu 3 miesięcy od nałożenia 1. ostrzeżenia zostaną nałożone 3 ostrzeżenia to twoje konto zostanie zamknięte. <br><br>
                    Pozdrawiamy,<br>
                    Viddle Developers
                </p>
                <br><hr>
                <p style="text-align: center; font-size: small;">
                    Wiadomość została wygenerowana automatycznie. Nie odpowiadaj na nią, w przeciwnym razie Twoje zapytanie trafi do niemonitorowanej skrzynki mailowej.
                </p>
            </div>
        </div>
    </body>
</html>';
	
	
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Dostałeś ostrzeżenie na viddle';
    $mail->Body    = $body;
    $uz = $_POST['uzasadnienie'];

    if($mail->send()) {
        $ol = $connect->query("INSERT INTO `viddle_warnings` VALUES (NULL, '$uidII', '$vid', '$uz', '$data')");
        $olII = $connect->query("DELETE FROM `viddle_videos` WHERE `video_id`='$vid'");
        $olIII = $connect->query("UPDATE `viddle_users` SET `warnings`='$warnings' WHERE `uid`='$uidII'");
      
       $say = 'film usunięty';
    }
          
        } else {
          $say = 'brak uzasadnienia';
        }
      }
  }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Zaloguj się do Viddle</title>
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
				<h3 style="font-weight: bold;">Usuwanie filmu z viddle</h3>
				<p>Usuń film z viddle</p><br>
                <form method="post">
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text" name="id" class="form-control" placeholder="id filmu" aria-label="Id filmu" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text" name="uzasadnienie" class="form-control" placeholder="uzasadnienie" aria-label="uzasadnienie" aria-describedby="material-addon1">
				</div><br>
				<center>
				<div class="container row" style="justify-content: center;">
				<input type="submit" value="Usuń film" name="usun" class="btn btn-success" style="padding: 10px; color: white;">
          <?php echo $err ?>
                </form>
				</div>
				<p style="margin: 15px 0 0 0;">Zapomniałeś hasła? <a href="preset.php" class="resetpass">Wyślij prośbę o zresetowanie.</a></p>
				</center>
			</div>
			</div><br>
	</body>
</html>
