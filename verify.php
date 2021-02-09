<?php

session_start();

$id = $_GET['id'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query(
	sprintf("SELECT * FROM viddle_ver WHERE vid='%s'",
	mysqli_real_escape_string($connect,$id))))
  {
    $d2 = $result->num_rows;
    
    if($d2 == '0')
    {
      $exist = '0';
    }
    
    if($d2 == '1')
    {
      $dane = $result->fetch_assoc();
      $exist = '1';
	$uid = $dane['uid'];
      
      $pytanie = "UPDATE viddle_users SET emailver='1' WHERE uid='$uid'";
      
      if($connect->query($pytanie))
      {
        $p = "DELETE FROM viddle_ver WHERE ver='$id'";
        
        if($connect->query($p)) {
			
		}
        
      }
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
		<title>Weryfikowanie adresu e-mail</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
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
                                <div id="main">
                                <?php if($exist == '1') { ?>
				<h3 style="font-weight: bold;">Dziękujemy!</h3>
				<p>Twój adres e-mail został pomyślnie zweryfikowany!</p><br>
				
                
					<a href="index.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Strona główna</p></button></a>
          <?php } else { ?>
          <h3 style="font-weight: bold;">Upsss ... coś poszło nie tak</h3>
				<p>Na adres e-mail <?php echo $email ?>Link w który weszedłeś został już wykorzystany do weryfikacji adresu e-mail lub jest on nieprawidłowy. Jeśli wpisywałeś link ręcznie to upewnij się czy jest on prawidłowy</p><br>
				<?php } ?>
        </div>
				</div>
				</center>
			</div>
			</div><br>
	</body>
</html>

