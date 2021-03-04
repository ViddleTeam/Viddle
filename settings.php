<?php session_start();
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

echo '<html>data-target="nameModal"</html>';
if(!isset($_SESSION['uid'])) {
	header('location: index.php');
	exit();
}

?>
<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Viddle - ustawienia</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
	  <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
	<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
</head>
<body>
    <?php include 'partials/navbar.php'; ?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Ustawienia kanału</h4>
              </div>
            </div>
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="width: 100%;">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                  aria-selected="true">Strona główna</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="videos-tab" data-toggle="tab" href="#videos" role="tab" aria-controls="videos"
                  aria-selected="false">Filmy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="unsafe-tab" data-toggle="tab" href="#unsafe" role="tab" aria-controls="unsafe"
                  aria-selected="false">Niebezpieczna strefa</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent" style="margin-top: 10px;">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                Ustawienia podstawowe - od nazwy konta czy hasło, po adres mailowy.
                <div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px; margin-right: auto;">
                      <h4>Zmień nazwę kanału</h4>
                      <p style="text-align: left; margin-top: -6px;">Nie podoba się Tobie obecna nazwa? Możesz ją zawsze zmienić.</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                      <button type="button" class="btn btn-primary" style="margin-top: -10px;" data-toggle="modal" data-target="#nameModal"><p style="margin: 10px;">Zmień nazwę kanału</p></button>
                  </span>
                </div>
                <div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px; margin-right: auto;">
                      <h4>Zmień hasło</h4>
                      <p style="text-align: left; margin-top: -6px;">Jeżeli uważasz, że hasło do konta jest za proste, zmień je tutaj.</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                      <button type="button" class="btn btn-primary" style="margin-top: -10px;" data-toggle="modal" data-target="#passwordModal"><p style="margin: 10px;">Zmień hasło</p></button>
                  </span>
                </div>
                <div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px; margin-right: auto;">
                      <h4>Zmień adres e-mail</h4>
                      <p style="text-align: left; margin-top: -6px;">Zmieniłeś adres e-mail i chcesz otrzymywać dalej informacje o np. nowym logowaniu na Twoje konto?</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                      <button type="button" class="btn btn-primary" style="margin-top: -10px;" data-toggle="modal" data-target="#emailModal"><p style="margin: 10px;">Zmień adres e-mail</p></button>
                  </span>
                </div>
              </div>
              <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                Lista filmów na Twoim kanale. Możesz stąd edytować informacje o filmie (np. tytuł czy opis) albo je usunąć.<br>
              <?php
              $wyk = false;
              try {
                $uid = $_SESSION['uid'];
                if($res = $connect->query("SELECT * FROM `viddle_videos` WHERE `publisher`='$uid' ORDER BY `publishdate` DESC")) {
              $il = $res->num_rows;
                  
                  if(!$il == '0') {
                    $wyk = true;
                  } else {
                    $error = '2';
                    throw new Exception($il->error);
                  }
                } else {
                  $error = '1';
                  throw new Exception($res->error);
                }
              } catch(Exception $e) {
              }
              ?>
		      <?php 
		      if($wyk == true) {
			      $a = '0';
			      while($daneV = mysqli_fetch_assoc($res)) {
				      $a = $a + '1';
				      $vid = $daneV['video_id'];
				      $vievs = $connect->query("SELECT * FROM viddle_vievs WHERE vid='$vid'");
				      
				      $vievsII = $vievs->num_rows;
				      
                echo '<div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px;">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img" style="width: 160px;">
                  </span>
                  <span style="margin-left: 10px; margin-right: auto; align-items: center;">
                    <h4><a href="https://beta.viddle.xyz/channel?id='.$_SESSION['uid'].'">'.$daneV['title'].'</a></h4>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;">'.$vievsII.' wyświetleń, '.$daneV['upvotes'].' głosów pozytywnych</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                    <button type="button" class="btn btn-primary"><p style="margin: 10px;" data-toggle="modal" data-target="#editVideoModal'.$a.'">Edytuj informacje</p></button>
                    <button type="button" class="btn btn-danger"><p style="margin: 10px;" data-toggle="modal" data-target="#removeVideoModal">Usuń film</p></button>
                  </span>
                </div>';
				      //modal do edycji filmu
				      echo '<div class="modal fade" id="editVideoModal'.$a.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edytuj informacje o filmie '.$daneV['title'].'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Zmiany zostaną zastosowane w ciągu maksymalnie kilku minut.<br>
        <div class="md-form">
	<form method="post">
          <input type="text" id="videoName" class="form-control" name="title" style="color: white;">
          <label for="videoName">Nazwa filmu</label>
        </div>
        <div class="md-form">
          <textarea name="opis" id="videoDescription" class="md-textarea form-control" style="resize: none;" rows="3"></textarea>
          <label for="videoDescription">Opis filmu</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="submit" class="btn btn-primary"><p style="margin: 10px;" name="button'.$a.'">Potwierdź</p></button>
	</form>
      </div>
    </div>
  </div>
</div>'; 
				      if(isset($_POST['button'.$a])) {
					      $opis = mysqli_real_escape_string($connect, $_POST['opis']);
					      $title = mysqli_real_escape_string($connect, $_POST['title']);
					      
					      $opis = htmlentities($opis, ENT_QUOTES, "UTF-8");
					      $title = htmlentities($title, ENT_QUOTES, "UTF-8");
					      
					      if(empty($opis) && !empty($title)) {
						      $polecenie = "UPDATE `viddle_videos` SET `title`='$title' WHERE `video_id`='$vid'";
					      } else {
						      if(empty($title) && !empty($opis)) {
							      $polecenie = "UPDATE `viddle_videos` SET `opis`='$opis' WHERE `video_id`='$vid'";
						      } else {
							      if(empty($opis) || empty($title)) {
								      $polecenie = '';
							      } else {
								    $polecenie = "UPDATE `viddle_videos` SET `opis`='$opis' AND `title`='$title' WHERE `video_id`='$vid'";  
							      }
						      }
					      }
					      
					      if(!empty($polecenie)) {
					      		if($connect->query($polecenie)) {
								echo "<script>
								    $(function() { alert('Operacja na filmie powiodła się!') });
								</script>";
							} else {
								echo "<script>
								    $(function() { alert('Operacja na filmie nie powiodła się!') });
								</script>";
							}
						}
				}
		      ?>

		<?php		    
			      }
		        } ?>
              </div>
              <div class="tab-pane fade" id="unsafe" role="tabpanel" aria-labelledby="unsafe-tab">
                Strefa niebezpieczna to miejsce, w którym możesz usunąć wszystkie swoje filmy jednym kliknięciem, lub nawet skasować swoje konto.<br>
                <b>UWAGA:</b> te operacje są nieodwracalne!<br>
                <div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px; margin-right: auto;">
                      <h4>Zacznij od zera</h4>
                      <p style="text-align: left; margin-top: -6px;">Wszystkie Twoje filmy zostaną usunięte z Viddle. Liczba obserwujących, awatar i baner pozostaną nienaruszone.</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                      <button type="button" class="btn btn-danger" style="margin-top: -10px;" data-toggle="modal" data-target="#startOverModal"><p style="margin: 10px;">Zacznij od zera</p></button>
                  </span>
                </div>
                <div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                  <span style="margin-left: 10px; margin-right: auto;">
                      <h4>Zamknij swoje konto</h4>
                      <p style="text-align: left; margin-top: -6px;">
                        Wszystkie Twoje filmy, awatar oraz baner zostaną usunięte z Viddle, a licznik obserwujących zostanie wyzerowany.<br>
                        Po zażądaniu usunięcia konta zostaniesz automatycznie wylogowany i nie będziesz mógł się ponownie zalogować.
                      </p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                      <button type="button" class="btn btn-danger" style="margin-top: -10px;" data-toggle="modal" data-target="#accountCloseModal"><p style="margin: 10px;">Zamknij konto</p></button>
                  </span>
                </div>
              </div>
            </div>
      </div>

