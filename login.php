<?php
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}

if($res = $connect->query("SELECT * FROM `viddle_device` WHERE ip='$ip'")) {
    $il = $res->num_rows;
    
    if($il == '1' || !isset($_SESSION['z1'])) {
        $dip = $res->fetch_assoc();
        $uid = $dip['uid'];
        if($resII = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid'")) {
            $dipII = $resII->fetch_assoc();
            $_SESSION['user'] = $dipII['login'];
            $_SESSION['z1'] = true;
		header('location: index.php');
        }
       
}
}

session_start();
if ($_SESSION['z1'] == true) {
	header('location: index.php');
	exit;
}
$error = '';
	if (isset($_POST['login'])) {
        $ok = true;
            
            $login = $_POST['login'];
	    $haslo = $_POST['haslo'];
            if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))
            $d2 = $result->num_rows;
		$dane = $result->fetch_assoc();
		
			if(isset($d2) && $d2 == '1') {
				
				if (password_verify($haslo, $dane['password']))
				{
					if(isset($_POST['save'])) {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $ip = $_SERVER['REMOTE_ADDR'];
			}
			$uid = $dane['uid'];
			if($connect->query("INSERT INTO `viddle_device` VALUES (NULL, '$ip', '$uid')")) {
				//dziala
			} else {
				exit();
				echo 'error';
			}
		}
                    $_SESSION['z1'] = true;
                    
                    $_SESSION['user'] = $dane['login'];
		    $_SESSION['uid'] = $dane['uid'];
					
					if(!isset($_SESSION['przek'])) {
						$_SESSION['przek'] = 'index.php';
					}
                    header('Location: '.$_SESSION['przek'].'');
                } else {
            $error = '<div class="alert alert-danger" role="alert">
				Nazwa użytkownika lub hasło jest nieprawidłowe.
		  	</div>';
                }
            } else {
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
		body {
			background: rgb(30,0,59);
			background: linear-gradient(90deg, rgba(30,0,59,1) 0%, rgba(9,34,121,1) 35%, rgba(154,0,255,1) 100%);
		}
		</style>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Zaloguj się do Viddle</title>
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
				<h3 style="font-weight: bold;">Zaloguj się do Viddle</h3>
				<p>Miło Ciebie znowu widzieć!</p><br>
				<?php echo $error; ?>
                <form method="post">
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text"name="login" class="form-control" placeholder="Nazwa użytkownika" aria-label="Nazwa użytkownika" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="haslo" class="form-control" placeholder="Hasło" aria-label="Hasło" aria-describedby="material-addon1">
				</div><br>
				<center>
					<input type="checkbox" name="save" />Nie wylogowywuj mnie z tego urządzenia (beta)
				<div class="container row" style="justify-content: center;">
				<input type="submit" value="Zaloguj się" class="btn btn-success" style="padding: 10px; color: white;">
                </form>
					<a href="register.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Zarejestruj się</p></button></a>
				</div>
				<p style="margin: 15px 0 0 0;">Zapomniałeś hasła? <a href="preset.php">Wyślij prośbę o zresetowanie.</a></p>
				</center>
			</div>
			</div><br>
	</body>
</html>
