<?php
session_start();
$title = "Strona główna";
require_once('partials/navbar.php');
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(sprintf("SELECT * FROM viddle_recent WHERE number='%s'", mysqli_real_escape_string($connect, '1')))) $d2 = $result->num_rows;
if (isset($d2) && $d2 == '1') {
    $dane = $result->fetch_assoc();
    $one = $dane['viddle_recent_one_user'];
    $oneid = $dane['viddle_recent_one_id'];
    $two = $dane['viddle_recent_two_user'];
    $twoid = $dane['viddle_recent_two_id'];
    $three = $dane['viddle_recent_three_user'];
    $threeid = $dane['viddle_recent_three_id'];

    //Losowanie ID filmów:
    $randomvidone = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $dane = $randomvidone->fetch_assoc();
    $randomvidone = $dane['video_id'];
    $randomone = $dane['publisher'];
    do {
	$randomvidtwo = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    	$dane = $randomvidtwo->fetch_assoc();
    	$randomvidtwo = $dane['video_id'];
	$randomtwo = $dane['publisher'];
    } while ($randomvidtwo == $randomvidone);
    do {
	$randomvidthree = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    	$dane = $randomvidthree->fetch_assoc();
    	$randomvidthree = $dane['video_id'];
	$randomthree = $dane['publisher'];
    } while ($randomvidthree == $randomvidtwo or $randomvidthree == $randomvidone);
    //Wyświetlania wylosowanych filmów:
    $randomviewsone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
    $dane = $randomviewsone->fetch_assoc();
    $randomviewsone = $dane['views'];
    $randomviewstwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
    $dane = $randomviewstwo->fetch_assoc();
    $randomviewstwo = $dane['views'];
    $randomviewsthree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
    $dane = $randomviewsthree->fetch_assoc();
    $randomviewsthree = $dane['views'];
    //Twórcy wylosowanych filmów:
    $randomuserone = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomone';");
    $dane = $randomuserone->fetch_assoc();
    $randomuserone = $dane['login'];
    $randomusertwo = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomtwo';");
    $dane = $randomusertwo->fetch_assoc();
    $randomusertwo = $dane['login'];
    $randomuserthree = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomthree';");
    $dane = $randomuserthree->fetch_assoc();
    $randomuserthree = $dane['login'];
    //Tytuły wylosowanych filmów:
    $randomtitleone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
    $dane = $randomtitleone->fetch_assoc();
    $randomtitleone = $dane['title'];
    if(strlen($randomtitleone)>45) {
    	$randomtitleone = substr_replace($randomtitleone,"...",45);
    }
    $randomtitletwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
    $dane = $randomtitletwo->fetch_assoc();
    $randomtitletwo = $dane['title'];
    if(strlen($randomtitletwo)>45) {
    	$randomtitletwo = substr_replace($randomtitletwo,"...",45);
    }
    $randomtitlethree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
    $dane = $randomtitlethree->fetch_assoc();
    $randomtitlethree = $dane['title'];
    if(strlen($randomtitlethree)>45) {
    	$randomtitlethree = substr_replace($randomtitlethree,"...",45);
    }
    //Wyświetlenia najnowszych filmów:
    $viewsone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$oneid';");
    $dane = $viewsone->fetch_assoc();
    $viewsone = $dane['views'];
    $viewstwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$twoid';");
    $dane = $viewstwo->fetch_assoc();
    $viewstwo = $dane['views'];
    $viewsthree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$threeid';");
    $dane = $viewsthree->fetch_assoc();
    $viewsthree = $dane['views'];
    //Twórcy najnowszych filmów:
    $userone = $connect->query("SELECT * FROM viddle_users WHERE uid = '$one';");
    $dane = $userone->fetch_assoc();
    $userone = $dane['login'];
    $usertwo = $connect->query("SELECT * FROM viddle_users WHERE uid = '$two';");
    $dane = $usertwo->fetch_assoc();
    $usertwo = $dane['login'];
    $userthree = $connect->query("SELECT * FROM viddle_users WHERE uid = '$three';");
    $dane = $userthree->fetch_assoc();
    $userthree = $dane['login'];
    //Tytuły najnowszych filmów:
    $titleone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$oneid';");
    $dane = $titleone->fetch_assoc();
    $titleone = $dane['title'];
    if(strlen($titleone)>27) {
    	$titleone = substr_replace($titleone,"...",45);
    }
    $titletwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$twoid';");
    $dane = $titletwo->fetch_assoc();
    $titletwo = $dane['title'];
    if(strlen($titletwo)>27) {
    	$titletwo = substr_replace($titletwo,"...",45);
    }
    $titlethree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$threeid';");
    $dane = $titlethree->fetch_assoc();
    $titlethree = $dane['title'];
    if(strlen($titlethree)>27) {
    	$titlethree = substr_replace($titlethree,"...",45);
    }
}
//Zaokrąglanie wyświetleń najnowszych filmów:
if ($viewsone > 999 && $viewsone <= 999999) {
    $rezultat = floor($viewsone / 1000) . 'K';
} elseif ($value > 999999) {
    $rezulat = floor($viewsone / 1000000) . 'M';
} else {
    $rezultat = $viewsone;
}

if ($viewstwo > 999 && $viewstwo <= 999999) {
    $rezultatdwa = floor($viewstwo / 1000) . 'K';
} elseif ($value > 999999) {
    $rezulatdwa = floor($viewstwo / 1000000) . 'M';
} else {
    $rezultatdwa = $viewstwo;
}