<!-- modale ustawień ogólnych, zmiana nazwy kanału -->
<div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmień nazwę kanału</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Zmiana zostanie zastosowana w ciągu maksymalnie kilku minut.<br>
        Nazwa powinna składać się z przynajmniej 4 znaków i nie być dłuższa niż 30 znaków.<br><br>
        Obecną nazwą stosowaną na Viddle jest <b>SlaVistaPL.</b><br>
        <div class="md-form">
          <input type="text" id="newName" class="form-control" style="color: white;">
          <label for="newName">Podaj nową nazwę konta</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>
<!-- zmiana hasła -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmień hasło</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Hasło powinno składać się z przynajmniej 8 znaków, mieć jedną dużą i małą literę oraz jeden znak specjalny.<br>
        <div class="md-form">
          <input type="password" id="newPassword" class="form-control" style="color: white;">
          <label for="newPassword">Nowe hasło</label>
        </div>
        <div class="md-form">
          <input type="password" id="confirmPassword" class="form-control" style="color: white;">
          <label for="confirmPassword">Potwierdź hasło</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>
<!-- zmiana adresu e-mail -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zmień adres e-mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Zostanie wysłany mail potwierdzający celem sprawdzenia, czy adres mailowy należy do Ciebie.<br>
        <div class="md-form">
          <input type="text" id="newMailAddress" class="form-control" style="color: white;">
          <label for="newMailAddress">Nowy adres e-mail</label>
        </div>
        <div class="md-form">
          <input type="text" id="confirmMailAddress" class="form-control" style="color: white;">
          <label for="confirmMailAddress">Potwierdź adres e-mail</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>

