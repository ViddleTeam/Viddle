<?php 
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$blad = '0';

	require_once('partials/navbar.php');		
?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;"></div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Odkrywaj twórców na Viddle</h4>
              </div>      
        <?php
			   $i = '0';
			   for($i += '1'; $i < '4';){
				   $los = @$connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1");
				   $dane = mysqli_fetch_assoc($los);
				   $vid = $dane['video_id'];
				   $uid = $dane['publisher'];
				   $u = @$connect->query("SELECT * FROM viddle_users WHERE uid='$uid'");
				   $user = $u->fetch_assoc();
				   $v = @$connect->query("SELECT * FROM viddle_vievs WHERE vid='$vid'");
				   $vievs = $v->num_rows;
				   $i = $i + '1';
				   echo '<div class="card">
                    <a href="video.php?id='.$vid.'">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">'.$dane['title'].'</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span>'.$user['login'].'</span>
                        <span>•</span>
                        <span>'.$vievs.' wyświetleń</span>
                    </div>
                    </a>';
			   }
	      ?>
        </div>
        </div>
<?php
  require_once('partials/footer.php');
?>
<div class="hiddendiv common"></div></body></html>
