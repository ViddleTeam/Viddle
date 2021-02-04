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
				<h3 style="font-weight: bold;">Konto zostało zablokowane!</h3>
				<p>Żeby je odblokować, należy poniżej wpisać kod, który otrzymasz 
				na swoją skrzynkę mailową po ręcznym zleceniu wysłania. Jego wysłanie
				możesz zlecić, poczynając od dnia [placeholder daty]. Do tego czasu zmień hasło 
				dostępowe do swojej skrzynki mailowej.</p><br>
                <form method="post">
				<div class="md-form input-group mb-3" style="margin: auto; width: 100%">
					<input type="text" name="kod" class="form-control" placeholder="Kod odblokowywujący" aria-label="Kod odblokowywujący" aria-describedby="material-addon1">
				</div>
                
                
				<div class="container row" style="justify-content: center;">
					<a href="#"><input type="submit" value="odblokuj konto" class="btn btn-success" style="padding: 10px;"></a>

                    </form>
					<a href="login.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Powrót do logowania</p></button></a>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>
