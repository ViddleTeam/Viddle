<?php
session_start();
if ($_SESSION['z1'] == true) {
  $_SESSION['z1'] = false;  
  session_destroy();
$_SESSION['uid'] = false;
session_destroy();

} else {
  header('Location: index.php');
}
?>
<!DOCTYPE HTML>

<html>
	<head>
	<style>
	body {
		background: rgb(30,0,59);
		background: linear-gradient(90deg, rgba(30,0,59,1) 0%, rgba(9,34,121,1) 35%, rgba(154,0,255,1) 100%);
	}
	</style>
		
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='assets/logoutredirect.js'></script>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Pomyślnie wylogowano</title>
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
                                <div id="main">
				<h3 style="font-weight: bold;">Wylogowano ciebie z konta.</h3>
				<p>Zostałeś wylogowany z twojego konta, za chwilę wrócisz do Viddle.</p><br>
				
                
					<a href="index.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Wróć</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
