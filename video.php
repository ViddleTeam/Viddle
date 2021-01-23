<?php
session_start();
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$polecenie = "SELECT * FROM viddle_videos WHERE video_id='$id'";
	if ($c = $connect->query($polecenie)) {
		$cheack2 = $c->num_rows;
		if($cheack2 == '1') {
			$video_e = true;
		} else {
			$video_e = false;
		}
	}


if($i = '1') {
	$form = '1';
} else {
	$form = '0';
}

if(isset($_POST['ob']))
$id = $_GET['id'];
$video_exists = true;
$_SESSION['id'] = $_GET['id'];

if ($id == 0) {
    $video_exists = false;
} else {
    $video_exists = true;
    if ($result = @$connect->query(sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'", mysqli_real_escape_string($connect, $id)))) $d2 = $result->num_rows;
    if (isset($d2) && $d2 == '1') {
        $dane = $result->fetch_assoc();
        $publisher = $dane['publisher'];
        $file = $dane['fname'];
        $title = $dane['title'];
        $opis = $dane['opis'];
        $views = $dane['views'];
        $komentarze = $dane['comments'];
	$likes = $dane['upvotes'];
	$dislikes = $dane['downvotes'];
        $video_exists = true;
        if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$publisher))))

            $d2 = $result->num_rows;
	    
	   
			if($d2 == '1')
			{
			}
	   
    } else {
        $video_exists = false;
    }
    if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE uid='$publisher'", mysqli_real_escape_string($connect, $id)))) 
	    
    $d2 = $result->num_rows;
    if ($d2 == '1') {
        $dane = $result->fetch_assoc();
        $observators = $dane['observators'];
	$name = $dane['login'];
	$av6 = $dane['avatarname'];
	
        $video_exists = true;
	    
	
		
    } else {
        $video_exists = false;
    }
}

if($av6 == 'x') {
	$av7 = 'anonim.png';
} else {
	$av7 = '/grafic/'.$publisher.'a.'.$av6.'';
}

if ($resulto = @$connect->query(
		    sprintf("SELECT * FROM viddle_obserwators WHERE obserwujący='%s' AND obserwuje='%s'",
		    mysqli_real_escape_string($connect,$_SESSION['uid']),
		    mysqli_real_escape_string($connect,$publisher))))
	$ilosc = $resulto->num_rows;

if($ilosc == '1') {
	$obm = '0';
} else {
	$obm = '1';
}

if (!isset($_SESSION['uid'])) {
	$obm = '0';
	$logged = '0';
} else {
	$logged = '1';
}
if($logged == '0') {
	$obd = 'disabled="disabled"';
} else {
	$obd = '';
}
$_SESSION['id'] = $id;

?>
<?php 
	require_once("partials/navbar.php");
