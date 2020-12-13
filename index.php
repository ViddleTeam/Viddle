<?php 
session_start();
if ($_SESSION['z1'] == true) {
	$avatar = 'test.png';
} else {
  $avatar = 'anonim.png';
}
?>

<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Viddle - strona główna</title>
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="VDP - polska alternatywa dla YouTube">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą VDP.">
	<script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
	<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
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
    <header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar top-nav-collapse" style="height: fit-content; background-color: #212121;">
    <a class="navbar-brand" href="index.php"><img src="https://cdn.ampersandbot.pl/p1X7yQuco.png" width="120px" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-6"
      aria-controls="navbarSupportedContent-6" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-6">
      <ul class="navbar-nav mr-auto">
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="index.php" title="Strona główna"><img src="https://media.discordapp.net/attachments/627764286785060899/725795384802410617/houm.png" width="20px"/> <p class="d-lg-none">Strona główna</p></a>
		</li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="trending.php" title="Popularne"><img src="https://media.discordapp.net/attachments/627764286785060899/725795329810628628/fajer.png" width="20px"/> <p class="d-lg-none">Popularne</p></a>
        </li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="discover.php" title="Odkrywaj"><img src="https://media.discordapp.net/attachments/627764286785060899/725795361268039811/dizkower.png" width="20px"/> <p class="d-lg-none">Odkrywaj</p></a>
        </li>
	  </div>
      </ul>
      <form class="form-inline" method="GET" action="search.php" style="margin-right: auto;">
        <input id="input_search" class="form-control mr-sm-2" style="width: 24rem; margin-top: 10px;" name="q" type="text" placeholder="Szukaj w Viddle" aria-label="Szukaj w Viddle">
      </form>
 
	<ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
	<div class="container row">
		<li class="nav-item">
		  <a class="nav-link" href="upload.php" title="Udostępnij film na VDP"><img src="https://media.discordapp.net/attachments/627873018990952448/726773229863305276/AAAAA.png" width="20px" style="color: white;" /> <p class="d-lg-none">Udostępnij film na VDP</p></a>
		</li>
	</div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="32px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $avatar ?>"></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
                        <?php if ($avatar == 'anonim.png') { ?>
                            <a class="dropdown-item waves-effect waves-light" href="login.php">Zaloguj się</a>
                        <?php } else { ?>
                            <a class="dropdown-item waves-effect waves-light" href="channel.php">Przejdź na kanał</a>
                            <a class="dropdown-item waves-effect waves-light" href="creatorstudio.php">Studio twórców</a>
                            <a class="dropdown-item waves-effect waves-light" href="#">Wyloguj się</a>
                        <?php } ?>
                    </div>
                </li>
            </ul>   
			</div>
  </nav>
      </header>
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
                        <a href='video.php'>
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
                        <a href='video.php'>
                        <img src='https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg' class='img-responsive card-img'>
                        <p class='card-title'>Testowa nazwa</p>
                        <div class='hr' style='margin-top:-5px;margin-bottom:5px;'></div>
                        </a><div class='bottom-info'><a href='video.php'>
                            </a><a href='channel.php'><span>PatryQHyper</span></a>
                            <span>•</span>
                            <span>1.3k wyświetleń</span>
                        </div>
                        
                    </div>
                    <div class='card'>
                        <a href='video.php'>
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
                <div class="card">
                    <a href="video.php">
                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                    <p class="card-title">Pierwszy film</p>
                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                    <div class="bottom-info">
                        <span>Kohady</span>
                        <span>•</span>
                        <span>17.5k wyświetleń</span>
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
<!-- JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>