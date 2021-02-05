<?php
session_start();
$id = $_GET['id'];
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$uid = $_SESSION['uid'];


if ($result1 = @$connect->query(
sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
mysqli_real_escape_string($connect,$id)))) {
	echo '1';
	
  $d2 = $result1->num_rows;
  $uid = $_SESSION['uid'];
  
  $dane = $result1->fetch_assoc();
  
  $like = $dane['upvotes'];
  $dislike = $dane['downvotes'];
  if($d2 == '1') { echo '1';
   
    if(isset($_SESSION['uid'])) { echo '1';
    
    if ($result2 = @$connect->query(
    sprintf("SELECT * FROM viddle_oceny WHERE userid='%s'",
    mysqli_real_escape_string($connect,$uid)))) { echo '4';
    
    $d3 = $result->num_rows;
	
	$wstaw = $like + '1';
        
      if ($connect->query("INSERT INTO viddle_oceny VALUES (NULL, '$uid', '$id', '1')"))    {
        
        $connect->query("UPDATE viddle_videos SET upvotes='$wstaw' WHERE video_id='$id'");
        
        header('location: video.php?id='.$id.'');
    
    $przepusc = true;
      
    if($d3 == '1') { echo '1';
	
    if ($result3 = @$connect->query(
    sprintf("SELECT * FROM viddle_oceny WHERE userid='%s' AND videoid='%s'",
    mysqli_real_escape_string($connect,$uid),
    mysqli_real_escape_string($connect,$id)))) {
	
	    $d4 = $result3->num_rows;
	    
	if($d4 > 0) {
		$danef = $result3->fetch_assoc();
		
		$c = $danef['ocena'];
		
		if($c == '1') { 
		
		if ($res = @$connect->query(
    		sprintf("DELETE * FROM viddle_oceny WHERE userid='%s' AND videoid='%s'",
    		mysqli_real_escape_string($connect,$uid),
   		mysqli_real_escape_string($connect,$id)))) {
			
			$wartosc = $like - '1';
		
			if ($res = @$connect->query(
    			sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
   			mysqli_real_escape_string($connect,$wartosc),
			mysqli_real_escape_string($connect,$id)))) {
				header('location: video.php?id='.$id.'');
		}
			
		} else {
			
		}
		
	} else {
	    
	    
	
      
	$wstaw = $like + '1';
        
      if ($connect->query("INSERT INTO viddle_oceny VALUES (NULL, '$uid', '$id', '1')"))    {
        
        $connect->query("UPDATE viddle_videos SET upvotes='$wstaw' WHERE video_id='$id'");
        
        header('location: video.php?id='.$id.'');
          
    }
      }
		   }
      
      
    }
      
     

  } else {
  header('location: index.php');
  }

} else {
header('location: index.php');
}
}
}
}
}

?>
