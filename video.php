
<?php
session_start();

function get_buttons()
{
	$bu1 = '';
	$bu2=array(
	
		1=>'<img src="partie/pis.png" style="width:100px;height:100px;">',
		2=>'<img src="partie/po.png" style="width:400px;height:100px;">',

	);
	
	while(list($bu3,$bu4)=each($bu2))
	{
		$bu1.='<div class="1">
		<button type="submit" name="btn_'.$bu3.'">'.$bu4.'</button> <br></br>
		</div>';
	}
	return $bu1;
}


if(isset($_SESSION['id']))
{
	header('location: video.php?id='.$_SESSION['id'].'');
}

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

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
    if ($d2 == '1') 
    {
        $dane = $result->fetch_assoc();
        $observators = $dane['observators'];
	$name = $dane['login'];
	$av6 = $dane['avatarname'];
	
        $video_exists = true;
	    
	
		
    } else {
        $video_exists = false;
    }
}

if($av6 == 'x')
{
	$av7 = 'anonim.png';
}
else
{
	$av7 = '/grafic/'.$publisher.'a.'.$av6.'';
}

if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_ WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$publisher))))
	

$_SESSION['id'] = $id;

?>


<!DOCTYPE HTML>
<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if (isset($title)) echo $title ?> na Viddle</title>
    <script src="https://kit.fontawesome.com/ca8376a2f4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content='<?php if (isset($title)) echo $title ?> na Viddle'>
    <meta property="og:description" content='<?php if (isset($opis)) echo $opis ?>'>
    <script src="script.js"></script>
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
    <?php
    require_once ('partials/navbar.php');
    ?>
    <div class="container" style="margin-top: 70px; justify-content: center;">
        <?php
        if ($video_exists == true) {
        ?>
	    
	    
        <form>
            <div class="form-row">
                <div class="col-md-7">
                    <div class="md-form form-group">
                        <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://viddlecdn.ml/videos/<?php echo $id ?>/<?php echo $file ?>&title=<?php echo $title ?>" type="video/mp4" width="100%" height="100%" frameborder="0" allowfullscreen=""></iframe>
                        <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 640px;">
                            <h4><?php echo $title ?></h4>
                            <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                    <img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?php echo $av7 ?>">
                  </span>
                                <span style="margin-left: 10px; margin-right: auto;">
                    <a href="channel?id=<?php echo $publisher ?>"><h5 style="align-items: center;"><?php echo $name ?></h5></a>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?php echo $observators ?> obserwujących</p>
                  </span>
                                <span style="margin-left: auto; margin-right: -20px;">
// 					<form action="<?php 
					$_SESSION['id'] = $id;
		
					header('location: video.php?id='.$_SESSION['id'].'')
					?>">
                    <input type="submit"value="Obserwuj' />
					</form>
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
                    	<h4 style="font-weight: bold;">
				  <i class="fas fa-eye" style="margin-right: 5px;"></i><?php echo $views ?></h4>
                      <button type="button" <i class="fas fa-arrow-up" style="margin-right: 5px;"></i></button> <?php echo $likes ?> <i class="fas fa-arrow-down" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?>
                    </span>
                            </div><br>
                            <p><?php echo $opis ?></p>
                        </div>
                        <div class="comments">
                            <h3>Komentarze (<?php echo $komentarze ?>)</h3>
                            <div class="container row">
                      <span>
			      <?php
				if($_SESSION['avatar'] == 'x')
				{
					$avatarkomentarze = '/avatardomyslny.jpg';
				}
			        else
				{
					$avatarkomentarze = '/grafic/'.$_SESSION['uid'].'a.'.$_SESSION['avatar'].'';
				}
		
		                if($_SESSION['avatar'] == '')
				{
					$avatarkomentarze = '/avatardomyslny.jpg';
				}
		?>
                        <img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="<?php echo $avatarkomentarze ?>">
                      </span>
                                <span class="md-form my-0 mx-2" style="color: white !important;">
					<form method='post' action='pcomment.php?id='.$id.''>
                          <input class="form-control mr-sm-2" disabled='disabled' name='com'  style="color: white !important; width: 32rem;" type="text" placeholder="(pisanie komentarzy jest tymczasowo niedostępne)" aria-label="(pisanie komentarzy jest tymczasowo niedostępne)">
                      </span>
					<?php 
			if($video_exists == false)
			{
					echo '<input type="submit" value="Opublikuj" class="btn btn-success" style="padding: 10px;"></a>';
			}
			   ?>
				    </form>
                            </div><br>
                            
                                    
					    <br></br>
					    <?php
		
			
		if ($result3 = @$connect->query(
		    sprintf("SELECT * FROM viddle_comments")))
			
		$d3 = $result3->num_rows;
					    
			
		
					if($d3 > '0')
					{
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
							
							    
							if($dane3['videoid'] == $id)
							{
								$uiddd = $dane3['uid'];
								
							if($result4 = $connect->query("SELECT * FROM viddle_users WHERE uid='$uiddd'"))
							{
								$dane4 = $result4->fetch_assoc();
								
								$kuav = $dane4['avatarname'];
								$kuname = $dane4['login'];
								$kuid = $dane4['uid'];
								
								if($kuav == 'x')
								{
									$av11 = 'anonim.png';
									
								}
								else
								{
									$av11 = '/grafic/'.$dane3['uid'].'a.'.$dane4['avatarname'].'';
								}
								
								
								echo '<div class="container row" style="margin-top: 10px;">
                                      <span>
                                        
                                      <img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="'.$av11.'">
								<span class="md-form mx-2" style="color: white !important; margin-top: -45px;">
                                          <h6 style="margin-left: 50px; margin-bottom: 10px; font-weight: bold;">'.$dane4['login'].' • '.$dane3['published'].' </h6>
                                          <p style="text-align: left; margin-bottom: 18px; margin-top: -6px; margin-left: 50px;">'.$dane3['tresc'].'</p>
                                      </span>
                                  </div>
                        </div>
                    </div>
		    </span>
                </div>';
							
							
							}
									}
							}
						}
					}
					
			
					    ?>
				     
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
<?php
} else if ($video_exists == false) {
    echo '';
}
?>
</div>
</div>

<!-- modal do zgłoszenia filmu -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<!-- brak filmu -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Film nie został znaleziony!</h5>
            </div>
            <div class="modal-body">
                Film może nie być dostępny, ponieważ nie istnieje lub został usunięty przez administratorów serwisu. Jeżeli wpisałeś ID filmu ręcznie, sprawdź czy się nie pomyliłeś.
            </div>
            <div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Powrót na stronę główną</button></a>
            </div>
        </div>
    </div>
</div>
<?php
require_once ('partials/footer.php');
?>
<?php
if ($video_exists == false) {
    echo "<script>
			$('#staticBackdrop').modal('show');
		</script>";
}
?>

<div class="hiddendiv common"></div></body></html>