<!-- Filmy - modale -->
<div class="modal fade" id="editVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edytuj informacje o filmie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Zmiany zostaną zastosowane w ciągu maksymalnie kilku minut.<br>
        <div class="md-form">
          <input type="text" id="videoName" class="form-control" style="color: white;">
          <label for="videoName">Nazwa filmu</label>
        </div>
        <div class="md-form">
          <textarea id="videoDescription" class="md-textarea form-control" style="resize: none;" rows="3"></textarea>
          <label for="videoDescription">Opis filmu</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="removeVideoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Usunięcie filmu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Jesteś pewien, że chcesz usunąć ten film? Ta operacja jest nieodwracalna.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>

<!-- Strefa niebezpieczna - modale -->
<div class="modal fade" id="startOverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zacznij od zera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Jesteś pewien, że chcesz to zrobić?<br>
        Dla bezpieczeństwa potwierdź akcję poprzez wpisanie hasła do konta.
        <div class="md-form">
          <input type="password" id="passwordResetAccount" class="form-control" style="color: white;">
          <label for="passwordResetAccount">Wprowadź hasło</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="accountCloseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zażądaj usunięcia konta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        UWAGA: jest to operacja nieodwracalna! Wszystkie Twoje dane zostaną usunięte
        - włączając w to m.in. udostępnione filmy czy dane o obserwowanych przez Ciebie kanałach.<br>
        Zostaniesz po tym automatycznie wylogowany i <b>nie będziesz mógł się ponownie zalogować</b>.<br>
        Przed tym otrzymasz maila z zapytaniem o chęć usunięcia kanału, żeby uniknąć przypadkowego 
        usunięcia konta (lub poprzez osoby do tego nieupoważnione).<br><br>
        Dla bezpieczeństwa potwierdź akcję poprzez wpisanie hasła do konta.
        <div class="md-form">
          <input type="password" id="passwordRemoveAccount" class="form-control" style="color: white;">
          <label for="passwordRemoveAccount">Hasło</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><p style="margin: 10px;">Anuluj</p></button>
        <button type="button" class="btn btn-primary"><p style="margin: 10px;">Potwierdź</p></button>
      </div>
    </div>
  </div>
</div>

<!-- JS -->
<script src="script.js"></script>
<div class="hiddendiv common"></div></body></html>
