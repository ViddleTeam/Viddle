
<?php

$id = $_GET['id'];

echo $id;
if($id == 0)
{
    header('Location: index.php');
	exit();
}
else
{
    require "danesql.php";
    $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);

    if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
		    mysqli_real_escape_string($connect,$id))))

            $d2 = $result->num_rows;
			if(isset($d2) && $d2 == '1')
            {
               $dane = $result->fetch_assoc();

               $file =  $dane['fname'];
               $title =  $dane['title'];
               $opis = $dane['opis'];
               $views = $dane['vievs'];
               $komentarze = $dane['comments'];

            }
            else
            {
                header('Location: index.php');

            }
}
?>


<!DOCTYPE HTML>
<html lang="pl-PL"><head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php if(isset($title)) echo $title ?> na Viddle</title>
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="<?php if (isset($title)) echo $title ?> na Viddle">
    <meta property="og:description" content="<?php if (isset($opis)) echo $opis ?>">
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
      <div class="container" style="margin-top: 70px; justify-content: center;">
        <form>
          <div class="form-row">
            <div class="col-md-7">
              <div class="md-form form-group">
              <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=<?php echo "/video/'.$id.'/'.$file"; ?>&title=<?php echo $title ?>" type="video/mp4" width="100%" height="360" frameborder="0" allowfullscreen=""></iframe>
                <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 640px;">
                  <h4><?php echo $title ?></h4>
                  <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                    <img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="https://cdn.discordapp.com/avatars/645314415578841101/694defff96f3fe53f85260af628f3a7c.png">
                  </span>
                  <span style="margin-left: 10px; margin-right: auto;">
                    <h5 style="align-items: center;">SlaVistaPL</h5>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;">0 obserwujących</p>
                  </span>
                  <span style="margin-left: auto; margin-right: -20px;">
                    <button type="button" class="btn btn-success"><p style="margin: 10px;">Obserwuj</p></button>
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
                    	<h4 style="font-weight: bold;"><i class="fas fa-eye" style="margin-right: 5px;"></i> <?php echo $views; ?></h4>
                      <i class="fas fa-arrow-up" style="margin-right: 5px;"></i> 32 <i class="fas fa-arrow-down" style="margin-left: 10px; margin-right: 5px;"></i> 3
                    </span>
                    </div><br>
                    <p><?php echo $opis ?></p>
                </div>
                <div class="comments">
                  <h3>Komentarze (<?php echo $komentarze ?>)</h3>
                  <div class="container row">
                      <span>
                        <img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="https://cdn.discordapp.com/avatars/645314415578841101/694defff96f3fe53f85260af628f3a7c.png">
                      </span>
                      <span class="md-form my-0 mx-2" style="color: white !important;">
                          <input class="form-control mr-sm-2" style="color: white !important; width: 32rem;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz">
                      </span>
                  </div>
                  <div class="container row" style="margin-top: 10px;">
                    <span>
                      <img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="https://cdn.discordapp.com/avatars/645314415578841101/694defff96f3fe53f85260af628f3a7c.png">
                    </span>
                    <span class="md-form mx-2" style="color: white !important; margin-top: -45px;">
                        <h6 style="margin-left: 50px; margin-bottom: 10px; font-weight: bold;">SlaVistaPL • 3 minuty temu</h6>
                        <p style="text-align: left; margin-bottom: 18px; margin-top: -6px; margin-left: 50px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer laoreet ullamcorper dapibus. Proin placerat enim in neque tincidunt condimentum.</p>
                    </span>
                </div>
                </div>
              </div>
            </div>
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
		</div>		
      </div>
      
      <!-- modal do zgłoszenia filmu -->
      <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
<!-- JS -->
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/jquery.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/bootstrap.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
