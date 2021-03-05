<?php
session_start();

if(!isset($_SESSION['uid'])) {
  header('location: index.php');
} else {
    $id = $_GET['id'];
    
              require "danesql.php";
            $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  
    if ($result = @$connect->query(
		sprintf("SELECT * FROM viddle_videos WHERE video_id='%s' AND publisher='%s'",
		mysqli_real_escape_string($connect,$id),
    mysqli_real_escape_string($connect,$_SESSION['uid'])))) {
     $d2 = $result->num_rows;
      if($d2 == '1') {
              if ($resultII = @$connect->query(
		          sprintf("UPDATE `viddle_videos` SET `opis`='%s' AND `title`='%s' WHERE `video_id`='%s'",
		          mysqli_real_escape_string($connect,$opis),
              		mysqli_real_escape_string($connect,$title),
              		mysqli_real_escape_string($connect,$id)))) {
                		header('location: settings.php');
              }
      } else {
        header('location: index.php');
      }
    } else {
        header('location: index.php');
    }

    
}


?>
