<?php 
session_start();
$uid = $_SESSION['uid'];
if(!isset($_SESSION['z1'])) {
	header('location: index.php');
	exit();
}
$t = '';
$sciezka = '/videos';
require 'danesql.php';
$connect =  new MYSQLI(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if(!isset($_SESSION['etap'])) {
	$_SESSION['etap'] = '1';
}

if($_SESSION['uid'] == '5fd62da0d95545fd62da0d9557') {
	$_SESSION['etap'] = '3';
}

if(isset($_POST['submit'])) {
	
	if(empty($_FILES['video']['name'])) {
		echo 'error';
		exit;
	} else {
		try {
			$error = '0';
			if($_FILES['video']['size'] > '1000000000') {
				$error = '1';
				throw new Exception('za duzy plik');
			} else {
				$z[0]['body'] = $_FILES['video']['type'];
				$vars = array(
				  'video/mov' => 'mov',
				  'video/mp4' => 'mp4',
				  'video/webm' => 'webm',
				  'video/x-ms-wmv' => 'wmv',
			      	  'video/3gpp' => '3gpp',
				);

				$roz = strtr($z[0]['body'], $vars);
				
				if($roz == 'mp4' || $roz == 'mov' || $roz == 'webm' || $roz == 'wmv' || $roz == '3gpp') {
						
					
					
					if($il = $connect->query("SELECT * FROM `viddle_videos` WHERE `publisher`='$uid'")) {
						$wstaw = $il->num_rows;
						$viddleid = rand(1000000,9999999);
						$_SESSION['vid'] = $viddleid;
						require 'daneftp.php';
						$ftp_conn =  ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
						$login =  ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
						 ftp_chdir($ftp_conn, $sciezka);
						 ftp_mkdir($ftp_conn, $viddleid);
						 ftp_chdir($ftp_conn, $viddleid);
						$nazwa = $viddleid.'.'.$roz;
						 ftp_put($ftp_conn, $nazwa, $_FILES['video']['tmp_name'], FTP_BINARY) or die ('Błąd z przesyłaniem filmu, skontaktuj się z supportem');
						ftp_close($ftp_conn);
						$wstaw = time() + '300';
						$date = date("Y-m-d H:i:s");     
						$i =  $connect->query("SELECT * FROM viddle_videos WHERE publisher='$uid'");
						$il = $i->num_rows;
						
						if($connect->query("INSERT INTO `viddle_videos` VALUES ('0', '$il','$uid','13', '$viddleid', '0', '0', '0', '0', '$nazwa', CURRENT_DATE, '', 'X', '$date', '$wstaw')")) {
							$_SESSION['etap'] = '2';
						} else {
							$error = '3';
							throw new Exception('query error');
						}
					} else {
						$error = '3';
						throw new Exception('query error');
					}
				} else {
					$error = '2';
					throw new Exception('zly format');
				}
				
			}
			
		} catch (Exception $e) {
			if($error == '1') {
				$kom = '<div class="alert alert-danger" role="alert">Wybrany plik jest za duży!</div>';
			}
			
			if($error == '2') {
				$kom = '<div class="alert alert-danger" role="alert">Format twojego video jest nieobsługiwany przez viddle. Obsługiwane formaty to .mp4, .webm, .wmv, .3gpp i .mov</div>';
			}
			
			if($error == '4') {
				$kom = '<div class="alert alert-danger" role="alert">Wystąpił błąd! Skontaktuj się z supportem. Kod błędu: 0xu00001</div>';
			}
			
			if($error == '0') {
				$kom = '<div class="alert alert-danger" role="alert">Wystąpił nieznany błąd! Skontaktuj się z supportem</div>';
			}
		}
	}
}

if(isset($_POST['submitII'])) {
	$title = $_POST['title'];
	$opis = $_POST['opis'];
	$vid = $_SESSION['vid'];
	$title = mysqli_real_escape_string($connect, $title);
	$opis = mysqli_real_escape_string($connect, $opis);
	$title = htmlentities($title, ENT_QUOTES);
	$opis = htmlentities($opis, ENT_QUOTES);
	if($title == '') {
		$title = date("H:i:s"); 
	}
	try {
		if(strlen($title) > '52') {
			$error = '5';
			throw new Exception('title');
		} else {
			if(strlen($opis) > '1024') {
				$error = '6';
				throw new Exception('opis');
			} else {
				if($res=$connect->query("UPDATE `viddle_videos` SET `title`='$title', `opis`='$opis' WHERE `video_id`='$vid'")) {
					$_SESSION['etap'] = '4';
				} else {
					$error = '7';
					throw new Exception('query error');
				}
			}
		}
	} catch (Exception $e) {
		if($error == '5') {
			$t = '<div class="alert alert-danger" role="alert">Tytuł filmu nie może mieć więcej niż 52 znaki</div>';
		}
		
		if($error == '6') {
			$t = '<div class="alert alert-danger" role="alert">Opis filmu nie może mieć więcej niż 1024 znaki</div>';
		}
		
		if($error == '7') {
			$t = '<div class="alert alert-danger" role="alert">Wystąpił błąd serwisu. Skontaktuj się z supportem</div>';
		}
	}
}

if(isset($_POST['buttonIII'])) {
	if(!empty($_FILES['min']['size'])) {
		try {
			$error = '000';
			$z[0]['body'] = $_FILES['min']['type'];
				$vars = array(
				  'image/png' => 'png',
				  'image/jpg' => 'jpg',
				  'image/jpeg' => 'jpeg',
				  'image/bmp' => 'bmp',
				);

			$roz = strtr($z[0]['body'], $vars);
			if($roz == 'png' || $roz == 'jpg' || $roz == 'jpeg' || $roz == 'bmp') {
				if($_FILES['min']['size'] > '3000000') {
					$error = '9';
					throw new Exception('za duzy plik');
				} else {
					require 'daneftp.php';
					$ftp_conn =  ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
					$login =  ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
					 ftp_chdir($ftp_conn, $sciezka);
					 ftp_chdir($ftp_conn, $_SESSION['vid']);
					$nazwa = $_SESSION['vid'].'m.'.$roz;
					 ftp_put($ftp_conn, $nazwa, $_FILES['min']['tmp_name'], FTP_BINARY) or die ('Błąd z przesyłaniem filmu, skontaktuj się z supportem');
					ftp_close($ftp_conn);
					$vid = $_SESSION['vid'];
					if($connect->query("UPDATE viddle_videos SET minname='$roz', premiere='0' WHERE video_id='$vid'")) {
						unset($_SESSION['etap']);
						unset($_SESSION['vid']);
						header('location: video.php?id='.$vid);
					} else {
						$error = '10';
						throw new Exception('query error');
					}
				}
			} else {
				$error = '8';
				throw new Exception('zly format');
			}
		} catch (Exception $e) {
		}
	}
}

if(isset($_POST['po'])) {
	if($connect->query("UPDATE viddle_videos SET minname='$roz', premiere='0' WHERE video_id='$vid'")) {
		unset($_SESSION['etap']);
		$vid = $_SESSION['vid'];
		unset($_SESSION['vid']);
		header('location: video.php?id='.$vid);
	} else {
		echo 'error';
		exit;
	}
}
$connect->close();
?>
<html lang="pl-PL"><head>
	
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Udostępnij film na Viddle</title> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
     <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle- polska alternatywa dla YouTube">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
	<script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
	<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	<script src="https://cdn.tiny.cloud/1/9n5avfoajfr11lw9hhd4o45rxfafzr79vlo04km6r4kp8i7l/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
	<style type="text/css">/* Chart.js */
 -webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}} keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
