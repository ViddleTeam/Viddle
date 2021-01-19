<?php

if(isset($_POST['ob']))
{



		$ok = true;

		$ahaha = $dane['observators'] + 1;

	 if ($connect->query(
				  sprintf("INSERT INTO viddle_obserwators VALUES (NULL, '%s', '%s', '%s', '%s', '%s'",
				  mysqli_real_escape_string($connect,$ahaha),
				  mysqli_real_escape_string($connect,$_SESSION['uid']),
				  mysqli_real_escape_string($connect,$publisher),
				  mysqli_real_escape_string($connect,'1'))))
	    {
		    if ($result = @$connect->query(
		    sprintf("UPDATE `viddle_users` SET `observators`='%s' WHERE `uid`='%s'",
		    mysqli_real_escape_string($connect,$ahaha),
		    mysqli_real_escape_string($connect,$publisher))))
		    {
			    // dodano do obserwowanych
			    
			    
		    }
	    }



}

?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<?php if($obm == '1') { ?>
					<form method="post">
                    <input type="submit" class="btn btn-success" name="ob" <?php echo $obd ?> value="Obserwuj" />
					</form>
							  <?php } else { ?>
							  
							  	<form method="post">
                    <input type="submit" class="btn btn-grey" name="unob" value="Obserwujujesz" />
					</form>
							  
							  <?php } ?>
                </body>
          </html>
