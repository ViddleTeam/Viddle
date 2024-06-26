<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
include 'vendor/autoload.php';
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
	else
	{
		$dane = $result->fetch_assoc();
		
		$nickname = $dane['login'];
	}
	
	if($ok == '2')
	{
		$k1 = rand(10000,99999);
		$k2 = rand(10000,99999);
		$email = $_POST['email'];
		if ($connect->query("INSERT INTO viddle_passreset VALUES (NULL, '$email', '$k1', '$k2')"))
		{
			require("danemail.php");

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8';
    $mail->Host = MAILHOST;
    $mail->SMTPAuth = true;
    $mail->Username = MAILUSER;
    $mail->Password = MAILPASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = MAILPORT;
    //Recipients
    $mail->setFrom(MAILUSER, MAILNAME);
    $mail->addAddress($_POST['email']);
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
                    Witaj, <b>'.$nickname.'.</b><br><br>
                    Otrzymaliśmy żądanie zmiany hasła dla konta powiązanego z adresem e-mail <b>'.$_POST['email'].'</b>.<br><br>
                    Hasło możesz zresetować, klikając <a href="https://beta.viddle.xyz/reset.php?id='.$k1.'">tutaj.</a><br><br>
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
    $mail->isHTML(true);
    $mail->Subject = 'Resetowanie hasła';
    $mail->Body = $body;
    $mail->send();
    header('Location: resetinfo.php?id='.$k2.'');
	} else {
		$e2_err = '<div class="alert alert-danger" role="alert">
			Wystąpił nieoczekiwany błąd, skontaktuj się z supportem Viddle
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
					<?php
                        echo $e1_err;
                        echo $e2_err;
                    ?>
				<h3 style="font-weight: bold;">Resetowanie hasła do konta Viddle</h3>
				<p>W celu zresetowania hasła, wyślemy na adres e-mail twojego konta e-maila z linkiem do resetowania hasła.</p><br>
                <form method="post">

				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="email"name="email" class="form-control" placeholder="Adres e-mail konta" aria-label="Adres e-mail konta" aria-describedby="material-addon1">
				</div><br>
			    <center>
                    <div class="h-captcha" data-sitekey="f982278b-3800-454e-84a8-f08f6956fd44"></div>
                    <div class="container row" style="justify-content: center;">
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
