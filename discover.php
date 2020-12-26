<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Odkrywaj twórców - Viddle</title>
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
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Odkrywaj twórców na Viddle</h4>
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
            <?php
            require_once('partials/footer.php');
            ?>

<div class="hiddendiv common"></div></body></html>
