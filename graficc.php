<?php

session_start();

$login = $_SESSION['user'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))
	
	$d2 = $result->num_rows;
	if($d2 == '1')
	{
		$dane = $result->fetch_assoc();
		
		$av5 = $dane['avatarname'];
		$ba2 = $dane['banername'];
		$id = $dane['uid'];
		
		
		if($av5 == 'x')
		{
			$av4 = 'avatardomyslny.jpg';
		}
		else
		{
			$av4 = 'grafic/'.$id.'a.'.$av5.'';
		}
		
		if($ba2 == 'x')
		{
			$ba3 = 'http://wallpapercave.com/wp/t05PXKg.jpg';
		}
		else
		{
			$ba3 = 'grafic/'.$id.'b.'.$ba2.'';
		}
		
	}
	else
	{	
		header('location: index.php');
	}
$title = "zmiana grafiki kanału";
require_once('partials/navbar.php');
?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12" style="text-align: center;">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Zmień grafikę swojego kanału</h4><br><br>
		      <img src="http://wallpapercave.com/wp/t05PXKg.jpg" width="100%" height="100%" style="border-radius: 10px;" />
		      <div class="card-channel" style="margin-top: -50px;">
              		<p style="color: white;">oto twój aktualny avatar:</a></p>
	      		<img width="204px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av4 ?>"> <a href="achange.php"><button type="button" class="btn btn-blue-gren"><p style="margin: 10px;">Zmień avatar</p></button></a>
	      	      </div>
								
							</center>
						</p>
					</div>
			   </div>
            </div>
			<div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          
<?php 
require_once('partials/footer.php');
?>
<!-- JS -->
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/jquery.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/bootstrap.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
