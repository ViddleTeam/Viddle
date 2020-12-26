<?php
$uplsuccess = 0;
if ($_POST['titlevid'] == false) {
    header('Location: index.php');
} else if ($_POST['descvid'] == false) {
    header('Location: index.php');
} else if ($_FILES['videovid'] == false) {
    header('Location: index.php');
}
session_start();
if ($_SESSION['z1'] == true) {
  $error = 0;
  $tytul = $_POST['titlevid'];
  $opis = $_POST['descvid'];
  $film = $_POST['videovid'];
  if (is_uploaded_file($_FILE['videovid']['tmp_name'])) {
	  $login = $_SESSION['user'];
	  $filename = $_FILES["videovid"]["name"];
	  $newfilename = $viddleid . $_FILES["videovid"]["type"];
	  $file_basename = substr($filename, 0, strripos($filename, '.'));
	  $file_ext = mime_content_type($_FILE['videovid']['tmp_name']);
	  $filesize = $_FILES["videovid"]["size"];
	  $allowed_file_types = ['video/mp4','video/mov','video/webm','video/x-ms-wmv','video/3gpp'];	
	  define('MB', 1048576);
	  require "danesql.php";
	  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
	  $viddleid = rand(1000000,9999999);
	  if ($result = @$connect->query(sprintf("SELECT * FROM viddle_video WHERE video_id='%s", mysqli_real_escape_string($connect,$viddleid))))
	  $d2 = $result->num_rows;
	  if (isset($d2) && $d2 >= '1') {
		$error = 1;
	  }
	  while($error == 1) {
		$viddleid = rand(1000000,9999999);
		if ($result = @$connect->query(sprintf("SELECT * FROM viddle_video WHERE video_id='%s", mysqli_real_escape_string($connect,$viddleid))))
		    $d2 = $result->num_rows;
		    if (isset($d2) && $d2 >= '1') {
		      $error = 1;
		    } else {
		      $error = 0;
		    }
		    if ($licznik>=100) {
		      $error = 2;
		    }
	  }

	  if($error==2) {
	    header('Location: blad.php?id=1');
	  }
	  if (in_array($file_ext, $allowed_file_types) && ($filesize < 10*MB))
	  {	
		$conn_id = ftp_connect("ftpupload.net") or die("Nie można się połączyć z serwerem. SKONTAKTUJ się z administratorami.");
		$login_result = ftp_login($conn_id, "epiz_27397310", "YPf7vgDQu3JpVm");
		$res = ftp_size($conn_id, $file);
		$sciezka = "/viddlecdn.ml/htdocs/videos/";
		if ($res != -1) {
		  echo "Plik już istnieje.";
		  //header('Location: blad.php?id=4');
		} else {
		  ftp_chdir($conn_id, '/viddlecdn.ml/htdocs/videos/');
		  ftp_put($conn_id, $newfilename, $_FILES["videovid"]["tmp_name"], FTP_BINARY); 
		  //echo "Wrzucono film.";
		  $uplsuccess = 1;
		  ftp_close($conn_id);
		}
	  } elseif (empty($file_basename)) {	
			// file selection error
			//echo "Podaj nazwę pliku do wrzucenia!";
			//header('Location: index.php');
	  } elseif ($filesize > 10*MB) {	
			// file size error
			//echo "Plik jest zbyt duży!";
			header('Location: index.php');
	  } else {
			// file type error
			//echo "Tylko te pliki są akceptowalne: ";
			//unlink($_FILES["videovid"]["tmp_name"]);
			header('Location: index.php');
	  }
	  if (!$upload) { 
		  header('Location: blad.php?id=3');
		  $uplsuccess = 0;
	  }
	  if ($uplsuccess != 1) {
		header('Location: index.php');
	  }
	  $viddlepath = $viddleid;
	  $viddlepath .= ".mp4";
	  $data = date("Y-m-d H:i:s");
	  $success = $connect->query("INSERT INTO viddle_videos VALUES ('$login', 123454321, '$viddleid', 0, 0, 0, 0, '$file_ext', '$tytul', '$opis', 'x', '$data')");
	  if ($success) {
	     header('Location: video.php?id=' . $viddleid);
	  } else {
	     header('Location: blad.php?id=2');
	  }
	/*  $destination = fopen("ftp://epiz_27397310:YPf7vgDQu3JpVm@ftpupload.net/" . $film, "wb");
	  $source = file_get_contents($film);
	  fwrite($destination, $source, strlen($source)); */
  } else {
    header('Location: index.php');
  }
} else {
//header('Location: index.php');
echo('ERROR 4 - Nie jesteś zalogowany.');
}
echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
?>