?>
		 <?php
        if ($video_e == true) {
        ?>
      <div class="container" style="margin-top: 70px; justify-content: center;">
        <form>
          <div class="form-row">
            <div class="col-md-7">
              <div class="md-form form-group">
                <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://viddlecdn.ml/videos/2704396/".$file."&title=".$title."" style="width: 100%; height: 360px;" frameborder="0"></iframe>
                <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 100%;">
                  <h4><?php echo $title ?></h4>
                  <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                    <img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?php echo $av7 ?>">
                  </span>
                  <span style="margin-left: 10px; margin-right: auto;">
                    <h5 style="align-items: center;"><?php echo $name ?></h5>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?php echo $observators ?> obserwujących</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                    <button type="button" class="btn btn-success"><p style="margin: 10px;">Obserwuj</p></button>
                  </span>
			</div>
                  <div class="border border white" style="opacity: 0.45;"></div>
                  <div class="container row" style="margin-top: 20px;">
                    <span style="margin-left: 10px; margin-right: auto;">
                      <p style="text-align: left; margin-bottom: 20px; margin-top: -6px; cursor: pointer;" data-toggle="modal" data-target="#basicExampleModal">
                        <i class="fa fa-flag" aria-hidden="true" style="margin-right: 3px;"></i> Zgłoś film
                      </p>
                    </span>
                    <span style="margin-left: auto; margin-right: -20px; text-align: right;">
                    	<h4 style="font-weight: bold;"><i class="fas fa-eye" style="margin-right: 5px;"></i><?php echo $views ?></h4>
                      <i class="fas fa-arrow-up" style="margin-right: 5px;"></i> <?php echo $likes ?><i class="fas fa-arrow-down" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?>
                    </span>
                    </div><br>
                    <p><?php echo $opis ?></p>
                </div>
                <div class="comments">
                  <h3>Komentarze (<?php echo $komentarze ?>)</h3>
                  <div class="container row">
                      <span>
                        <img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="https://cdn.discordapp.com/avatars/645314415578841101/694defff96f3fe53f85260af628f3a7c.png">
                      </span>
			  <form method="post">
                      <span class="md-form my-0 mx-2" style="color: white !important;">
                          <input class="form-control mr-sm-2" style="color: white !important; width: 32rem;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz">
                      </span>
				  <input type="submit" class="btn btn-primary" style="padding: 10px;" value="Opublikuj">
				  
			  </form>
                  </div>
                  <div class="container row" style="margin-top: 10px;">
                    <span>
                     
                    </span>
			  <br></br>
			  <?php
		if ($result3 = @$connect->query(
		    sprintf("SELECT * FROM viddle_comments")))
		$d3 = $result3->num_rows;
					if($d3 > '0') {
						$pytanie = '$connect->query("SELECT * FROM viddle_comments")';
						$k1 = $d3 + '1';
						for($k2 = 1; $k2 < $k1; $k2 += 1)
						{
							$ktresc = '';
						    if($comment = $pytanie = $connect->query("SELECT * FROM viddle_comments WHERE id2='$k2'"))
						    {
							$dane3 = $comment->fetch_assoc();
							    
							$ktresc = $dane3['tresc'];
							$kuid = '';
							$kdate = '';
							    
							    $dataczas = new DateTime('2022-05-01 09:33:59');
							    
							    $date = DateTime::createFromFormat('Y-m-d H:i:s', $dane3['published']);
							    
							    $data = $dataczas->diff($date);
							    
							    $data->format('%y');
								    
							
								   
							    
							if($dane3['videoid'] == $id)
							{
								$uiddd = $dane3['uid'];	
							if($result4 = $connect->query("SELECT * FROM viddle_users WHERE uid='$uiddd'"))
							{
								$dane4 = $result4->fetch_assoc();
								$kuav = $dane4['avatarname'];
								$kuname = $dane4['login'];
								$kuid = $dane4['uid'];
								if($kuav == 'x') {
									$av11 = 'anonim.png';
								} else {
									$av11 = '/grafic/'.$dane3['uid'].'a.'.$dane4['avatarname'].'';
								}
								?> <br></br>
		<span class="md-form mx-2" style="color: white !important; margin-top: -45px;">
		<img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="<?php echo $av11 ?>">
                        <h6 style="margin-left: 55px; margin-bottom: 10px; font-weight: bold;"><?php echo $kuname ?> • <?php echo $dane3['published'] ?></h6>
                        <p style="text-align: left; margin-top: -6px; margin-left: 55px;"><?php echo $ktresc ?></p>
                 </span>
								<?php	}
								}
							}
						}
					}
		?>
                    
                </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="md-form form-group">
                <div style="width: auto; height: auto; cursor: default; padding-left: 15px;">
                    <h4 style="margin-bottom: 10px;">Inni również to oglądali</h4>
                    <div class="container">
                      <div class="row">
                          <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                          <p style="margin-left: 10px; margin-top: 5px;"><strong>Testowy film<br></strong>
                            SlaVistaPL<br>
                            6.1k wyświetleń</p>
                      </div>
                      <br>
                      <div class="row">
                        <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                        <p style="margin-left: 10px; margin-top: 5px;"><strong>Testowy film<br></strong>
                          SlaVistaPL<br>
                          6.1k wyświetleń</p>
                    </div>
                    <br>
                    <div class="row">
                      <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                      <p style="margin-left: 10px; margin-top: 5px;"><strong>Testowy film<br></strong>
                        SlaVistaPL<br>
                        6.1k wyświetleń</p>
                  </div>
                  <br>
                  <div class="row">
                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                    <p style="margin-left: 10px; margin-top: 5px;"><strong>Testowy film<br></strong>
                      SlaVistaPL<br>
                      6.1k wyświetleń</p>
                </div>
                <br>
                <div class="row">
                  <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                  <p style="margin-left: 10px; margin-top: 5px;"><strong>Testowy film<br></strong>
                    SlaVistaPL<br>
                    6.1k wyświetleń</p>
              </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
        </form>
		</div>		
      </div>
<?php } ?>

<?php if ($video_e == false) {
    echo "<script>
			$('#staticBackdrop').modal('show');
		</script>";
}
?>
      
      <!-- modal do zgłoszenia filmu -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zgłoś film jako nieodpowiedni</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Zamknij">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Za co chciałbyś/chciałabyś zgłosić ten film? Podaj poniżej powód.
<form class="md-form">
  <div class="md-form">
    <textarea id="textarea-char-counter" class="form-control md-textarea" rows="3" length="250" style="color: white; resize: none;"></textarea>
    <label for="textarea-char-counter" class="">Powód zgłoszenia oraz ewentualny komentarz</label>
<span class="character-counter" style="float: right; font-size: 12px; height: 1px;"></span></div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue-grey waves-effect waves-light" data-dismiss="modal"><p style="margin: 10px;">Zamknij</p></button>
        <button type="button" class="btn btn-danger waves-effect waves-light"><p style="margin: 10px;">Zgłoś film</p></button>
      </div>
    </div>
  </div>
</div>
<?php 
	require_once("partials/footer.php");
?>

<div class="hiddendiv common"></div></body></html>
