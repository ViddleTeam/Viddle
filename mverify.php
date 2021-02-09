<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(!isset($_SESSION['uid'])) {
header('location: index.php');
} else {
  require 'danesql.php';
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  
  if ($connect->connect_errno!=0)
	{
				echo '<span style="color: red;">Wystąpił nieoczekiwany błąd! <br> Skontaktuj się z supportem i podaj ten kod:'.$connect->connect_errno.'</span>';
        exit();
	} else {
	  $uid = $_SESSION['uid'];
	 $result = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid' AND emailver='0'");
	  
	  $d2 = $result->num_rows;
	  
	  if($d2 == '1') {
		 $dane = $result->fetch_assoc();
		  
		  
	  } else {
		  header('location: index.php');
	  }
  	}
  
  
}


?>

