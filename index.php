<?php
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
    $viewsone = $connect->query("SELECT views FROM viddle_videos WHERE video_id = '$oneid';");
    $viewstwo = $connect->query("SELECT views FROM viddle_videos WHERE video_id = '$twoid';");
    $viewsthree = $connect->query("SELECT views FROM viddle_videos WHERE video_id = '$threeid';");
    $titleone = $connect->query("SELECT title FROM viddle_videos WHERE video_id = '$oneid';");
    $titletwo = $connect->query("SELECT title FROM viddle_videos WHERE video_id = '$twoid';");
    $titlethree = $connect->query("SELECT title FROM viddle_videos WHERE video_id = '$threeid';");
}
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
?>
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
                        <a href='video?id=8385178'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'>Pierwszy film</p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span>Kohady</span>
                            <span>•</span>
                            <span>17.5k wyświetleń</span>
                        </div>
                        </a>
                    </div>
                    <div class='card'>
                        <a href='video?id=8385178'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'>Testowa nazwa</p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span>PatryQHyper</span></a>
                            <span>•</span>
                            <span>1.3k wyświetleń</span>
                        </div>
			</a>
                    </div>
                    <div class='card'>
                        <a href='video?id=8385178'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'>Zrobione z nudów</p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span>Hekitu</span>
                            <span>•</span>
                            <span>9k wyświetleń</span>
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
            <div class="tile" style="margin: auto;">
                <div class='card'>
                        <a href='video?id=<?php echo($oneid); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($titleone); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($one); ?></span>
                            <span>•</span>
                            <span><?php echo($rezultat); ?> wyświetleń</span>
                        </div>
                        </a>
                    </div>
                    <div class='card'>
                        <a href='video?id=<?php echo($twoid); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($titletwo); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($two); ?></span></a>
                            <span>•</span>
                            <span><?php echo($rezultatdwa); ?> wyświetleń</span>
                        </div>
			</a>
                    </div>
                    <div class='card'>
                        <a href='video?id=<?php echo($threeid); ?>'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'><?php echo($titlethree); ?></p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        <div class='bottom-info'>
                            <span><?php echo($three); ?></span>
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
        <h5 class="modal-title" id="staticBackdropLabel">Wykryto adblocka!</h5>
      </div>
      <div class="modal-body">
        Rozumiemy to, że nie lubisz reklam. W końcu, to Twoja przeglądarka. Obecnie jest to nasze jedyne źródło zarobku (wyłączając dobrowolne datki), który przeznaczamy na opłacenie serwerów. Jeżeli nie chcesz wyłączać adblocka, przemyśl dodanie na listę wyjątków tej strony.
      </div>
      <div class="modal-footer">
	<button type="button" class="btn btn-blue-grey" style="padding: 10px;" data-dismiss="modal">Przejdź do Viddle</button>
      </div>
    </div>
  </div>
</div>
<?php 
require_once('partials/footer.php');
?>

<div class="hiddendiv common"></div></body></html>
