<?php
session_start();

$id = $_GET['id'];
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$uid = $_SESSION['uid'];

$r = '1';

if ($result = @$connect->query(
sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
mysqli_real_escape_string($connect,$id)))) {
$d2 = $result->num_rows;
$dane = $result->fetch_assoc();
	
$like = $dane['upvotes'];
$dislike = $dane['downvotes'];
	
if($d2 == '1')
{
	if ($result1 = @$connect->query(
	sprintf("SELECT * FROM viddle_oceny WHERE videoid='%s' AND uid='%s' AND ocena='%s'",
	mysqli_real_escape_string($connect,$id),
	mysqli_real_escape_string($connect,$_SESSION['uid']),
	mysqli_real_escape_string($connect,$r)))) 
	{
		$d3 = $result1->num_rows;
		
		if($d3 == '1')
		{
			echo '1';
			$w = $like - '1';
			if($gg = @$connect->query(
			sprintf("DELETE FROM viddle_oceny WHERE videoid='%s' AND uid='%s'",
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$uid)))) {
				echo '2';
				
				if($gg = @$connect->query(
				sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
				mysqli_real_escape_string($connect,$w),
				mysqli_real_escape_string($connect,$id)))) {
					echo '3';
					header('location: video.php?id='.$id.'');
				}
					
			}
		} else {
			$o = '0';
			if ($result2 = @$connect->query(
			sprintf("SELECT * FROM viddle_oceny WHERE videoid='%s' AND uid='%s' AND ocena='%s'",
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$_SESSION['uid']),
			mysqli_real_escape_string($connect,$o)))) 
			{
				$w = 
				$d4 = $result2->num_rows;
				
				if($d4 == '1')
				{
						echo '6';
			$w = $dislike - '1';
			$w2 = $like + '1';
			if($gg = @$connect->query(
			sprintf("UPDATE viddle_oceny SET ocena='%s' WHERE videoid='%s' AND uid='%s'",
			mysqli_real_escape_string($connect,$r),
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$uid)))) {
				echo '2';
				if($gg = @$connect->query(
			sprintf("UPDATE viddle_videos SET downvotes='%s' WHERE video_id='%s'",
			mysqli_real_escape_string($connect,$w),
			mysqli_real_escape_string($connect,$id)))) {
					
					if($gg = @$connect->query(
			sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
			mysqli_real_escape_string($connect,$w),
			mysqli_real_escape_string($connect,$id)))) {
						
						echo '3';
				
					header('location: video.php?id='.$id.'');
						
					}
					
				}
				
					
			}
					
				} else {
					$d = '1';
					if ($syf = @$connect->query(
					sprintf("INSERT INTO `viddle_oceny` VALUES (NULL,'%s','%s','%s')",
					mysqli_real_escape_string($connect,$uid),
					mysqli_real_escape_string($connect,$id),
					mysqli_real_escape_string($connect,$d))))
					{
						$w = $like + '1';
						if($gg = @$connect->query(
						sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
						mysqli_real_escape_string($connect,$w),
						mysqli_real_escape_string($connect,$id)))) {
							echo '3';
							header('location: video.php?id='.$id.'');
						}
						
					}
				}
			}
			
			
		}
	}
		
} else {
	header('location: index.php');
}

}
	
	
	


?>
