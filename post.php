<script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
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
  if (is_uploaded_file($_FILES['videovid']['tmp_name'])) {
	  $login = $_SESSION['user'];
	  $filename = $_FILES["videovid"]["name"];
	  $file_basename = substr($filename, 0, strripos($filename, '.'));
	  $file_ext = mime_content_type($_FILES["videovid"]["tmp_name"]);
	  $filesize = $_FILES["videovid"]["size"];
	  $allowed_file_types = ['video/mp4','video/mov','video/webm','video/x-ms-wmv','video/3gpp'];	
	  define('MB', 1048576);
	  define('GB', 1073741824);
	  function ext($mime_type){
	    $extensions = array('video/mp4' => '.mp4',
                          'video/mov' => '.mov',
			  'video/webm' => '.webm',
			  'video/x-ms-wmv' => '.wmv',
			  'video/3gpp' => '.3gpp',
                          );
    	    return $extensions[$mime_type];
	  }
	  require "danesql.php";
  	  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
	  $zabezpjeden = mysqli_real_escape_string($connect, htmlspecialchars($login));
  	  $zabezpdwa = mysqli_real_escape_string($connect, htmlspecialchars($tytul));
  	  $zabezptrzy = mysqli_real_escape_string($connect, htmlspecialchars($opis));
	  $result = $connect -> query("SELECT * FROM `viddle_users` WHERE login='$login';");
          $dane = $result -> fetch_assoc();
          $userid = $dane['uid'];
	  $name = $dane['login'];
	  $result = $connect -> query("SELECT * FROM `viddle_recent` WHERE number=1;");
	  $row = $result -> fetch_assoc();
	  $result = $connect -> query("SELECT * FROM viddle_videos WHERE uid='$userid';");
	  $il = $result -> num_rows;
	  if($row['viddle_recent_one_user'] === $userid) {
		header('Location: blad.php?id=4');
		exit;
	  }
	  $test = ext($file_ext);
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
	  $newfilename = $viddleid . $test;
	  if($error==2) {
	    header('Location: blad.php?id=1');
	  }
	  
	  if(isset($_FILES['miniaturka'])) {
		  $ok = true;
		  
		$file_name = $_FILES['miniaturka']['name'];
      		$file_size =$_FILES['miniaturka']['size'];
      		$file_tmp =$_FILES['miniaturka']['tmp_name'];
      		$file_type=$_FILES['miniaturka']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['miniaturka']['name'])));
		  
		 if($file_type == 'image/png') {
		$f = '1';
		$t = 'png';	
		}

		if($file_type == 'image/jpg') {
			$f = '1';
			$t = 'jpg';	
		}

		if($file_type == 'image/jpeg') {
			$f = '1';
			$t = 'jpeg';	
		}

		if($file_type == 'image/bmp') {
			$f = '1';
			$t = 'bmp';	
		}

		 if($f == '0') {
			$_SESSION['error'] = 'niedozwolony format';
			header('location: upload.php');
			exit();
		 }
		  
		 if($file_size > 3097152){
         		$_SESSION['error'] = 'plik za wielki!';
			$ok = false;
			header('location: upload.php');
			exit();
	 	}
		 
		 if($ok == true) {
			 require 'daneftp.php';
	
			$ftp_server = FTPSERWER;
			$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			$login = ftp_login($ftp_conn, FTPUSER, FTPPASS);
			 
			ftp_chdir($ftp_conn, '/thumbnails/');
			ftp_mkdir($ftp_conn, $viddleid);
			ftp_chdir($ftp_conn, '/thumbnails/'.$viddleid.'');
			ftp_put($ftp_conn, $viddleid.'.'.$t, $file_tmp, FTP_BINARY);
			ftp_close($ftp_conn);
		 }
	  } else {
		 $t = 'x';
	  }
	  
	  if (in_array($file_ext, $allowed_file_types) && ($filesize < 1*GB))
	  {	
	    $conn_id = ftp_connect("ftp.oliwierj.webd.pro") or die("Nie można się połączyć z serwerem. SKONTAKTUJ się z administratorami.");
	    $login_result = ftp_login($conn_id, "cdn_viddle@viddle.xyz", "uaX9WprQfEO}");
	    $res = ftp_size($conn_id, $file);
	    $sciezka = "/videos/";
	    if ($res != -1) {
	      echo "Plik już istnieje.";
	      //header('Location: blad.php?id=4');
	    } else {
	      ftp_chdir($conn_id, '/videos/');
	      ftp_mkdir($conn_id, $viddleid);
	      ftp_chdir($conn_id, '/videos/' . $viddleid . '/');
	      ftp_put($conn_id, $newfilename, $_FILES["videovid"]["tmp_name"], FTP_BINARY); 
	      //echo "Wrzucono film.";
	      $uplsuccess = 1;
	      ftp_close($conn_id);
	    }
	  } elseif (empty($file_basename)) {	
			// file selection error
			//echo "Podaj nazwę pliku do wrzucenia!";
			//header('Location: index.php');
		  	$uplsuccess = 0;
	  } elseif ($filesize > 1*GB) {	
			// file size error
			//echo "Plik jest zbyt duży!";
			header('Location: index.php');
		  	$uplsuccess = 0;
	  } else {
			// file type error
			//echo "Tylko te pliki są akceptowalne: ";
			//unlink($_FILES["videovid"]["tmp_name"]);
			header('Location: index.php');
		  	$uplsuccess = 0;
	  }
	  if (!$upload) { 
		  header('Location: blad.php?id=3');
		  $uplsuccess = 0;
	  }
	  if ($uplsuccess == 0) {
		header('Location: index.php');
	  }
	  $viddlepath = $viddleid;
	  $viddlepath .= ".mp4";
	  $data = date("Y-m-d H:i:s");
	  if (!in_array($file_ext, $allowed_file_types)) {
            header('Location: index.php');
    	  }
	  
	  
	  $uid = $_SESSION['uid'];
	  
	  $result = $connect->query("SELECT * FROM viddle_videos WHERE publisher='$uid'");
	  
	  $wstaw = $result->num_rows + '1';
	  
	  if (in_array($file_ext, $allowed_file_types) && ($filesize < 1*GB))
	  {
	  //$success = $connect->query("INSERT INTO viddle_videos VALUES (0, '$wstaw', '$userid', 123454321, '$viddleid', 0, 0, 0, 0, '$newfilename', '$zabezpdwa', '$zabezptrzy', '$t', '$data')");
	  	if ($success = @$connect->query(
		    sprintf("INSERT INTO viddle_videos VALUES (0, '%s', '%s', 123454321, '%s', 0, 0, 0, 0, '%s', '%s', '%s', '%s', '%s'",
		    mysqli_real_escape_string($connect,$wstaw),
		    mysqli_real_escape_string($connect,$userid),
		    mysqli_real_escape_string($connect,$viddleid),
	            mysqli_real_escape_string($connect,$newfilename),
		    mysqli_real_escape_string($connect,$zabezpdwa),
	            mysqli_real_escape_string($connect,$zabezptrzy),
	            mysqli_real_escape_string($connect,$t),
	            mysqli_real_escape_string($connect,$data))))
	  }
	  if ($success) {
	     $successtwo = $connect->query("UPDATE viddle_recent SET viddle_recent_three_user=viddle_recent_two_user,viddle_recent_three_id=viddle_recent_two_id,viddle_recent_two_user=viddle_recent_one_user,viddle_recent_two_id=viddle_recent_one_id,viddle_recent_one_user='$userid',viddle_recent_one_id='$viddleid' WHERE number = 1;");
	     header('Location: video.php?id=' . $viddleid);
	  } else {
	     header('Location: blad.php?id=2');
	  }
	/*  $destination = fopen("ftp://epiz_27397310:YPf7vgDQu3JpVm@ftpupload.net/" . $film, "wb");
	  $source = file_get_contents($film);
	  fwrite($destination, $source, strlen($source)); */
  } else {
    header('Location: blad.php?id=5');
    //echo('brak pliku');
  }
} else {
//header('Location: index.php');
echo('ERROR 4 - Nie jesteś zalogowany.');
}
echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
/*header('Location: blad.php?id=404');*/
?>
