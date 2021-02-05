<?php
session_start();
$id = $_GET['id'];
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);



if ($result1 = @$connect->query(
sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
mysqli_real_escape_string($connect,$id)))) {
	
  $d2 = $result1->num_rows;
  $uid = $_SESSION['uid'];
  
  $dane = $result1->fetch_assoc();
  
  $like = $dane['upvotes'];
  $dislike = $dane['downvotes'];
  if($d2 == '1') {
   
    if(isset($_SESSION['uid'])) {
    
    if ($result2 = @$connect->query(
    sprintf("SELECT * FROM viddle_oceny WHERE userid='%s'",
    mysqli_real_escape_string($connect,$uid)))) {
    
    $d3 = $result->num_rows;
    
    $przepusc = true;
      
    if($d3 == '1') {
      
      $result3 = $connect->query("SELECT * FROM viddle_oceny WHERE ocena='1' AND userid='$uid'");
      
      $d4 = $result3->num_rows;
      
      if($d4 == '1') {
      
      if($connect->query("DELETE * FROM viddle_oceny WHERE userid='$uid'")) {
      $wstaw = $like - '1';
        if($connect->query("UPDATE viddle_videos SET upvotes='$wstaw' WHERE video_id='$id'")) {
		$przepusc = false;
		header('location: video.php?id='.$id.'');
		exit();
      
        }
      }
      
      } else {
        
        if($connect->query("DELETE * FROM viddle_oceny WHERE userid='$uid'")) {
        $wstaw = $dislike - '1';
        
          if($connect->query("UPDATE viddle_videos SET downvotes='$wstaw' WHERE video_id='$id'")) {
            
          $przepusc = true;
		  }
      }
      
      
      
    }
      if($przepusc == true) {
        
        $wstaw = $like + '1';
        
      if ($connect->query("INSERT INTO viddle_oceny VALUES (NULL, '$uid', '$id', '1')"))    {
        
        $connect->query("UPDATE viddle_videos SET upvotes='$wstaw' WHERE video_id='$id'");
        
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
}
?>
