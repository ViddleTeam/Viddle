<?php session_start();
$id = $_GET['id'];
include 'danesql.php';
include 'daneftp.php';

if(!isset($_SESSION['uid'])) {
  header('location: index.php');
  exit();
}
$uid = $_SESSION['uid'];
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if($res = $connect->query("SELECT * FROM viddle_videos WHERE video_id='$id' AND publisher='$uid'")) {
  $dane = $res->fetch_assoc();
	$d2 = $res->num_rows;
  if($il == '1') {
    if($connect->query("DELETE * FROM viddle_videos WHERE video_id='$id'")) {
      $ftp_server = FTPSERWER;
			$ftp_conn = ftp_connect($ftp_server) or die("Wystąpił błąd! Skontaktuj się z supportem.");
      $login = ftp_login($ftp_conn, FTPUSER, FTPPASS);
      ftp_chdir($ftp_conn, "videos");
      ftp_chdir($ftp_conn, $dane['video_id']);
      ftp_delete($ftp_conn, $dane['fname']);
      ftp_chdir($ftp_conn, "/videos");
      ftp_rmdir($ftp_conn, $dane['video_id']);
      ftp_close($ftp_conn);
      header('location: settings.php');
  } else {
	    header('location: index1.php');
    }
  } else {
    header('location: index.php');
  }
} else {
  echo 'error';
}
  ?>
