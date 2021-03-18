<?php
session_start();
$id = $_GET['id'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
	sprintf("SELECT * FROM viddle_ver WHERE vid2='%s'",
	mysqli_real_escape_string($connect,$id))))
  {
    $d2 = $result->num_rows;
    
    if($d2 == '0')
    {
      header('location: index.php');
    }
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
		<title>Zweryfikuj swój adres e-mail</title>
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
				<h3 style="font-weight: bold;">Weryfikacja adresu e-mail</h3>
				<p>
					Na adres e-mail (<?php echo $_SESSION['email'] ?>) wysłaliśmy link do jego weryfikacji.
					Sprawdź swoją skrzynkę i kliknij w link, który Tobie wysłaliśmy.<br>
					Mail nie dotarł? Możliwe, że trafił on do folderu, gdzie przechowywany jest spam.
				</p><br>
					<a href="index.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Strona główna</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
