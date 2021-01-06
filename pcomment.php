<body>

prosze czekać ...

</body>

<?php

session_start();

if($_POST['com'] == '')
{
      header('location: index.php');
}
else
{
     $tresc = $_POST['com'];
     $ok = true;
     $i = $_GET['id'];
  
     if((strlen($tresc)>500))
     {
          $ok = false;
		  
          $_SESSION['kinfo'] = '<div class="alert alert-danger" role="alert">
				  Twój komentarz jest za długi, maksymalna ilość znaków wynosi 500!
		  	  </div>';
          header('location: video.php?id='.$i.'');
     }
       
     if($ok == true)
     {
           require "danesql.php";
           $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
           
           if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
		    mysqli_real_escape_string($connect,$i))))
             
             $dane = $result->fetch_assoc();
       
             $c = $dane['comments'];
       
             $c2 = $c + '1';
       
       if ($result2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_comments WHERE videoid='%s'",
		    mysqli_real_escape_string($connect,$i))))
         
         $dane2 = $result2->fetch_assoc();
         
         $i2 = $dane2['id2'];
         
         $i3 = $i2 + '1';
         
         $data= date("Y-m-d H:I:S");
       
              if ($connect->query(
				  sprintf("INSERT INTO `viddle_comments` VALUES (NULL, '%s', '%s', '%s', '%s', '%s'",
				  mysqli_real_escape_string($connect,$i3),
				  mysqli_real_escape_string($connect,$tresc),
				  mysqli_real_escape_string($connect,$_SESSION['uid']),
				  mysqli_real_escape_string($connect,$data),
				  mysqli_real_escape_string($connect,$i))))
             {
                  if ($connect->query(
				  sprintf("UPDATE viddle_videos SET comments='%s' WHERE video_id='%s'",
				  mysqli_real_escape_string($connect,$c2),
				  mysqli_real_escape_string($connect,$i))))
                  {
                        $_SESSION['kinfo'] = 'Pomyślnie dodano komentarz!';
                        header('location: video.php?id='.$i.'');
                  }
                        
             }
       
             
           
     }

      
}


?>
