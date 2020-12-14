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
	
	</style>
		<?php
			echo $do;
		?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src='assets/logoutredirect.js'></script>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Pomyślnie wylogowano</title>
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
                                <div id="main">
				<h3 style="font-weight: bold;">Zostałeś pomyślnie wylogowany!</h3>
				<p>Pomyślnie wylogowano z Viddle. Za chwilę zostaniesz przekierowany na stronę główną. Jeżeli nie chcesz czekać, kliknij przycisk poniżej.</p><br>
				
                
					<a href="index.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przejdź do strony głównej</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
