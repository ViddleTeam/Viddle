<?php
if (isset($_POST['plik'])) {
	$plik = $_FILES['plik'];
	echo $plik;
	print_r($plik);	
}

$f_plik = true;

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
$title = "zmiana avataru kanału";
?>
<?php
require_once('partials/navbar.php');
?>
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Zmiana avataru</h4>
                <p style="color: white;">oto twój aktualny avatar:</a></p>
	      <center> <img width="204px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av4 ?>"> <br></br></center>
		<form method ="post" enctype="multipart/form-data">
		<center><input type="file" name="plik" style="color: white; margin-top: 5px;" />Wybierz nowy avatar</center>
			<br></br><br></br>

		<center> <input type="submit" value="zmień avatar" class="btn btn-success" style="padding: 10px; color: white;">
		</form>
		<a href="davatar.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny awatar</p></button></a>
		
								
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
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