<body>
<?php require 'partials/navbar.php'; ?>
	  <?php 
	  if($_SESSION['etap'] == '1') {
	  ?>
	  <form method="post" enctype="multipart/form-data">
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na Viddle</h4>
				  <p style="color: white; margin-bottom: 20px;">Krok 1/3: Wybierz film do udostępnienia</p>
              </div>
            </div>
            <div class="tile" style="margin: auto;">
               <div class="card-upload border border-white;" style="margin: auto; width: 100%; height: auto;">
					<div class="card-body">
						<p style="align-items: center; color: white;">
							<center>
								<h2 style="color: white;">Wybierz plik wideo z komputera/telefonu</h2>
								<?php
								if(isset($kom)) {
									echo $kom;
								}
								?>
                <p style="color: white;">Maksymalny dozwolony rozmiar na jeden film wynosi 1 GB. Chcesz się dowiedzieć, ile dany film może ważyć? Użyj <a href="https://toolstud.io/video/filesize.php?">tego narzędzia.</a></p>
                <p style="color: white; font-weight: bold; margin-top: -10px;">Pamiętaj, że administracja Viddle ma pełne prawo do usunięcia filmu, jeżeli narusza on prawa autorskie i/lub regulamin.</p>
								<input type="file" name="video" accept="video/mp4, video/mov" style="color: white; margin-top: 5px;" /> 
							</center>
						</p>
					</div>
			   </div>
            </div>
			<center>
				<!-- PROSZE NIE DAWAĆ DO ŻADNEGO SUBMITA class="btn-succes" - człowieczek -->
     <input type="submit" name="submit" style="margin-bottom: 10px; color: white;" value="dalej" />
     </form></div>
			<div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
		<?php
	  }
	  if($_SESSION['etap'] == '2') {		?>
          <div class="row"><center>
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br></h4>
				
              </div>
            </div>
			<?php echo $t; ?>
		                <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na Viddle</h4>
				  <p style="color: white; margin-bottom: 20px;">Krok 2/3: Podstawowe informacje</p>
              </div>
            </div>
            <div class="container row" style="width: auto; color: white;">
               <form method="post">
                <div class="form-row" style="justify-content: center;">
                  <div class="col-md-12">
                    <div class="md-form form-group" style="width: 100%;">
                      <input type="text" name="title" style="color: white;" ' class="form-control" id="inputEmail4MD">
                      <label for="inputEmail4MD" style="color: white;">Tytuł filmu</label>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form form-group">
                      <textarea name="opis" id="form7" class="md-textarea form-control" rows="4" cols="137" style="color: white; width: 100%; resize: none; margin-top: -10px;"></textarea>
                      <label for="form7" style="color: white;">Opis filmu</label>
                    </div>
                  </div>
                </div>
				  <input type="submit" name="submitII" style="margin: 10px; color: white;" value="dalej" />
			   <div style="justify-content: center;">
			   </div></form>
		       </div></center>
	  <?php } ?>
									     <?php
									     if($_SESSION['etap'] == '3') { ?>
									     <div class="row">
<div class="col-md-6">
<div class="card border border-white upload-hover-animation upload-one" style="margin: auto; width: 100%; height: 100%;" onclick="premiere = 0; uploadCheck();">
<div class="card-body" style="text-align: center; color: white;">
<i class="fas fa-upload fa-3x" style="margin-bottom: 10px;"></i><br>
<h3>Natychmiastowo</h3>
<p>Twój film po wysłaniu na serwer będzie natychmiast dostępny, a oglądający nie będą musieli czekać.</p>
</div>
</div>
</div>
<div class="col-md-6">
<div class="card border border-white upload-hover-animation upload-two" style="margin: auto; width: 100%; height: 100%;" onclick="premiere = 1; uploadCheck();">
<div class="card-body" style="text-align: center; color: white;">
<i class="fas fa-clock fa-3x" style="margin-bottom: 10px;"></i><br>
<h3>Ustaw premierę <span class="badge badge-info">Beta</span></h3>
<p>
Po wysłaniu na serwer, film będzie dostępny do obejrzenia dopiero od ustawionego przez Ciebie dnia i godziny.<br>
<b>Ważne:</b> nie możesz ustawić premiery, jeżeli ustawiłeś prywatność filmu na <b>prywatny.</b></p>
</p>
									     <?php
									     }
									     ?>
	  <?php if($_SESSION['etap'] == '4') { ?>
	  <form method="post" enctype="multipart/form-data">
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na Viddle</h4>
				  <p style="color: white; margin-bottom: 20px;">Krok 3/3: Dodatkowe elementy</p>
              </div>
            </div>
            <div class="tile" style="margin: auto;">
               <div class="card-upload border border-white;" style="margin: auto; width: 100%; height: auto;">
					<div class="card-body">
						<p style="align-items: center; color: white;">
							<center>
								<h2 style="color: white;">Wybierz miniaturke z komputera/telefonu</h2>
								
                <p style="color: white;">Maksymalny dozwolony rozmiar na jedną miniaturke wynosi 3 MB. Chcesz się dowiedzieć, ile dana miniaturka może ważyć? Użyj <a href="https://toolstud.io/video/filesize.php?">tego narzędzia.</a></p>
                
								<input type="file" name="min" accept="image/png, image/jpeg, image/jpg, image/bmp" style="color: white; margin-top: 5px;" /> 
							</center>
						</p>
					</div>
			   </div>
            </div>
			<center>
     <input type="submit" name="buttonIII" style="margin: 10px; color: white;" value="zakończ" />
     </form></div>
	 <form method="post">
	 <input type="submit" name="po" class="btn btn-success" style="margin: 10px; color: white;" value="pomiń" />
	 </form>
			<div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
	  
    <div class="row">
      
    </div>
    </div>
      <div class="row">
          <div class="col-md-12">
            <br>
      
          </div>
        </div>

</div>
</center>
	  <?php } ?>
        </div>
<!-- JS -->
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
