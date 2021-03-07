<?php 
session_start();
$id = $_GET['id'];
require 'danesql.php';

if($connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME)) {
	if(isset($_SESSION['uid'])) {
		$uid = $_SESSION['uid'];
		if($result = @$connect->query("SELECT * FROM `viddle_videos` WHERE `publisher`='$uid' AND `video_id`='$id'")) {
			$d2 = $result->num_rows;
			
			if($d2 == '1') {
				if($connect->query("DELETE FROM `viddle_videos` WHERE `video_id`='$id'")) {
					require 'daneftp.php';
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
				}
			} else {
				header('location: index.php');
			}    
		}
	} else {
		header('location: index.php');
	}
} else {
	echo 'mysqli connect error';
}
?>
