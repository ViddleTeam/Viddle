<?php
session_start();
$id = $_GET['id'];
$uid = $_SESSION['uid'];
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$id))))
	
	$d2 = $result->num_rows;
	if($d2 == '1')
	{
		$dane = $result->fetch_assoc();
		
		$av5 = $dane['avatarname'];
		$nazwa = $dane['login'];
		$ba2 = $dane['banername'];
		// blagam zmieńcie observators na followers, poprawny angielski by sie przydał ;) - evo
		$obserwatorzy = $dane['observators'];
		
		if($av5 == 'x') {
			$av4 = 'anonim.png';
		} else {
			$av4 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$id.'/'.$id.'.'.$dane['avatarname'].'';
		}
		
		if($ba2 == 'x') {
			$ba3 = 'http://wallpapercave.com/wp/t05PXKg.jpg';
		} else {
			$ba3 = 'https://cdn.viddle.xyz/cdn/videos/banners/'.$_SESSION['uid'].'/'.$_SESSION['uid'].'.jpeg';
		}
		
		if($_SESSION['uid'] == $id) {
			$do = 1;
		} else {
			$do = 0;
		}
		//Liczba obserwacji
    		$resulttwo = $connect->query("SELECT * FROM viddle_followers WHERE followed='$id'");
 		$followcount = $resulttwo->num_rows;
		if ($_SESSION['z1'] == true) {
			$test = $connect->query("SELECT * FROM viddle_followers WHERE followed='$id' AND following='$uid'");
 			$followcount = $resulttwo->num_rows;
			if($followcount == 1) {
				$isfollowinguser = true;
			} else {
				$isfollowinguser = false;
			}
		} else {
			$isfollowinguser = false;
		}
	} else {
		header('location: index.php');
	}
    $title = "Konto ".$nazwa."";
    require_once('partials/navbar.php');
