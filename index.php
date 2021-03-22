<?php
session_start();
$title = "Strona główna";
require_once('partials/navbar.php');
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

?>
    <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;"></div>
        </div>
        <div class="row">
            <div class="col-lg-12"> 
            <?php
		      if ($connect->connect_errno!=0) {
	            echo '<div class="alert alert-danger" role="alert">Error: '.$connect->connect_errno.'! Skontaktuj się z supportem!</div>';
              }
		      if ($_SESSION['emailver'] == '0') { ?> <br></br><br></br>
        <center><span class="alert alert-warning"><b>UWAGA:</b> część funkcji nie jest dostępna z powodu niezweryfikowanego adresu e-mail. <a href='mverify.php' class="alert-link">Zweryfikuj teraz</a></span></center>
        <?php } ?>
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Wybrane dla Ciebie</h4>
              </div>
            </div>

                <div class='tile' style='margin: auto;'>
			<?php 
			if($los = $connect->query("SELECT * FROM `viddle_videos`  ORDER BY RAND() LIMIT 3")) {
				while($wyl = $los->fetch_assoc()) {
					$vid = $wyl['video_id'];
					$userid = $wyl['publisher'];
					$v = $connect->query("SELECT * FROM viddle_vievs WHERE vid='$vid'");
					$vievs = $v->num_rows;
					$u = $connect->query("SELECT * FROM viddle_users WHERE uid='$userid'");
					$us = $u->fetch_assoc();
					if($wyl['minname'] == 'x' || $wyl['minname'] == 'X') {
						$minscr = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
					} else {
						$minscr = 'https://cdn.viddle.xyz/cdn/videos/videos/'.$vid.'/'.$vid.'m.'.$wyl['minname'];
					}
					echo "<div class='card'>
                        <a href='video?id=".$vid."'>
                        <img src='".$minscr."' width='300px' height='187px' class='img-responsive card-img'>
                        <p class='card-title'>".$wyl['title']."</p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span class='text-truncate'>".$us['login']."</span>
                            <span>•</span>
                            <span>".$vievs." wyświetleń</span>
                        </div>
                        </a>
                    </div>";
				}
			}
			?>
                    
            </div>
        </div>
	  <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="tile-before" style="color:white;">Ostatnio udostępnione filmy</h4>
            </div>
        </div>
        <div class="tile" style="margin: auto;">
		<?php
		    if ($new = $connect->query("SELECT * FROM `viddle_videos` ORDER BY `publishdate` DESC")) {
			   $i = '0';
			   for ($i += '1'; $i < '4';){
				   $dane = mysqli_fetch_assoc($new);
				   $i = $i + '1';
				   $vid = $dane['video_id'];
				   if ($dane['minname'] == 'x' || $dane['minname'] == 'X') {
					$min = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';   
				   } else {
					   $min = 'https://cdn.viddle.xyz/cdn/videos/videos/'.$vid.'/'.$vid.'m.'.$dane['minname'].'';
				   }
				   
				   $uid = $dane['publisher'];
			       $u = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid'");
				   $user = $u->fetch_assoc();
				   $v = $connect->query("SELECT * FROM viddle_vievs WHERE vid='$vid'");
				   $vievs = $v->num_rows;
				   echo '<div class="card">
                    <a href="video.php?id='.$dane['video_id'].'">
                    <img width="300px" height="187px" src="'.$min.'" class="img-responsive card-img">
                    <p class="card-title">'.$dane['title'].'</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    </a><div class="bottom-info"><a href="video.php?id='.$dane['video_id'].'">
                        </a><a href="channel.php?id='.$uid.'"><span style="text-align: left;">'.$user['login'].'</span></a>
                        <span>•</span>
                        <span style="text-align: left;">'.$vievs.' wyświetleń</span>
                    </div>
                </div>';
			   }
		    }
		?>
        </div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Weryfikacja adresu e-mail</h5>
      </div>
      <div class="modal-body">
        Na adres e-mail wysłaliśmy link do weryfikacji adresu e-mail. W celu zweryfikowania adresu e-mail wejdź na swojego e-maila i kliknij w nadesłany przez nas link
      </div>
      <div class="modal-footer">
	    <button type="button" class="btn btn-blue-grey" style="padding: 10px;" data-dismiss="modal">Przejdź do Viddle</button>
      </div>
    </div>
  </div>
</div>
<div class="hiddendiv common"></div>
<?php if (isset($_SESSION['ver'])) {
	unset($_SESSION['ver']);
}
require_once('partials/footer.php');
$connect->close();
?>
</body></html>
