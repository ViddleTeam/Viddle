<?php

$s = false;
$berror = '';
session_start();

$login = $_SESSION['uid'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$login))))

$dane2 = $result->fetch_assoc();
$d2 = $result->num_rows;
if($d2 == '1') {
	if($dane2['banername'] == 'x' || $dane2['banername'] == 'X') {
		$ba3 = 'https://wallpapercave.com/wp/t05PXKg.jpg';
	} else {
		$ba3 = 'https://cdn.viddle.xyz/cdn/videos/banners/'.$_SESSION['uid'].'/'.$_SESSION['uid'].'b.'.$dane2['banername'].'';
	}
	
	if($dane2['avatarname'] == 'x' || $dane2['avatarname'] == 'X') {
		$av4 = 'anonim.png';
	} else {
		$av4 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$_SESSION['uid'].'/'.$_SESSION['uid'].'.'.$dane2['avatarname'].'';
	}
}
if(isset($_POST['buttom'])) {
	if(!empty($_FILES['baner']['name'])) {
		$z[0]['body'] = $_FILES['baner']['type'];
			$vars = array(
			'image/png' => 'png',
			'image/jpg' => 'jpg',
			'image/jpeg' => 'jpeg',
			'image/bmp' => 'bmp',
			);
			
			$roz = strtr($z[0]['body'], $vars);
			
			try { 
				if($roz == 'png' || $roz == 'jpg' || $roz == 'jpeg' || $roz == 'bmp') {
					
					if($_FILES['baner']['size'] > '48000000') {
						$error = '2';
						throw new Exception('za duzy plik');
					} else { 
						$sciezka = '/banners/'.$_SESSION['uid'].'/';
						require 'daneftp.php';
						$ftp_conn =  ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
						$login =  ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
						ftp_chdir($ftp_conn, $sciezka);
						if(!ftp_chdir($ftp_conn, $_SESSION['uid'])) {
							ftp_mkdir($ftp_conn, $_SESSION['uid']);
							ftp_chdir($ftp_conn, $_SESSION['uid']);
						}
						$nazwa = $_SESSION['uid'].'b.'.$roz;
						ftp_put($ftp_conn, $nazwa, $_FILES['baner']['tmp_name'], FTP_BINARY) or die ('Błąd z przesyłaniem, skontaktuj się z supportem');
						ftp_close($ftp_conn);
						$uid = $_SESSION['uid'];
						if($connect->query("UPDATE viddle_users SET banername='$roz' WHERE uid='$uid'")) {
								
						} else {
							$error = '3';
							throw new Exception('za duzy plik');
						}
					}
				} else {
					$error = '1';
					throw new Exception('zly format');
				}
			} catch (Exception $e) {
				if($error == '1') {
					$berror = '<div class="alert alert-danger" role="alert">Format wybranego pliku jest nieobsługiwany. Dozwolone formaty to .png, .jpg, .jpeg i .bmp</div>';
				}
				
				if($error == '2') {
					$berror = '<div class="alert alert-danger" role="alert">Twój baner waży za dużo. Maksymalny rozmiar baneru może wynosić 6 MB</div>';
				}
				
				if($error == '2') {
					$berror = '<div class="alert alert-danger" role="alert">Wystąpił błąd serwisu. Skontaktuj się z supportem</div>';
				}
				echo "<script>
				      $('#modalBanner').modal('show');
				      </script>";
			} 
	}
}

if(isset($_FILES['file_picker'])) {
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
        $f_error = 'Format pliku jest nieobsługiwany.';
		$ok = false;
    }
	if($file_size > 3097152){
        $w_error = 'Użyty plik jest za duży.';
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
		
		
		 
		ftp_chdir($ftp_conn, '/avatars/'.$_SESSION['uid'].'/'.$_SESSION['uid']);
		if($del == '1') {
			$delete = $_SESSION['uid'].'.'.$av.'';
			ftp_delete($conn_id, $delete);
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
			  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					aria-selected="true">Zdjęcie profilowe</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="banner-tab" data-toggle="tab" href="#banner" role="tab" aria-controls="banner"
					aria-selected="false">Baner</a>
				</li>
			  </ul>
			  <div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<img src="http://wallpapercave.com/wp/t05PXKg.jpg" width="100%" height="15%" style="border-radius: 10px; box-shadow: 0 0 15px -5px black;" />
					<div class="card-channel" style="border-radius: 0 0 10px 10px; margin-top: -85px; margin-left: 0px; margin-right: 0px; width: 100%; height: auto; padding: 20px;">
						<img width="192px" style="border-radius:50%; margin-bottom:5px;" class="img-responsive" src="<?php echo $av4 ?>"><br><br>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAvatar"><p style="margin: 10px;">Zmień awatar</p></button></a>
						<button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny</p></button><br><br>
						<p>Obsługiwane formaty: JPG, JPEG, PNG oraz BMP. Aktualizacja może potrwać do kilku minut. </p>
					</div>
				</div>
				<div class="tab-pane fade" id="banner" role="tabpanel" aria-labelledby="banner-tab">
					<img src="http://wallpapercave.com/wp/t05PXKg.jpg" width="100%" height="15%" style="border-radius: 10px; box-shadow: 0 0 15px -5px black;" />
					<div class="card-channel" style="border-radius: 0 0 10px 10px; margin-top: -85px; margin-left: 0px; margin-right: 0px; width: 100%; height: auto; padding: 20px;">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBanner"><p style="margin: 10px;">Zmień baner kanału</p></button></a>
						<button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny</p></button><br><br>
						<p>Obsługiwane formaty: JPG, JPEG, PNG oraz BMP. Aktualizacja może potrwać do kilku minut.</p>
					</div>
				</div>
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

<!-- modal zmiany baneru -->
<div class="modal fade" id="modalBanner" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Zmiana baneru</h5>
      </div>
	    <form method="post" enctype="multipart/form-data">
	    <?php echo $berror; ?>
	
      <div class="modal-body">
	      <p>Wybierz plik obrazu, który posłuży jako baner na Viddle. Zalecane jest użycie baneru o rozmiarze 1140x190 pikseli lub wyższym. Maksymalny rozmiar wynosi 6 MB.</p><br>
	      <center> <img width="100%" height="190px" class="img-responsive" src="<?php echo $ba3 ?>"> <br></br></center>
		<center>
			<input type="file" name="baner" value="Wybierz plik" />
		</center>
      </div>
      <div class="modal-footer">
		<input type="submit" class="btn btn-primary" style="padding: 10px;" value='Zastosuj zmiany' name="buttom">
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