if ($viewsthree > 999 && $viewsthree <= 999999) {
    $rezultattrzy = floor($viewsthree / 1000) . 'K';
} elseif ($value > 999999) {
    $rezulattrzy = floor($viewsthree / 1000000) . 'M';
} else {
    $rezultattrzy = $viewsthree;
}
//Zaokrąglanie wyświetleń wylosowanych filmów:
if ($randomviewsone > 999 && $randomviewsone <= 999999) {
    $randomrezultat = floor($randomviewsone / 1000) . 'K';
} elseif ($value > 999999) {
    $randomrezulat = floor($randomviewsone / 1000000) . 'M';
} else {
    $randomrezultat = $randomviewsone;
}

if ($randomviewstwo > 999 && $randomviewstwo <= 999999) {
    $randomrezultatdwa = floor($randomviewstwo / 1000) . 'K';
} elseif ($value > 999999) {
    $randomrezulatdwa = floor($randomviewstwo / 1000000) . 'M';
} else {
    $randomrezultatdwa = $randomviewstwo;
}

if ($randomviewsthree > 999 && $randomviewsthree <= 999999) {
    $randomrezultattrzy = floor($randomviewsthree / 1000) . 'K';
} elseif ($value > 999999) {
    $randomrezulattrzy = floor($randomviewsthree / 1000000) . 'M';
} else {
    $randomrezultattrzy = $randomviewsthree;
}


?>
<head>
	<!-- <script>
		$(document).ready(function(){
		    if($("#notify").width() > 0) {

		    } else {
			alert('AdBlocker Detected');
		    }
		});
	</script> -->
</head>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Wybrane dla Ciebie</h4>
              </div>
            </div>
                <div class='tile' style='margin: auto;'>
                    <div class='card'>
                        <a href='video?id=<?php echo($randomvidone); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($randomtitleone); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($randomuserone); ?></span>
                            <span>•</span>
                            <span><?php echo($randomrezultat); ?> wyświetleń</span>
                        </div>
                        </a>
                    </div>
                    <div class='card'>
                        <a href='video?id=<?php echo($randomvidtwo); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($randomtitletwo); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($randomusertwo); ?></span></a>
                            <span>•</span>
                            <span><?php echo($randomrezultatdwa); ?> wyświetleń</span>
                        </div>
			</a>
                    </div>
                    <div class='card'>
                        <a href='video?id=<?php echo($randomvidthree); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($randomtitlethree); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($randomuserthree); ?></span>
                            <span>•</span>
                            <span><?php echo($randomrezultattrzy); ?> wyświetleń</span>
                        </div>
                        </a>
                    </div>
            </div>
        </div>
	  <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white;">Ostatnio udostępnione filmy</h4>
              </div>
            </div>
		  <?php 
		  
		  if ($resultn1 = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
		    mysqli_real_escape_string($connect,$oneid))))
			
				    $dn1 = $resultn1->num_rows;
			    
			    	    $danen1 = $resultn1->fetch_assoc();
			    	    $avn1 = $danen1['minname'];
			    
			  	if($avn1 == 'x')
				{
					$avnf1 = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
				}
			    	else
				{
					$avnf1 = 'grafic/'.$oneid.'m.'.$avn1.'';
				}
		       		
		  
		  ?>
            <div class="tile" style="margin: auto;">
                <div class='card'>
                        <a href='video?id=<?php echo($oneid); ?>'>
                        <img src="<?php echo $avnf1; ?>" class="img-responsive card-img" width="300" height="187.5">
                        <p class='card-title'><?php echo($titleone); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($userone); ?></span>
                            <span>•</span>
                            <span><?php echo($rezultat); ?> wyświetleń</span>
                        </div>
                        </a>
                    </div>
                    <div class='card'>
			<?php
			    if ($resultn2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
		    mysqli_real_escape_string($connect,$twoid))))
			
				    $dn2 = $resultn2->num_rows;
			    
			    	    $danen2 = $resultn2->fetch_assoc();
			    	    $avn2 = $danen2['minname'];
			    
			  	if($avn2 == 'x')
				{
					$avnf2 = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
				}
			    	else
				{
					$avnf2 = '/grafic/'.$twoid.'m.'.$avn2.'';
				}
		       		
				    
			?>
                        <a href='video?id=<?php echo($twoid); ?>'>
                        <img src='<?php echo $avnf2 ?>' class="img-responsive card-img" width="300" height="187.5">
                        <p class='card-title'><?php echo($titletwo); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($usertwo); ?></span></a>
                            <span>•</span>
                            <span><?php echo($rezultatdwa); ?> wyświetleń</span>
                        </div>
			</a>
                    </div>
		  <?php
		  
		  if ($resultn3 = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
		    mysqli_real_escape_string($connect,$threeid))))
			
				    $dn3 = $resultn3->num_rows;
			    
			    	    $danen3 = $resultn3->fetch_assoc();
			    	    $avn3 = $danen3['minname'];
			    
			  	if($avn3 == 'x')
				{
					$avnf3 = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
				}
			    	else
				{
					$avnf3 = '/grafic/'.$thteeid.'m.'.$avn3.'';
				}
		  
		  ?>
                    <div class='card'>
                        <a href='video?id=<?php echo($threeid); ?>'>
                        <img src='<?php echo $avnf3 ?>' class='img-responsive card-img' width="300" height="187.5">
                        <p class='card-title'><?php echo($titlethree); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($userthree); ?></span>
                            <span>•</span>
                            <span><?php echo($rezultattrzy); ?> wyświetleń</span>
                        </div>
                        </a>
                    </div>
            </div>
        </div>
<!-- modal fuckadblock -->
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


<?php if (isset($_SESSION['ver']))
{
	unset($_SESSION['ver']);
    echo "<script>
		$('#staticBackdrop').modal('show');
	  </script>";
}
?>
<div class="hiddendiv common"></div>
<?php 
require_once('partials/footer.php');
?>
<div class="hiddendiv common"></div></body></html>
