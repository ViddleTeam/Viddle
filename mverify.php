<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(!isset($_SESSION['uid'])) {
header('location: index.php');
} else {
  require 'danesql.php';
  $connect = new mysqli(SQLOST, SQLUSER, SQLPASS, DBNAME);
  
  if ($connect->connect_errno!=0)
	{
				echo '<span style="color: red;">Wystąpił nieoczekiwany błąd! <br> Skontaktuj się z supportem i podaj ten kod:'.$connect->connect_errno.'</span>';
        exit();
	} else {
  }
  
  
}


?>

