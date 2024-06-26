<?php
$password = $_POST['password'];
$email = $_POST['email'];
$repeat_passwd = $_POST['repeat_password'];
$c_error = '';
$login = $_POST['login'];
session_start();

function starts_with($string, $startString): bool
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

if (isset($login)){
    $ok = true;
    $e = true;
    $n = true;
    if ((strlen($login) < 4) || (strlen($login) > 24)) {
		$ok = false;
		$n_error = "<div class='alert alert-danger' role='alert'>Nazwa użytkownika powinna składać się z od 4 do 24 znaków.</div>";
        $n = false;
	}

	if (!isset($email)) {
		$ok = false;
		$e_error = "<div class='alert alert-danger' role='alert'>Podano nieprawidłowy adres email.</div>";
        $e = false;
	}

	if (strlen($password) < '8') {
		$ok = false;
		$p_error = "<div class='alert alert-danger' role='alert'>Hasło musi składać się z przynajmniej 8 znaków.</div>";
	}

	if ($repeat_passwd != $password) {
		$ok = false;
		$rp_error = "<div class='alert alert-danger' role='alert'>Hasła się nie zgadzają.</div>";
	}

	if (!preg_match("#.*^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {
		$ok = false;
		$easypass_error = "<div class='alert alert-danger' role='alert'>Twoje hasło powinno składać się z 1 małej i dużej litery, 1 cyfry i 1 znaku specjalnego oraz powinno być dłuższe niż 8 znaków.</div>";
	}
	$secret = '0x2e38D68c01a7AAa01905f1471631C6b59e47300A';
        $verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success) {
            
        } else {
            $ok=false;
		$c_error = "<div class='alert alert-danger' role='alert'>Nie zaznaczono pola captcha.</div>";
        }
        require("danesql.php");
            $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
			if ($connect->connect_errno!=0) {
				$ee_error = "<div class='alert alert-danger' role='alert'>Wystąpił błąd.</div>";
			} else {
            if ($e == true) {
                if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE email='%s'", mysqli_real_escape_string($connect,$email))))
				$d2 = $result->num_rows;
				if (isset($d2) && $d2 == '1') {
					$ok = false;
					$esql_error = "<div class='alert alert-danger' role='alert'>Adres e-mail, który wybrałeś, jest już zajęty.</div>";
				}
			}
            if ($n == true) {
                if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE login='%s'", mysqli_real_escape_string($connect,$login))))
				$d2 = $result->num_rows;
				if(isset($d2) && $d2 == '1') {
					$ok = false;
					$nsql_error = "<div class='alert alert-danger' role='alert'>Nazwa użytkownika, którą wybrałeś/aś, jest już zajęta.</div>";
				}
            }
            if (starts_with($login, '<') || starts_with($email, '<')) {
                $ok = false;
                $err_bracket = "<div class='alert alert-danger' role='alert'>Nazwa użytkownika, lub email rozpoczynają się nieprawidłowym znakiem.</div>";
            }
            if ($ok == true) {
                $haslo_h = password_hash($connect->real_escape_string($password), PASSWORD_DEFAULT);
                $login_e = $connect->real_escape_string($login);
                $email_e = $connect->real_escape_string($email);
                $uid = uniqid(uniqid());
                //$success = $connect->query("INSERT INTO viddle_users VALUES ('$login', '$haslo_h', , 1, 0, 0, 0, 0)");
                $success = $connect->query("INSERT INTO viddle_users VALUES ('$login_e', '$haslo_h', '$email_e', '$uid', 1, 0, 0, 0, 'x', 'x', NULL, 0, '0')");
                if ($success) {
                    $_SESSION['z'] = true;
                    header('Location: prejestracja.php');
                } else {
                    echo '<span style="color: red;">Error. '.$connect->connect_errno.'<br>Skontaktuj się z supportem</br></span>';
                }
            }
        }	
        $connect->close();	
}


?>
<!DOCTYPE HTML>
<html>
	
	<head>
		<script src="https://hcaptcha.com/1/api.js" async defer></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
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
			animation-fill-mode: both; }
		</style>
		<link rel="stylesheet" href="http://midacss.ml/assets/master.min.css" />
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Zarejestruj się w Viddle</title>
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
				<h3 style="font-weight: bold;">Zarejestruj się w Viddle</h3>
				<p>Dziękujemy za wybranie Viddle do udostępniania filmów! Podaj potrzebne dane, żeby zarejestrować nowe konto.</p><br>
				<?php 
					if (isset($n_error)) echo $n_error;
					if (isset($e_error)) echo $e_error;
					if (isset($p_error)) echo $p_error;
					if (isset($rp_error)) echo $rp_error;
					if (isset($c_error)) echo $c_error;
					if (isset($easypass_error)) echo $easypass_error;
                    if (isset($esql_error)) echo $esql_error;
                    if (isset($nsql_error)) echo $nsql_error;
                    if (isset($ee_error)) echo $ee_error;
                    if (isset($err_bracket)) echo $err_bracket;
				?>
                <form method="post">
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text" name="login" class="form-control" placeholder="Nazwa użytkownika" aria-label="Nazwa użytkownika" aria-describedby="material-addon1">
				</div>
                <div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="email" class="form-control" placeholder="Adres e-mail" name="email" aria-label="Adres e-mail" aria-describedby="material-addon1">
				</div>
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="password" class="form-control" placeholder="Hasło" name="haslo" aria-label="Hasło" aria-describedby="material-addon1">
				</div>

                <div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="password" name="repeat_password" class="form-control" placeholder="Powtórz hasło"name="haslo2" aria-label="Powtórz hasło" aria-describedby="material-addon1">
				</div><br>
				<center>
					<div class="h-captcha" data-sitekey="f982278b-3800-454e-84a8-f08f6956fd44"></div>
                
				<div class="container row" style="justify-content: center;">
					<a href="#"><input type="submit" value="Zarejestruj się" class="btn btn-success" style="padding: 10px;"></a>

                    </form>
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Powrót do logowania</p></button></a>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
