<?php
session_start();




require 'danesql.php';
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  
  if ($connect->connect_errno!=0)
	{
				echo '<span style="color: red;">Wystąpił nieoczekiwany błąd! <br> Skontaktuj się z supportem i podaj ten kod:'.$connect->connect_errno.'</span>';
	} else {
	  $uid = $_SESSION['uid'];
	 $result = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid' AND emailver='0'");
	  
	  $d2 = $result->num_rows;
	  echo '1';
	  if($d2 == '1') {
		  $los = rand(100000,999999);
		  $los2 = rand(100000,999999);

		 $dane = $result->fetch_assoc();
		  
		 require("danemail.php");
		 
		  
		 $beka = $connect->query("INSERN INTO viddle_ver VALUES (NULL, '$los', '$losII', '$uid'");


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
    $mail->isSMTP(); 
    $mail->CharSet = 'UTF-8'; // Send using SMTP
    $mail->Host       = MAILHOST;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = MAILUSER;                     // SMTP username
    $mail->Password   = MAILPASS;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = MAILPORT;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom(MAILUSER, MAILNAME);
    $mail->addAddress($dane['email']);     // Add a recipient
  


			$body = '<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <script src="https://kit.fontawesome.com/ca8376a2f4.js" crossorigin="anonymous"></script>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Roboto");

            * {
                font-family: Roboto;
                color: white;
            }

            #header {
                padding: 10px;
                background-color: #313539;
                text-align: center;
            }

            #body {
                padding: 10px;
                background-color: #212529;
                justify-content: center;
            }

            #text-container {
                padding-left: 10%;
                padding-right: 10%;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <h1><i class="fas fa-envelope" style="margin-right: 5px;"></i> Zweryfikuj swojego maila!</h1>
        </div>
        <div id="body">
            <div id="text-container">
                <p>
                    Witaj, <b>'.$dane['login'].'!</b><br><br>
                    Dziękujemy za rejestrację konta w serwisie Viddle!<br>
                    Chcemy sprawdzić, czy to ty rzeczywiście się rejestrujesz, a nie ktoś niepowołany czy bot.<br><br>
                    Kliknij w <a href="verify.php?id='.$los.'"><b>ten link</b></a>, żeby potwierdzić twoją rejestrację. Jeżeli to nie ty - zignoruj tą wiadomość i dla bezpieczeństwa ustaw silniejsze hasło do skrzynki mailowej.<br><br>
                    Pozdrawiamy,<br>
                    Viddle Developers
                </p>
                <br><hr>
                <p style="text-align: center; font-size: small;">
                    Wiadomość została wygenerowana automatycznie. Nie odpowiadaj na nią, w przeciwnym razie Twoje zapytanie trafi do niemonitorowanej skrzynki mailowej.
                </p>
            </div>
        </div>
    </body>
</html>';
	
	
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Weryfikacja adresu e-mail';
    $mail->Body    = $body;
   

    $mail->send();
    header('Location: vinfo.php?id='.$los2.'');


	
		  
		  
	  } else {
		  
	  }
  	}
  



?>

