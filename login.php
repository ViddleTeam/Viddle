<?php

session_start();

$error = '';
	if (isset($_POST['login']))
	{
        $ok = true;
            require "danesql.php";
            $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

            $login = $_POST['login'];
		    $haslo = $_POST['haslo'];

            if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))

            $d2 = $result->num_rows;
			if(isset($d2) && $d2 == '1')
			{
				$dane = $result->fetch_assoc();
				
				if (password_verify($haslo, $dane['password']))
				{
                    $_SESSION['z1'] = true;
                    
                    $_SESSION['user'] = $dane['login'];
                    header('Location: index.php');
                }
                else
                {
                    
            $error = '<div class="alert alert-danger" role="alert">
				Nazwa użytkownika lub hasło jest nieprawidłowe.
		  	</div>';

                }
            }
            else
            {
                
            $error = '<div class="alert alert-danger" role="alert">
				Nazwa użytkownika lub hasło jest nieprawidłowe.
		  	</div>';
            }

    }
?>
<!DOCTYPE html>
<html>
	<head>
		<style>
		@-webkit-keyframes autofill {
		to {
		color: #666;
		background: transparent; } }

		@keyframes autofill {
		to {
		color: #666;
		background: transparent; } }

		input:-webkit-autofill {
		-webkit-animation-name: autofill;
		animation-name: autofill;
		-webkit-animation-fill-mode: both;
		animation-fill-mode: both; 
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
				<h3 style="font-weight: bold;">Zaloguj się do Viddle</h3>
				<p>Miło Ciebie znowu widzieć!</p><br>
				<?php

				echo $error;	

				?>

                <form method="post">

				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text"name="login" class="form-control" placeholder="Nazwa użytkownika" aria-label="Nazwa użytkownika" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="haslo" class="form-control" placeholder="Hasło" aria-label="Hasło" aria-describedby="material-addon1">
				</div><br>
				<center>
				<div class="container row" style="justify-content: center;">
				<input type="submit" value="Zaloguj się" class="btn btn-success" style="padding: 10px; color: white;">

                </form>
					<a href="register.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Zarejestruj się</p></button></a>
				</div>
				<p style="margin: 15px 0 0 0;">Zapomniałeś hasła? <a>Wyślij prośbę o zresetowanie.</a></p>
				</center>
			</div>
			</div><br>
	</body>
</html>
