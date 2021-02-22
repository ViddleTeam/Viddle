<?php

$s = false;

session_start();

$login = $_SESSION['uid'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$login))))

$dane2 = $result->fetch_assoc();
$d2 = $result->num_rows;

if(isset($_FILES['file_picker']))
{
	$ok = true;
	
	$av = $dane2['avatarname'];
	
	$file_name = $_FILES['file_picker']['name'];
      	$file_size =$_FILES['file_picker']['size'];
      	$file_tmp =$_FILES['file_picker']['tmp_name'];
      	$file_type=$_FILES['file_picker']['type'];
	$file_ext=strtolower(end(explode('.',$_FILES['file_picker']['name'])));
	
	$f = '0';
	
	if($file_type == 'image/png') {
		$f = '1';
		$t = 'png';	
	}
	
	if($file_type == 'image/jpg') {
		$f = '1';
		$t = 'jpg';	
	}
	
	if($file_type == 'image/jpeg') {
		$f = '1';
		$t = 'jpeg';	
	}
	
	if($file_type == 'image/bmp') {
		$f = '1';
		$t = 'bmp';	
	}
	
	 if($f == '0') {
         	$f_error = 'niedozwolony format';
		$ok = false;
         }
	
	 if($file_size > 3097152){
         	$w_error = 'plik za wielki!';
		$ok = false;
      	 }
	
	 if($ok == true) {
		 
		 if(!$av == 'x') {
		 $del = '1';
		 $plik = ''.$_SESSION['uid'].'.'.$av.'';
		 } else {
			 $del = '0';
		 }
		 require 'daneftp.php';
	
		$ftp_server = FTPSERWER;
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, FTPUSER, FTPPASS);
		 
		ftp_chdir($ftp_conn, '/avatars/');
		
		
		 
		ftp_chdir($ftp_conn, '/avatars/'.$_SESSION['uid']);
		if($del == '1') {
			$files = ftp_nlist($ftp_conn, ".");
			foreach ($files as $file) {
			    ftp_delete($ftp_conn, $file);
			}    
		}
		ftp_put($ftp_conn, $_SESSION['uid'].'.'.$t, $file_tmp, FTP_BINARY);
		ftp_close($ftp_conn);
		
		if ($result = @$connect->query(
		sprintf("UPDATE viddle_users SET avatarname='%s' WHERE uid='%s'",
		mysqli_real_escape_string($connect,$t),
		mysqli_real_escape_string($connect,$_SESSION['uid'])))) {
		}
	 }
}
	if (isset($d2) && $d2 == '1') {
		$av5 = $dane2['avatarname'];
		$ba2 = $dane2['banername'];
		$id = $dane2['uid'];
		if($av5 == 'x')
		{
			$av4 = 'avatardomyslny.jpg';
		}
		else
		{
			$av4 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$_SESSION['uid'].'/'.$_SESSION['uid'].'.jpeg';;
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
<!DOCTYPE HTML>
<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if (isset($title)) echo $title ?> na Viddle</title>
    <script src="https://kit.fontawesome.com/ca8376a2f4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Zmień grafikę swojego kanału</h4><br>
		      <center>
			      <img src="http://wallpapercave.com/wp/t05PXKg.jpg" width="100%" height="15%" style="border-radius: 10px; box-shadow: 0 0 15px -5px black;" />
			      <div class="card-channel" style="border-radius: 0 0 10px 10px; margin-top: -85px; margin-left: 0px; margin-right: 0px; width: 100%; height: auto; padding: 20px;">
				<img width="204px" style="border-radius:50%; margin-bottom:5px;" class="img-responsive" src="<?php echo $av4 ?>"><br><br>
		      	<button type="button" class="btn btn-grey" data-toggle="modal" data-target="#modalAvatar"><p style="margin: 10px;">Zmień awatar</p></button></a>
				<button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny</p></button><br><br>
				<p>Obsługiwane formaty: JPG, JPEG, PNG oraz BMP. Aktualizacja może potrwać do kilku minut. </p>
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
	    <?php
	    echo $f_error;
	    echo $w_error;
	    echo $_FILES['file_picker']['type'];
	    ?>
	<form method="post" enctype="multipart/form-data">
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
<?php
if ($s == true) {
    echo "<script>
			$('#staticBackdrop').modal('show');
		</script>";
}
?>

	
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