?>
<script>
$(document).ready(function(e) {
    $('#follow').on('submit',(function(e) {
	var form = $('form')[0];
	var formFata = new FormData(form);
        $.ajax({
            type: 'POST', 
            url: 'follow.php',
            data: formData,
            contentType: false,
            processData: false,
	    success:function(data){
	    	console.log("Zaobserwowano użytkownika!");
	    },
	    error:function(data){
	    	console.log("Wystąpił błąd");
	    }
        });
        return false;
	event.preventDefault();
    }));
});
</script>
	  <center>
      <div class="container my-5" style="margin-top:20px; margin: auto; justify-content: center;">
        <div class="row">
		<div class="banner mx-auto">
			<img class="img-fluid" src="<?php if (isset($ba3)) echo $ba3; ?>" style="margin: auto;" height="190px" width="1140px"/>
		</div>
			<div class="card-channel" style="height: 100px; width: 100%; margin-top: -30px; margin-left: 0px; margin-right: 0px;">
				<div class="card-body row" style="color: white;">
				<span style="margin-left: 10px; margin-bottom: 10px;">
					<img width="64px" height="64px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av4; ?>">
				</span>
				<span style="text-align: left; margin-left: 10px; margin-right: auto;">
					<h3 class="text-truncate"><?php echo $nazwa; ?></h3>
					<p style="text-align: left; margin-bottom: 20px;"><?php if (isset($followcount)) echo $followcount; ?> obserwujących</p>
				</span>
				<span style="margin-left: auto; margin-right: 10px;">
					<div class="row">
						<?php
						if ($do == '1') {
							echo '<a href="profilechange.php"><button type="button" class="btn btn-primary d-none d-md-block" style="padding: 10px;">Dostosuj kanał</button></a>';
						} else {
							if ($_SESSION['z1'] == true) {
								if($isfollowinguser == true) {
									echo '<form action="/follow.php" id="follow" method="POST"><input id="followid" name="followid" type="hidden" value="'.$id.'"><button type="submit" class="btn btn-primary" style="padding: 10px; background-color: #808080;">Obserwujesz</button></form>';
								} else {
									echo '<form action="/follow.php" id="follow" method="POST"><input id="followid" name="followid" type="hidden" value="'.$id.'"><button type="submit" class="btn btn-primary" style="padding: 10px;">Obserwuj</button></form>';
								}
							} else {
								echo '<button type="button" class="btn btn-primary" style="padding: 10px;" data-toggle="modal" data-target="#exampleModal">Obserwuj</button>';
							}
						}
						?>
					</div>
				</span>
				</div>
				
				
			</div>
			<div class="container" style="margin-top:20px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
            <h4 class="tile-before" style="color:white; margin-left: 10px;">Ostatnio udostępnione</h4>
          </div><br>
		<div class="container row" style="min-width: 100%">
				<?php
				try {
					if($res = $connect->query("SELECT * FROM viddle_videos WHERE publisher='$id' ORDER BY `publishdate` DESC")) {
						$num = $res->num_rows;
						if(!$num == '0') {
							while($dane = $res->fetch_assoc()) {
								$vid = $dane['video_id'];
								$v = $connect->query("SELECT * FROM `viddle_vievs` WHERE `vid`='$vid'");
								$vievs = $v->num_rows;
								if($dane['minname'] == 'x' ||$dane['minname'] == 'X') {
									$min = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
								} else {
									$min = 'https://cdn.viddle.xyz/cdn/videos/videos/'.$vid.'/'.$vid.'m.'.$dane['minname'].'';
								}
								echo '<div class="card">
								    <a href="video?id='.$vid.'">
								    <img width="300" height="187" src="'.$min.'" class="img-responsive card-img">
								    <p class="card-title">'.$dane['title'].'</p>
								    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
								    <div class="bottom-info">
									</a><span>'.$nazwa.'</span>
									<span>•</span>
									<span>'.$vievs.' wyświetleń</span>
								    </div>

								</div>';
							}
						} else {
							if($id == $_SESSION['uid']) {
								$error = '3';
							} else {
								$error = '2';
							}
							throw new Exception('pusto');
						}
					} else {
						$error = '1';
						throw new Exception('query error');
					}
				} catch (Exception $e) {
					if($error == '1') {
						echo '<div class="alert alert-danger" role="alert">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xu00001</div>';
					}
					
					if($error == '2') {
						echo '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Na tym kanale nie ma żadnych treści</div>';
					}
					
					if($error == '3') {
						echo '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Jeszcze niczego nie wrzuciłeś. Kliknij na ikone u góry by to zrobić</div>';
					}
				}
				
				?>
		</div>
	    <!--
	    // tutaj placeholdery do wyświetlania filmów
            // coś tutaj jeszcze sie zmieni, zobaczysz - evo
            <div class="tile" style="margin: auto;">
                <div class="card">
					<a href="video.php">
						<img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
						<p class="card-title">Testowa nazwa</p>
						<div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
						<div class="bottom-info">
						<span>SlaVistaPL</span>
						<span>-</span>
						<span>13k wyświetleń</span>
						</div>
					</a>
                </div>
                <div class="card">
                    <a href="video.php">
						<img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
						<p class="card-title">Testowa nazwa</p>
						<div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
						<div class="bottom-info">
						<span>SlaVistaPL</span>
						<span>-</span>
						<span>13k wyświetleń</span>
						</div>
					</a>
                </div>
                <div class="card">
                   <a href="video.php">
						<img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
						<p class="card-title">Testowa nazwa</p>
						<div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
						<div class="bottom-info">
						<span>SlaVistaPL</span>
						<span>-</span>
						<span>13k wyświetleń</span>
						</div>
					</a>
                </div>
            </div>
		-->
        </div>
      </div>
        </div>
		</center>
		</div>
<!-- modal dla niezalogowanych -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title">Musisz się zalogować, żeby skorzystać z tej funkcji.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Zarejestrowani użytkownicy mogą udostępniać filmy, oddawać głosy, czy pisać komentarze. Zaloguj się, lub zarejestruj, żeby móc skorzystać z tej funkcji.</p>
      </div>
      <div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px;">Zamknij okno</button>
	<a href="login.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Zaloguj się</button></a>
      </div>
    </div>
  </div>
</div>
<?php 
require_once('partials/footer.php');
?>
<div class="hiddendiv common"></div></body></html>
