<?php

session_start();

if(isset($_SESSION['zhaslo']))
{
      session_unset($_SESSION['zhaslo']);
      $kwestia = '1';
      
}
else
{
      $kwestia = '0';
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
    <?php if($kwestia == '1') { ?>
		<title>Dziękujemy!</title>
    <?php } else { ?>
    <title>Coś poszło nie tak</title>
    <?php } ?>
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
		<link rel="stylesheet" href="style.css">
		<meta property="og:title" content="Viddle">
		<meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą VDP.">
		<script src="script.js"></script>
		<script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
		<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	</head>
	<body class="bg-img img-fluid" style="align-items: center; justify-content: center; text-align: center;">
			<div class="card-login" style="width: 550px; height: auto; align-items: center; padding: 15px 0 15px 0;">
				<div class="card-body">
        <?php if($kwestia == '1') { ?>
                                <div id="main">
				<h3 style="font-weight: bold;">Hasło zostało zresetowane.</h3>
				<p>Możesz się już zalogować z użyciem nowego hasła.</p><br>
				
                
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">powrót do logowania</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
      <?php } else { ?>
                             <div id="main">
				<h3 style="font-weight: bold;">Coś poszło nie tak.</h3>
				<p>Link do zresetowania hasła jest niepoprawny. Prawdopodobnie wygasł lub został nieprawidłowo wpisany.</p><br>
				
                
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">powrót do logowania</p></button></a>
				</div>
				</div>
				</center>
			</div>
			</div><br>
      <?php } ?>
	</body>
</html>
