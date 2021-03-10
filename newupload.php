<?php session_start();
$t = '';


$sciezka = '/videos';
require 'danesql.php';
$connect = @new MYSQLI(SQLHOST, SQLUSER, SQLPASS, DBNAME);


$uid = $_SESSION['uid'];

if(!isset($_SESSION['etap'])) {
	$_SESSION['etap'] = '1';
}


if(isset($_POST['submit'])) {
	
	if(empty($_FILES['video']['name'])) {
		//w tej sytuacji nic się nie dzieje
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
						$ftp_conn = @ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
						$login = @ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
						@ftp_chdir($ftp_conn, $sciezka);
						@ftp_mkdir($ftp_conn, $viddleid);
						@ftp_chdir($ftp_conn, $viddleid);
						$nazwa = $viddleid.'.'.$roz;
						@ftp_put($ftp_conn, $nazwa, $_FILES['video']['tmp_name'], FTP_BINARY) or die ('Błąd z przesyłaniem filmu, skontaktuj się z supportem');
						ftp_close($ftp_conn);
						$wstaw = time() + '300';
						$date = date("Y-m-d H:i:s");     
						$i = @$connect->query("SELECT * FROM viddle_videos WHERE publisher='$uid'");
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
	$title = $_POST['tytul'];
	$opis = $_POST['opis'];
	$title = htmlentities($title, ENT_QUOTES, 'UTF-8');
	$opis = htmlentities($title, ENT_QUOTES, 'UTF-8');
	if(empty($title)) {
		$title = date("Y-m-d"); 
	}
	
	try {
		$error = '00';
		
		if(strlen($title) > '52') {
			$error = '5';
			throw new Exception('za dlugi tytul');
		} else {
			if(strlen($opis)  > '1024') {
				$error = '6';
				throw new Exception('za dlugi opis');
			} else {
				
				if ($syf = @$connect->query(
				sprintf("UPDATE `viddle_videos` SET `title`='%s',`opis`='%s' WHERE `video_id`='%s'",
				mysqli_real_escape_string($connect,$title),
				mysqli_real_escape_string($connect,$opis),
				mysqli_real_escape_string($connect,$_SESSION['vid'])))) {
					$_SESSION['etap'] = '3';
				} else {
					$error = '7';
					throw new Exception('blad z poleceniem');
				}
			}
		}
	} catch (Exception $e) {
		if($error == '5') {
			$t = '<div class="alert alert-danger" role="alert">Tytuł jest za długi. Maksymalnie tytuł może mieć 52 znaki!</div>';
		}
		
		if($error == '6') {
			$t = '<div class="alert alert-danger" role="alert">Opis jest za długi. Maksymalnie opis może mieć 1024 znaki!</div>';
		}
		
		if($error == '7') {
			$t = '<div class="alert alert-danger" role="alert">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu 0xu00002</div>';
		}
		if($error == '00') {
			$t = '<div class="alert alert-danger" role="alert">Wystąpił nieznany błąd serwisu! Skontaktuj się z supportem.</div>';
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
					$ftp_conn = @ftp_connect(FTPSERWER) or die("Błąd połączenia FTP! Skontaktuj się z supportem");
					$login = @ftp_login($ftp_conn, FTPUSER, FTPPASS) or die ("Błąd połączenia FTP! Skontaktuj się z supportem");
					@ftp_chdir($ftp_conn, $sciezka);
					@ftp_chdir($ftp_conn, $_SESSION['vid']);
					$nazwa = $_SESSION['vid'].'m.'.$roz;
					@ftp_put($ftp_conn, $nazwa, $_FILES['min']['tmp_name'], FTP_BINARY) or die ('Błąd z przesyłaniem filmu, skontaktuj się z supportem');
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
    <title>Udostępnij film na VDP</title> 
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    
     <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="VDP - polska alternatywa dla YouTube">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą VDP.">
	<script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
	<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	<script src="https://cdn.tiny.cloud/1/9n5avfoajfr11lw9hhd4o45rxfafzr79vlo04km6r4kp8i7l/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
	<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
<body>
    <div class="loader" style="opacity: 0; display: none;">
        <div class="spinner spinner-center">  
          <div class="spinner-border" style="width:3rem;height:3rem;color:white;margin-top: -150px;" role="status">
          <span class="sr-only">Ładowanie...</span>
        </div>
          </div>
        </div>
        <div style="opacity: 1;" class="website">
    <header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar top-nav-collapse" style="height: fit-content; background-color: #212121;">
    <a class="navbar-brand" href="index.html"><img src="https://cdn.discordapp.com/attachments/719598185118433311/766951476341506048/1602925873953.png" width="120px" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-6"
      aria-controls="navbarSupportedContent-6" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-6">
      <ul class="navbar-nav mr-auto">
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="index.html" title="Strona główna"><img src="https://media.discordapp.net/attachments/627764286785060899/725795384802410617/houm.png" width="20px"/> <p class="d-lg-none">Strona główna</p></a>
		</li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="trending.html" title="Popularne"><img src="https://media.discordapp.net/attachments/627764286785060899/725795329810628628/fajer.png" width="20px"/> <p class="d-lg-none">Popularne</p></a>
        </li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="discover.html" title="Odkrywaj"><img src="https://media.discordapp.net/attachments/627764286785060899/725795361268039811/dizkower.png" width="20px"/> <p class="d-lg-none">Odkrywaj</p></a>
        </li>
	  </div>
      </ul>
      <form class="form-inline" method="GET" action="search.html" style="margin-right: auto;">
        <input id="input_search" class="form-control mr-sm-2" style="width: 24rem; margin-top: 10px;" name="q" type="text" placeholder="Szukaj w Viddle" aria-label="Szukaj w Viddle">
      </form>
 
	<ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
	<div class="container row">
		<li class="nav-item">
		  <a class="nav-link" href="upload.html" title="Udostępnij film na VDP"><img src="https://media.discordapp.net/attachments/627873018990952448/726773229863305276/AAAAA.png" width="20px" style="color: white;" /> <p class="d-lg-none">Udostępnij film na VDP</p></a>
		</li>
	</div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="32px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="https://cdn.discordapp.com/avatars/353067694565883915/e6d7166edad41a3a2d5000281d9f8b14.png?size=1024">SlaVistaPL</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item waves-effect waves-light" href="channel.html">Przejdź na kanał</a>
                      <a class="dropdown-item waves-effect waves-light" href="#">Studio twórców</a>
                      <a class="dropdown-item waves-effect waves-light" href="#">Wyloguj się</a>
                    </div>
                </li>
            </ul>   
			</div>
  </nav>
      </header> 
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
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na VDP</h4>
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
                <p style="color: white; font-weight: bold; margin-top: -10px;">Pamiętaj, że administracja VDP ma pełne prawo do usunięcia filmu, jeżeli narusza on prawa autorskie i/lub regulamin.</p>
								<input type="file" name="video" accept="video/mp4, video/mov" style="color: white; margin-top: 5px;" /> 
							</center>
						</p>
					</div>
			   </div>
            </div>
			<center>
     <input type="submit" name="submit" class="btn btn-success" style="margin-bottom: 10px;"><p style="margin: 10px; color: white;" value="dalej" />
     </form></div>
			<div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
		<?php
	  }
	  if($_SESSION['etap'] == '2') {		?>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br></h4>
				  <p style="color: white; margin-bottom: 10px;">Krok 2/3: Nadaj nazwę filmowi oraz dodaj opis</p>
              </div>
            </div>
			<?php echo $t; ?>
            <div class="container row" style="width: auto; color: white;">
               <form method="post">
                <div class="form-row" style="justify-content: center;">
                  <div class="col-md-12">
                    <div class="md-form form-group" style="width: 100%;">
                      <input type="text" style="color: white;" name='tytul' class="form-control" id="inputEmail4MD">
                      <label for="inputEmail4MD" style="color: white;">Tytuł filmu</label>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form form-group">
                      <textarea id="form7" name='opis' class="md-textarea form-control" rows="4" cols="137" style="color: white; width: 100%; resize: none; margin-top: -10px;"></textarea>
                      <label for="form7" style="color: white;">Opis filmu</label>
                    </div>
                  </div>
                </div>
				  <input type="submit" name="submitII" class="btn btn-success" style="margin-bottom: 10px;"><p style="margin: 10px; color: white;" value="dalej" />
			   <div style="justify-content: center;">
			   </div></form>
    </div>
	  <?php } ?>
	  <?php if($_SESSION['etap'] == '3') { ?>
	  <form method="post" enctype="multipart/form-data">
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na VDP</h4>
				  <p style="color: white; margin-bottom: 20px;">Krok 3/3: Dodatkowe elementy</p>
              </div>
            </div>
            <div class="tile" style="margin: auto;">
               <div class="card-upload border border-white;" style="margin: auto; width: 100%; height: auto;">
					<div class="card-body">
						<p style="align-items: center; color: white;">
							<center>
								<h2 style="color: white;">Wybierz miniaturke z komputera/telefonu</h2>
								
                <p style="color: white;">Maksymalny dozwolony rozmiar na jedną miniaturke wynosi 3 MB. Chcesz się dowiedzieć, ile dany film może ważyć? Użyj <a href="https://toolstud.io/video/filesize.php?">tego narzędzia.</a></p>
                <p style="color: white; font-weight: bold; margin-top: -10px;">Pamiętaj, że administracja VDP ma pełne prawo do usunięcia filmu, jeżeli narusza on prawa autorskie i/lub regulamin.</p>
								<input type="file" name="min" accept="image/png, image/jpeg, image/jpg, image/bmp" style="color: white; margin-top: 5px;" /> 
							</center>
						</p>
					</div>
			   </div>
            </div>
			<center>
     <input type="submit" name="buttonIII" class="btn btn-success" style="margin-bottom: 10px;"><p style="margin: 10px; color: white;" value="dalej" />
     </form></div>
	 <form method="post">
	 <input type="submit" name="po" class="btn btn-success" style="margin-bottom: 10px;" style="margin: 10px; color: white;" value="pomiń" />
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
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/jquery.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/bootstrap.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
