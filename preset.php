<?php

session_start();

$e1_err = '';
if (isset($_POST['email']))
{
	$ok = true;
	
	$email = $_POST['email'];
	
	require "danesql.php";
	
        $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
	
	
	 if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE email='%s'",
		    mysqli_real_escape_string($connect,$email))))
	
		$d2 = $result->num_rows;
		if($d2 == '0')
		{
			$ok = false;
			$e1_err = '<div class='alert alert-danger' role='alert'>Na ten adres e-mail nie zostało zarejestrowane żadne konto</div>';
		}
}		
			
			
	
	
	

?>

<!DOCTYPE html>
<html>
	<head>
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
		<?php
			echo $e1_err;
		?>
			<div class="card-login" style="width: 550px; height: auto; align-items: center; padding: 15px 0 15px 0;">
				<div class="card-body">
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
                <div class="g-recaptcha" data-sitekey="6LfI8fwZAAAAADtjXjsBIFjgpsQvk5ICt-8zKU0p"></div><br>
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
