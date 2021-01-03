<?php

session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


$e1_err = '';
$e2_err = '';

if (isset($_POST['email']))
{
	$ok = '2';
	
	$secret = '0x2e38D68c01a7AAa01905f1471631C6b59e47300A';
        $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success)
        {
            
        }
        else
        {
            $ok=false;
		$e1_err = "<div class='alert alert-danger' role='alert'>Nie zaznaczono pola captcha.</div>";
        }
	
	require("danesql.php");
        $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
	
	 if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE email='%s'", mysqli_real_escape_string($connect,$_POST['email']))))
		 
	$d2 = $result->num_rows;
	
	if($d2 == '0')
	{
		$ok=false;
		$e2_err = "<div class='alert alert-danger' role='alert'>Na podany adres e-mail nie jest zarejestrowane żadne konto.</div>";
	}
	
	if($ok == '2')
	{
		echo 'poszło';
		$k1 = rand(10000,99999);
		$k2 = rand(10000,99999);
		$email = $_POST['email'];
		if ($connect->query("INSERT INTO viddle_passreset VALUES (NULL, '$email', '$k1', '$k2')"))
		{


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8'; // Send using SMTP
    $mail->Host       = 'smtppro.zoho.eu';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'support@viddle.xyz';                     // SMTP username
    $mail->Password   = 'b33@tbKz2fkTXxV';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('support@viddle.xyz', 'viddle');
    $mail->addAddress($_POST['email']);     // Add a recipient
  
  $body = '<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <script src="https://kit.fontawesome.com/ca8376a2f4.js" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Roboto');

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

            a {
                text-decoration: none;
                color: white;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <h1><i class="fas fa-key" style="margin-right: 5px;"></i> Resetowanie hasła</h1>
        </div>
        <div id="body">
            <div id="text-container">
                <p>
                    Witaj, <b>[placeholder dla nazwy użytkownika].</b><br><br>
                    Otrzymaliśmy żądanie zmiany hasła dla konta powiązanego z adresem e-mail <b>[placeholder dla adresu e-mail]</b>.<br><br>
                    Hasło możesz zresetować, klikając <a href="https://beta.viddle.xyz/resetinfo.php?resetkey=klucz">tutaj.</a><br><br>
                    Jeżeli to nie Ty prosiłeś o zmianę hasła, możesz zignorować tego maila. Żeby zapobiec zmianie hasła poprzez 
                    nieuprawiony dostęp do Twojej skrzynki, zmień do niej hasło na silniejsze.<br><br>
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
    $mail->Subject = 'Resetowanie hasła';
    $mail->Body    = $body;
   

    $mail->send();
    echo 'Message has been sent';
	header('Location: resetinfo.php?id='.$k2.'');


	}
	else
	{
		$e2_err = '<div class="alert alert-danger" role="alert">
				Wystąpił nieoczekiwany błąd, skontaktuj się z supportem viddle
		  	</div>';
	}
						}
}
			
			
	
	
	
echo $ok;
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="https://hcaptcha.com/1/api.js" async defer></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<style>
		body {
			background: rgb(30,0,59);
			background: linear-gradient(90deg, rgba(30,0,59,1) 0%, rgba(9,34,121,1) 35%, rgba(154,0,255,1) 100%);
		}
		</style>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Zaloguj się do Viddle</title>
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
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
					<?php
			echo $e1_err;
			echo $e2_err;
		?>
				<h3 style="font-weight: bold;">Resetowanie hasła do konta Viddle</h3>
				<p>w celu zresetowania hasła, wyślemy na adres e-mail twojego konta e-maila z linkiem do resetowania hasła</p><br>
				<?php


				?>

                <form method="post">

				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="email"name="email" class="form-control" placeholder="Adres e-mail konta" aria-label="Adres e-mail konta" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					
				</div><br>
			<center>
                <div class="h-captcha" data-sitekey="f982278b-3800-454e-84a8-f08f6956fd44"></div>
				<div class="container row" style="justify-content: center;">
				<center>
					</div>
				<div class="container row" style="justify-content: center;">
				<input type="submit" value="Wyślij e-maila" class="btn btn-success" style="padding: 10px; color: white;">

                </form>

				</div>

				</center>
			</div>
			</div><br>
	</body>
</html>
