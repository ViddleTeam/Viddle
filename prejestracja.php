<?php

session_start();

if (isset($_SESSION['z']))
	{
		unset($_SESSION['z']);
	}
	else
    {
		header('Location: register.php');
		exit();
	}


?>
<!DOCTYPE HTML>

<html>
	<head>
    <script src='https://www.google.com/recaptcha/api.js'></script>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Rejestracja przebiegła pomyślnie!</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
   		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
		<script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
		<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	</head>
	<body class="bg-img img-fluid" style="align-items: center; justify-content: center; text-align: center;">
			<div class="card-login" style="width: 550px; height: auto; align-items: center; padding: 15px 0 15px 0;">
				<div class="card-body">
                                <div id="main">
				<h3 style="font-weight: bold;">Dziękujemy!</h3>
				<p>
					Twoje konto zostało zarejestrowane - życzymy powodzenia w rozwoju kanału na Viddle!<br>
					Przed tym sprawdzimy, czy adres mailowy którego użyłeś do rejestracji jest prawidłowy i należy do Ciebie.
					Sprawdź skrzynkę mailową oraz zakładkę spamu.
				</p><br>
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Zaloguj się</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
