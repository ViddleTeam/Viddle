<?php

$id = $_GET['id'];

 require "danesql.php";
 $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_passreset WHERE rid='%s'",
		    mysqli_real_escape_string($connect,$id))))

$d2 = $result->num_rows;
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
				<h3 style="font-weight: bold;">Resetowanie hasła</h3>
				<p>Już dzielą cie ostatnie kroki by zmienić hasło !!!</p><br>
				<?php

				echo $error;	

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
				<p style="margin: 15px 0 0 0;">Zapomniałeś hasła? <a href="preset.php">Wyślij prośbę o zresetowanie.</a></p>
				</center>
			</div>
			</div><br>
	</body>
</html>

<!-- brak tokena -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Wystąpił błąd!</h5>
            </div>
            <div class="modal-body">
                Link do odzyskania hasła jest nieprawidłowy bądź jego ważność wygasła.
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Powrót na stronę główną</button></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
if ($d2 == '0') {
	echo "<script>
		$('#staticBackdrop').modal('show');
	</script>";
}
?>
