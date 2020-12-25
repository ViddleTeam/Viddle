<?php
if ($_SESSION['z1'] == true) {
  $error = 0;
  if ($_POST['titlevid'] == false) {
    header('Location: index.php');
  } else if ($_POST['descvid'] == false) {
    header('Location: index.php');
  } else if ($_POST['videovid'] == false) {
    header('Location: index.php');
  }
  $tytul = $_POST['titlevid'];
  $opis = $_POST['descvid'];
  $film = $_POST['videovid'];
  
  $login = $_SESSION['user'];
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
  $viddlepath = $viddleid;
  $viddlepath .= ".mp4";
  $data = date("Y-m-d H:i:s");
  $success = $connect->query("INSERT INTO viddle_videos VALUES ('$login', 123454321, '$viddleid', 0, 0, 0, 0, '$viddlepath', '$tytul', '$opis', 'x', '$data')");
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
echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
?>
