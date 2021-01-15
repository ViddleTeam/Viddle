<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<?php if($obm == '1') { ?>
					<form method="post">
                    <input type="submit" name="ob" <?php echo $obd ?> value="Obserwuj" />
					</form>
							  <?php } else { ?>
							  
							  	<form method="post">
                    <input type="submit" name="unob" value="Obserwujujesz" />
					</form>
							  
							  <?php } ?>
                </body>
          </html>
