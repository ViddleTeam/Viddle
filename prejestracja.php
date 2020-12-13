<?php

session_start();

if (isset($_SESSION['z']))
	{
		unset($_SESSION['z']);
	}
	else
    {
		//header('Location: register.php');
		//exit();
	}


?>
<!DOCTYPE HTML>

<html>
	<head>
	<style>
	
	</style>
    <script src='https://www.google.com/recaptcha/api.js'></script>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Rejestracja przebiegła pomyślnie!</title>
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
		<link rel="stylesheet" href="style.css">
		<meta property="og:title" content="VDP - polska alternatywa dla YouTube">
		<meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą VDP.">
		<script src="script.js"></script>
		<script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
		<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	</head>
	<body class="bg-img img-fluid" style="align-items: center; justify-content: center; text-align: center;">
			<div class="card-login" style="width: 550px; height: auto; align-items: center; padding: 15px 0 15px 0;">
				<div class="card-body">
                                <div id="main">
				<h3 style="font-weight: bold;">Dziękujemy!</h3>
				<p>Twoje konto zostało zarejestrowane, życzymy powodzenia w rozwoju kanału na Viddle!</p><br>
				
                
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Zaloguj się</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>