<?php

require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query("SELECT * FROM viddle_videos ORDER BY `views` DESC")) {
	$dane = $result->fetch_assoc();
	$onevideoid = $dane['video_id'];
	$onetytul = $dane['title'];
	$onevievs = $dane['views'];
	$onepublisher = $dane['publisher'];
	
	if ($result2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$onepublisher)))) {
		$udane = $result2->fetch_assoc();
		$oneusername = $udane['login'];
	}
	
	
}

if ($result = @$connect->query("SELECT * FROM viddle_videos WHERE `video_id` NOT LIKE '$onevideoid' ORDER BY `views` DESC ")) {
	$dane = $result->fetch_assoc();
	$twovideoid = $dane['video_id'];
	$twotytul = $dane['title'];
	$twovievs = $dane['views'];
	$twopublisher = $dane['publisher'];
	
	if ($result2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$twopublisher)))) {
		$udane = $result2->fetch_assoc();
		$twousername = $udane['login'];
	}
	
	
}

if ($result = @$connect->query("SELECT * FROM `viddle_videos` WHERE `video_id` NOT LIKE '$twovideoid' AND `video_id` NOT LIKE '$onevideoid' ORDER BY `views` DESC ")) {
	$dane = $result->fetch_assoc();
	$threevideoid = $dane['video_id'];
	$threetytul = $dane['title'];
	$threevievs = $dane['views'];
	$threepublisher = $dane['publisher'];
	
	if ($result2 = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		    mysqli_real_escape_string($connect,$threepublisher)))) {
		$udane = $result2->fetch_assoc();
		$threeusername = $udane['login'];
	}
	
	
}

?>
<?php 
	require_once('partials/navbar.php');		
    ?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Najpopularniejsze filmy na Viddle</h4>
              </div>
                <div class="card">
                    <?php echo "<a href='video.php?id=".$onevideoid ?>'> 
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title"><?php echo $onetytul ?></p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span><?php echo $oneusername ?></span>
                        <span>•</span>
                        <span><?php echo $onevievs ?> wyświetleń</span>
                    </div>
                    </a>
                </div>
                <div class="card">
                <?php echo "<a href='video.php?id=".$twovideoid ?>'> 
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title"><?php echo $twotytul ?></p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span><?php echo $twousername ?></span>
                        <span>•</span>
                        <span><?php echo $twovievs ?> wyświetleń</span>
                    </div>
                    </a>
                </div>
                <div class="card">
                <?php echo "<a href='video.php?id=".$threevideoid ?>'> 
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title"><?php echo $threetytul ?></p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span><?php echo $threeusername ?></span>
                        <span>•</span>
                        <span><?php echo $threevievs ?> wyświetleń</span>
                    </div>
                    </a>
                </div>
            </div>
            <footer class="page-footer font-small" style="background-color: #212121; margin-top: 30px;">
                <div class="footer-copyright text-center text-white py-3">
                    &copy; 2020-2021 Viddle Developers<br>
                    <a href="/attachments/privacypolicy.pdf">Polityka prywatności</a> • <a href="/attachments/termsofservice.pdf">Regulamin</a> • <a href="https://discord.gg/QsrbDtxWpn">Serwer Discord</a> • <a href="https://tipply.pl/u/SlaVistaPL">Wesprzyj rozwój Viddle</a><br>
                    Kontakt mailowy: <b>support@viddle.xyz</b>
                </div>
            </footer>
<div class="hiddendiv common"></div></body></html>
