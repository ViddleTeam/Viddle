<?php

session_start();

$login = $_SESSION['user'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))
	
	$d2 = $result->num_rows;

if(isset($_FILES['file_picker']))
{
	$file_name = $_FILES['file_picker']['name'];
	
	
	
}
	if (isset($d2) && $d2 == '1')
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
			$ba3 = 'https://wallpapercave.com/wp/t05PXKg.jpg';
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
$title = "Zmień grafikę kanału";
require_once('partials/navbar.php');
?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Zmień grafikę swojego kanału</h4><br>
		      <center>
			      <img src="http://wallpapercave.com/wp/t05PXKg.jpg" width="100%" height="100%" style="border-radius: 10px; box-shadow: 0 0 15px -5px black;" />
			      <div class="card-channel" style="border-radius: 0 0 10px 10px; margin-top: -125px; margin-left: 0px; margin-right: 0px; width: 100%; height: auto; padding: 20px;">
				<img width="204px" style="border-radius:50%; margin-bottom:5px;" class="img-responsive" src="<?php echo $av4 ?>"><br>
		      	<button type="button" class="btn btn-gray" data-toggle="modal" data-target="#modalAvatar"><p style="margin: 10px;">Zmień awatar</p></button></a>
				<button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny</p></button><br><br>
				<p>Obsługiwane formaty: JPG, JPEG, PNG oraz BMP. Aktualizacja może potrwać do kilku minut.</p>
			      </div>
		      </center>
								
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

<!-- modal zmiany awataru -->
<div class="modal fade" id="modalAvatar" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Zmiana awataru</h5>
      </div>
	<form method="POST" enctype="multipart/form-data">
      <div class="modal-body">
	      <p>Wybierz plik obrazu, który posłuży jako zdjęcie profilowe na Viddle.</p><br>
	      <center> <img width="204px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av4 ?>"> <br></br></center>
		<center>
			<input type="file" name="file_picker" value="Wybierz plik" />
		</center>
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-primary" style="padding: 10px;" value='Zastosuj zmiany'>
      </div>
	</form>
    </div>
  </div>
</div>
<!-- modal dla niezalogowanych -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Musisz się zalogować, żeby skorzystać z tej funkcji.</h5>
      </div>
      <div class="modal-body">
        Zarejestrowani użytkownicy mogą udostępniać filmy, oddawać głosy, czy pisać komentarze, i nie tylko. Zaloguj się, lub zarejestruj, żeby móc skorzystać z tej funkcji.
      </div>
      <div class="modal-footer">
		<a href="index.php"><button type="button" class="btn btn-secondary" style="padding: 10px;">Powrót na stronę główną</button></a>
		<a href="login.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Zaloguj się</button></a>
      </div>
    </div>
  </div>
</div>
<?php
require_once('partials/footer.php');
?>
<?php
if ($_SESSION['z1'] == false) {
	echo "<script>$('#staticBackdrop').modal('show');</script>";
}
?>

<div class="hiddendiv common"></div></body></html>
