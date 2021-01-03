<?php

session_start();

$id = $_GET['id'];

 require "danesql.php";
 $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_passreset WHERE rid='%s'",
		    mysqli_real_escape_string($connect,$id))))

$d2 = $result->num_rows;

if(!$_POST['haslo'] == '')
{
	$dane = $result->fetch_assoc();
	
	$email = $dane['email'];
	
	$ok = true;
	
	if (strlen($_POST['haslo']) < '8') {
		$ok = false;
		$p_error = "<div class='alert alert-danger' role='alert'>Hasło musi składać się z przynajmniej 8 znaków.</div>";
	}
	
	if (!$_POST['haslo'] == $_POST['haslo2'])
	{
		$ok = false;
		$rp_error = "<div class='alert alert-danger' role='alert'>Hasła się nie zgadzają.</div>";
	}
	
	if ($password == "12345678" || $password == "abcdefgh" || !preg_match("#.*^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {
		$ok = false;
		$easypass_error = "<div class='alert alert-danger' role='alert'>Hasło, które ustaliłeś, może ułatwić włamanie się na Twoje konto. Ustal silniejsze hasło!</div>";
	}
	
	if ($result2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE email='%s'",
		    mysqli_real_escape_string($connect,$email))))
		
        $dane2 = $result2->fetch_assoc();
	
	
	
	if (password_verify($_POST['haslo2'], $dane2['password']))
	{
		$ok = false;
		$p2_error = "<div class='alert alert-danger' role='alert'>To hasło jest takie same jak te które aktualnie jest ustawione!</div>";
	}
	
	if($ok == true)
	{
		 if ($result = @$connect->query(sprintf("UPDATE viddle_users SET password='%s' WHERE email='%s'", mysqli_real_escape_string($connect,$_POST['haslo2']), mysqli_real_escape_string($connect,$email))))
		 {
			 $_SESSION['zhaslo'] = true;
			 
			 if ($result = @$connect->query(sprintf("DELETE FROM viddle_passreset WHERE rid='%s';", mysqli_real_escape_string($connect,$id))))
			 {
				 header('Location: freset.php');
			 }
		 }
}
}
?>

<!DOCTYPE html>
<html>
	<head>
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
		    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
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
					<?php if($d2 == '1')
					      { ?>
				<h3 style="font-weight: bold;">Resetowanie hasła</h3>
				<p>Już dzielą cie ostatnie kroki by zmienić hasło !!!</p><br>
				<?php
				echo $p_error;	
				echo $rp_error;
				echo $easypass_error;
				echo $p2_error;
				?>

                <form method="post">

				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="haslo" class="form-control" placeholder="Nowe hasło" aria-label="Nowe hasło" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="haslo2" class="form-control" placeholder="Powtórz hasło" aria-label="Powtórz hasło" aria-describedby="material-addon1">
				</div><br>
				<center>
				<div class="container row" style="justify-content: center;">
				<input type="submit" value="Zmień hasło" class="btn btn-success" style="padding: 10px; color: white;">

                </form>
					
				</div>
				
				</center>
			</div>
			</div><br>
	</body>
</html>
<?php
}
else
{
	?>
	<h3 style="font-weight: bold;">Upsss ... coś poszło nie tak</h3>
				<p></p>Najwidoczniej ktoś już skorzystał z tego linku do zresetowania hasła lub jest on niepoprawny. Jeśli wpisywałeś link ręcznie to upewnij się że jest on prawidłowy<br>
				
	</body>
</html>
<?php
}
	?>

