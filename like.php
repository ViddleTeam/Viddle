<?php
session_start();
$id = $_GET['id'];
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result1 = @$connect->query(
sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
mysqli_real_escape_string($connect,$id)))) {
  $d2 = $result1->num_rows;
  
  $dane = $result1->fetch_assoc();
  
  $like = $dane['upvotes'];
  
  if($d2 == '1') {
   
    if(isset($_SESSION['uid'])) {
    
    if ($result2 = @$connect->query(
    sprintf("SELECT * FROM viddle_oceny WHERE userid='%s'",
    mysqli_real_escape_string($connect,$_SESSION['uid'])))) {
    
    $d3 = $result->num_rows;
    
    $przepusc = true;
      $uid = $_SESSION['uid'];
    if($d3 == '1') {
      $przepusc = false;
      
      $result3 = $connect->query("SELECT * FROM viddle_oceny WHERE ocena='1' AND userid='$uid'");
      
      $d4 = $result3->num_rows;
      
      if($d4 == '1') {
      
      if($connect->query("DELETE * FROM viddle_oceny WHERE userid='$uid'")) {
      $wstaw = $like - '1';
        if($connect->query("UPDATE viddle_videos SET upvotes='$wstaw' WHERE video_id='$id'")) {
            header('location: video.php?id='.$id.'');
      
        }
      }
      
      } else {
      
      }
      
      
      
    }
      if($przepusc == true) {
        
      if ($connect->query("INSERT INTO viddle_oceny VALUES (NULL, '$uid', '$id', '1')"))    {
        header('location: video.php?id='.$id.'');
          
    }
      }
        
    } else {
     header('location: index.php');
    }
  } else {
  header('location: index.php');
  }

} else {
header('location: index.php');
}

}
?>
