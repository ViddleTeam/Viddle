<?php
session_start();
$id = $_GET['id'];
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
		$obserwatorzy = $dane['observators'];
		
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
		
		if($_SESSION['uid'] == $id)
		{
			$do = '1';
		}
		else
		{
			$do = '0';
		}
		
		
		
	}	
	else
	{
		header('location: index.php');
	}
	


    $title = "".$nazwa." na Viddle";
    require_once('partials/navbar.php');
?>
	  <center>
      <div class="container my-5" style="margin-top:20px; margin: auto; justify-content: center;">
        <div class="row">
		<div class="banner mx-auto">
			<img class="img-fluid" src="<?php echo $ba3; ?>" style="margin: auto; " height="100%" width="100%"/>
		</div>
			<div class="card-channel" style="height: 100px; width: 100%; margin-top: -30px; margin-left: 0px; margin-right: 0px;">
				<div class="card-body row" style="color: white;">
				<span style="margin-left: 10px; margin-bottom: 10px;">
					<img width="64px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av4 ?>">
				</span>
				<span style="margin-left: 10px; margin-right: auto;">
					<h3 style="align-items: center;"><?php echo $nazwa ?></h3>
					<p style="text-align: left; margin-bottom: 20px;"><?php echo $obserwatorzy ?> obserwujących</p>
				</span>
				<span style="margin-left: auto; margin-right: 10px;">
					<div class="row">
						<?php
						if ($do == '1') {
							echo '<button type="button" class="btn btn-primary d-none d-md-block" style="padding: 10px;">Dostosuj kanał</button>';
							echo '<button type="button" class="btn btn-primary" style="padding: 10px;" data-toggle="toast" data-target="#toast_observator">Obserwuj</button>';
						} else {
							if ($_SESSION['z1'] == true) {
								echo '<button type="button" class="btn btn-primary" style="padding: 10px;" data-toggle="toast" data-target="#toast_observator">Obserwuj</button>';
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
            <h4 class="tile-before" style="color:white;">Ostatnio udostępnione</h4>
            </div>
            <div class="tile" style="margin: auto;">
                <div class="card">
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Testowa nazwa</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    </a><div class="bottom-info"><a href="video.php"></a>
					    <span>SlaVistaPL</span>
                        <span>•</span>
                        <span>13k wyświetleń</span>
                    </div>
                </div>
                <div class="card">
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Testowa nazwa</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    </a><div class="bottom-info"><a href="video.php"></a>
					    <span>SlaVistaPL</span>
                        <span>•</span>
                        <span>13k wyświetleń</span>
                    </div>
                </div>
                <div class="card">
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Jakiś projekt</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    </a><div class="bottom-info">
                        <span>SlaVistaPL</span>
                        <span>•</span>
                        <span>10k wyświetleń</span>
                    </div>
                </div>
            </div>
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

<!-- toast do obserwacji -->
<div class="toast bg-dark" id="alert_observator" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body">
      Obserwujesz teraz ten kanał.
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
