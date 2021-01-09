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
		// blagam zmieńcie observators na followers, poprawny angielski by sie przydał ;) - evo
		$obserwatorzy = $dane['observators'];
		
		if($av5 == 'x')
		{
			$av4 = 'anonim.png';
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
	


    $title = "Konto ".$nazwa."";
    require_once('partials/navbar.php');
?>
	  <center>
      <div class="container my-5" style="margin-top:20px; margin: auto; justify-content: center;">
        <div class="row">
		<div class="banner mx-auto">
			<img class="img-fluid" src="<?php if (isset($ba3)) echo $ba3; ?>" style="margin: auto; " height="100%" width="100%"/>
		</div>
			<div class="card-channel" style="height: 100px; width: 100%; margin-top: -30px; margin-left: 0px; margin-right: 0px;">
				<div class="card-body row" style="color: white;">
				<span style="margin-left: 10px; margin-bottom: 10px;">
					<img width="64px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php if (isset($av4)) echo $av4; ?>">
				</span>
				<span style="margin-left: 10px; margin-right: auto;">
					<h3 style="align-items: center;"><?php echo $nazwa; ?></h3>
					<p style="text-align: left; margin-bottom: 20px;"><?php if (isset($obserwatorzy)) echo $obserwatorzy; ?> obserwujących</p>
				</span>
				<span style="margin-left: auto; margin-right: 10px;">
					<div class="row">
						<?php
						if ($do == '1') {
							echo '<a href="profilechange.php"><button type="button" class="btn btn-primary d-none d-md-block" style="padding: 10px;">Dostosuj kanał</button></a>';
						} else {
							if ($_SESSION['z1'] == true) {
								echo '<button type="button" class="btn btn-primary" style="padding: 10px;">Obserwuj</button>';
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
            <h4 class="tile-before" style="color:white;">Ostatnio dodane</h4>
          </div><br>
				<?php
				
				if ($result3 = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE publisher='%s'",
		    mysqli_real_escape_string($connect,$id))))
					
		    $d4 = $result->num_rows;
				
		    if(!$d4 == '0')
		    {
			    $p1 = $connect->query("SELECT * FROM viddle_videos");
                    
                    if($p1->num_rows > 0){
                        $num = $p1->num_rows+1;
						
			
                        
                        for($k1 = 1; $k1 < $num; $k1 += 1){
                            if($k2 = $p1 = $connect->query("SELECT * FROM viddle_videos WHERE il='$k1'")){
                                $d5 = $k2->fetch_assoc();
                                
                               if($id == $d5['publisher'])
			       {
                                echo'
                                <div class="card">
                        <a href="video?id='.$d5['video_id'].'">
                        <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                        <p class="card-title">'.$d5['title'].'</p>
                        <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                        <div class="bottom-info">
                            <span>'.$nazwa.'</span>
                            <span>•</span>
                            <span>'.$d5['views'].' wyświetleń</span>
                        </div>
                        </a>
                    </div>
            </div>
        </div>';
                                
                            }
                        }
                    }
		    }
		    }
		    else
		    {
			    if ($do == '1') {
							echo '<div class="alert alert-info" style="width: 100%;">
									<strong>Aby dodać swój pierwszy film na twoim nowym kanale, kliknij na ikonę u góry obok panelu użytkownika.</strong>
								  </div>';
						} else {
								echo '<div class="alert alert-info" style="width: 100%;">
									  	<strong>'.$nazwa.' nie posiada żadnych filmów.</strong>
									  </div>';
						}
		    }	
						?>
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
