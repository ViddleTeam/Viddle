<?php

require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

if ($result = @$connect->query("SELECT * FROM viddle_videos ORDER BY `views` DESC")) {
	$dane = $result->fetch_assoc();
	$onevideo_id = $dane['video_id'];
	$onetytul = $dane['title'];
	$onevievs = $dane['views'];
	$onepublisher = $dane['publisher'];
	
	if($result2 = @$connect->query("SELECT * FROM `viddle_users` WHERE `uid`='$onepublisher'")) {
		$udane = $result2->fetch_assoc();
		$oneusername = $dane['login'];
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
            </div>
            <div class="tile" style="margin: auto;">
                <div class="card">
			
                    <a href="video.php?id=".$onevideo_id."">
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
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Testowa nazwa</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    </a><div class="bottom-info"><a href="video.php">
                        </a><a href="channel.php"><span>PatryQHyper</span></a>
                        <span>•</span>
                        <span>1.3k wyświetleń</span>
                    </div>
                    
                </div>
                <div class="card">
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Zrobione z nudów</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span>Hekitu</span>
                        <span>•</span>
                        <span>9k wyświetleń</span>
                    </div>
                    </a>
                </div>
            </div>
        </div>
		<?php 
require_once('partials/footer.php');
?>

<div class="hiddendiv common"></div></body></html>
