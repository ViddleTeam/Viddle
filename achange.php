<?php

session_start();

$login = $_SESSION['user'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if (isset($_POST['av7']))
{
	$nplik = $_FILES['av7'];
	$ok = true;
	
	$odczyt = pathinfo($nplik);
	$ext = $odczyt['extension'];
 
	if ($ext !="jpg" || $ext !="png" || $ext !="jpeg" || $ext !="bmp")
	{
		$ok = false;
		$f_plik = '<div class="alert alert-danger" role="alert">Wybrano typ pliku który jest nie obsługiwany przez nasz serwis. Obsługujemy te formaty zdjęć: .png, .jpg, .jpeg, .bmp </div>';
	}
	
	
		
}
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
require_once('partials/navbar.php');

?>

      <div class="container" style="margin-top:30px;">
	      
<?php

// errory

echo $f_plik;
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
		<form method ="post">
		<center><input type="file" name="av7" accept="image/png/jpg/jpeg/bmp" style="color: white; margin-top: 5px;" />wybierz nowy avatar</center>
			<br></br><br></br>

		<center> <input type="submit" value="zmień avatar" class="btn btn-success" style="padding: 10px; color: white;">
		</form>
		<a href="davatar.php"><button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny avatar <?php echo $nplik ?> </p></button></a>
		
								
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
