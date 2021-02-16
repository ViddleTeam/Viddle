<?php
session_start();
$test = $_GET['button'];
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$polecenie = "SELECT * FROM viddle_videos WHERE video_id='$id'";
if ($c = $connect->query($polecenie)) {
    $cheack2 = $c->num_rows;
    if ($cheack2 == '1') {
        $video_e = true;
    } else {
        $video_e = false;
    }
}

if ($i = '1') {
    $form = '1';
} else {
    $form = '0';
}

if (isset($_POST['ob'])) $id = $_GET['id'];
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
        if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE uid='%s'", mysqli_real_escape_string($connect, $publisher))))

            $d2 = $result->num_rows;

        if ($d2 == '1') {
        }
    } else {
        $video_exists = false;
    }
    if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE uid='$publisher'", mysqli_real_escape_string($connect, $id))))
        $d2 = $result->num_rows;
    if ($d2 == '1') {
        $dane = $result->fetch_assoc();
        $observators = $dane['observators'];
        $name = $dane['login'];
        $uid = $dane['uid'];
        $av6 = $dane['avatarname'];
        $video_exists = true;
	if ($av6 == 'x') {
    		$av7 = 'anonim.png';
	} else {
    		$av7 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$publisher.'/'.$publisher.'.'.$av6.'';
	}
    } else {
        $video_exists = false;
    }
    //Liczba obserwacji
    $resulttwo = $connect->query("SELECT * FROM viddle_followers WHERE followed='$uid'");
    $followcount = $resulttwo->num_rows;
}

if ($resulto = @$connect->query(sprintf("SELECT * FROM viddle_obserwators WHERE obserwujący='%s' AND obserwuje='%s'", mysqli_real_escape_string($connect, $_SESSION['uid']) , mysqli_real_escape_string($connect, $publisher)))) $ilosc = $resulto->num_rows;

if ($ilosc == '1') {
    $obm = '0';
} else {
    $obm = '1';
}

if (!isset($_SESSION['uid'])) {
    $obm = '0';
    $logged = '0';
} else {
    $logged = '1';
}
if ($logged == '0') {
    $obd = 'disabled="disabled"';
} else {
    $obd = '';
}
$_SESSION['id'] = $id;

//nabijanie wyświetleń
if($video_e == true) {
	
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip2 = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip2 = $_SERVER['REMOTE_ADDR'];
}

if ($resultv = @$connect->query(sprintf("SELECT * FROM `viddle_vievs` WHERE ip='%s' AND vid='%s'", 
mysqli_real_escape_string($connect,$ip2),
mysqli_real_escape_string($connect,$id)))) {
	$d3 = $resultv->num_rows;
	
	if($d3 == '0') {
		$wstaw = $vievs + '1';
		if ($syf = @$connect->query(sprintf("UPDATE `viddle_videos` SET views='%s' WHERE video_id='%s'", 
		mysqli_real_escape_string($connect,$wstaw),
		mysqli_real_escape_string($connect,$id)))) {
			if($w = $connect->query("INSERT INTO `viddle_vievs` VALUES (NULL, '$id', '$ip2')")) {
			header('location: '.$_SERVER['REQUEST_URI'].'');
			}
		}
		
	}
	
}

}


//Losowanie ID polecanych filmów:
$randomvidone = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
$dane = $randomvidone->fetch_assoc();
$randomvidone = $dane['video_id'];
$randomone = $dane['publisher'];
do
{
    $randomvidtwo = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $dane = $randomvidtwo->fetch_assoc();
    $randomvidtwo = $dane['video_id'];
    $randomtwo = $dane['publisher'];
}
while ($randomvidtwo == $randomvidone);
do
{
    $randomvidthree = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $dane = $randomvidthree->fetch_assoc();
    $randomvidthree = $dane['video_id'];
    $randomthree = $dane['publisher'];
}
while ($randomvidthree == $randomvidtwo or $randomvidthree == $randomvidone);
do
{
    $randomvidfour = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $dane = $randomvidfour->fetch_assoc();
    $randomvidfour = $dane['video_id'];
    $randomfour = $dane['publisher'];
}
while ($randomvidfour == $randomvidthree or $randomvidfour == $randomvidtwo or $randomvidfour == $randomvidone);
do
{
    $randomvidfive = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $dane = $randomvidfive->fetch_assoc();
    $randomvidfive = $dane['video_id'];
    $randomfive = $dane['publisher'];
}
while ($randomvidfive == $randomvidfour or $randomvidfive == $randomvidthree or $randomvidfive == $randomvidtwo or $randomvidfive == $randomvidone);
//Wyświetlania wylosowanych polecanych filmów:
$randomviewsone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
$dane = $randomviewsone->fetch_assoc();
$randomviewsone = $dane['views'];
$randomviewstwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
$dane = $randomviewstwo->fetch_assoc();
$randomviewstwo = $dane['views'];
$randomviewsthree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
$dane = $randomviewsthree->fetch_assoc();
$randomviewsthree = $dane['views'];
$randomviewsfour = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfour';");
$dane = $randomviewsfour->fetch_assoc();
$randomviewsfour = $dane['views'];
$randomviewsfive = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfive';");
$dane = $randomviewsfive->fetch_assoc();
$randomviewsfive = $dane['views'];
//Twórcy wylosowanych polecanych filmów:
$randomuserone = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomone';");
$dane = $randomuserone->fetch_assoc();
$randomuserone = $dane['login'];
$randomusertwo = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomtwo';");
$dane = $randomusertwo->fetch_assoc();
$randomusertwo = $dane['login'];
$randomuserthree = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomthree';");
$dane = $randomuserthree->fetch_assoc();
$randomuserthree = $dane['login'];
$randomuserfour = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomfour';");
$dane = $randomuserfour->fetch_assoc();
$randomuserfour = $dane['login'];
$randomuserfive = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomfive';");
$dane = $randomuserfive->fetch_assoc();
$randomuserfive = $dane['login'];
//Tytuły wylosowanych polecanych filmów:
$randomtitleone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
$dane = $randomtitleone->fetch_assoc();
$randomtitleone = $dane['title'];
if (strlen($randomtitleone) > 27)
{
    $randomtitleone = substr_replace($randomtitleone, "...", 27);
}
$randomtitletwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
$dane = $randomtitletwo->fetch_assoc();
$randomtitletwo = $dane['title'];
if (strlen($randomtitletwo) > 27)
{
    $randomtitletwo = substr_replace($randomtitletwo, "...", 27);
}
$randomtitlethree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
$dane = $randomtitlethree->fetch_assoc();
$randomtitlethree = $dane['title'];
if (strlen($randomtitlethree) > 27)
{
    $randomtitlethree = substr_replace($randomtitlethree, "...", 27);
}
$randomtitlefour = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfour';");
$dane = $randomtitlefour->fetch_assoc();
$randomtitlefour = $dane['title'];
if (strlen($randomtitlefour) > 27)
{
    $randomtitlefour = substr_replace($randomtitlefour, "...", 27);
}
$randomtitlefive = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfive';");
$dane = $randomtitlefive->fetch_assoc();
$randomtitlefive = $dane['title'];
if (strlen($randomtitlefive) > 27)
{
    $randomtitlefive = substr_replace($randomtitlefive, "...", 27);
}
$uid = $_SESSION['uid'];

$polecenie = "SELECT * FROM viddle_oceny WHERE uid='$uid'";
if ($c2 = $connect->query($polecenie)) {
	$cheack3 = $c2->num_rows;
	
	if($cheack3 == '1') {
		$dane10 = $c2->fetch_assoc();
		
		if($dane10['ocena'] == '1') {
			$like = 'color: #00c3ff;';
		} else {
			$dislike = 'color: #00c3ff;';
		}
	}
}

if(isset($_SESSION['uid'])) {
	$uidm = $_SESSION['uid'];
	$polecenie = "SELECT * FROM viddle_users WHERE uid='$uidm'";
	if ($c2 = $connect->query($polecenie)) {
		$d = $c2->fetch_assoc;
		$ez = $d['emailver'];
		
		if($ez == '0') {
			$disable = 'pointer-events: none; cursor: default;';
			$powod = '(Musisz zweryfikować adres e-mail w celu zagłosowania na film.)';
		} else {
			$disable = '';
			$powod = '';
		}
	}
} else {
	$disable = 'pointer-events: none; cursor: default;';
	$powod = '';
}
?>
<?php
require_once ("partials/navbar.php");
?>
<meta property="og:title" content="<?php echo $title; ?> na Viddle">
<meta property="og:description" content="<?php echo $opis; ?>">
<meta property="theme-color" content="#e7698b">
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
<?php
if ($video_e == true)
{
    ?>
    <div class="container" style="margin-top: 70px; justify-content: center;">
        <form>
            <div class="form-row">
                <div class="col-md-7">
                    <div class="md-form form-group">
                        <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://cdn.viddle.xyz/cdn/videos/videos/<?php echo $id . '/' . $file ?>&title=<?php echo $title ?>" style="width: 100%; height: 360px;" frameborder="0" allowfullscreen></iframe>
                        <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 100%;">
                            <h4 class="text-truncate"><?php echo $title ?></h4>
                            <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=<?= $publisher ?>"><img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?php echo $av7; ?>"></a>
                  </span>
                                <span style="margin-left: 10px; margin-right: auto;">
                                    <h5 style="align-items: center;"><a href="https://beta.viddle.xyz/channel?id=<?= $publisher ?>"><?php echo $name ?></a></h5>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?php echo $followcount ?> obserwujących</p>
                  </span>
                                <span style="margin-left: auto; margin-right: -20px;">
                                    <?php if ($uid != $publisher) { ?>
		    <form action="/follow.php" method="POST">
                <input id="followid" name="followid" type="hidden" value="<?= $publisher ?>">
                <button type="submit" class="btn btn-success"><p style="margin: 10px;">Obserwuj</p></button>
		    </form>
		    <?php } else { ?>
                <span class="d-inline-block material-tooltip-main" tabindex="0" data-toggle="tooltip" title="Nie trzeba obserwować swojego kanału.">
                    <button class="btn btn-success" style="pointer-events: none" type="button" disabled>
                        <p style="margin: 10px;">Obserwuj</p>
                    </button>
                </span>
		    <?php } ?>
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
                    	<h4 style="font-weight: bold;"><i class="fas fa-eye" style="margin-right: 5px;"></i> <?php echo $views ?></h4>

                      <span style='margin-right: 5px;'><a style='<?php echo $disable ?>' href="like.php?id=<?php echo $id ?>"><i class="fas fa-arrow-up" <?php echo $like ?>"></i> <?php echo $likes ?></a></span> <a style='<?php echo $disable ?>' href="dislike.php?id=<?php echo $id ?>"><i class="fas fa-arrow-down" style="<?php echo $dislike ?> margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?></a>
                    </span>
				    <?php echo $powod ?>
                            </div><br>
                            <p><?php echo $opis ?></p>
                        </div>
                        <div class="comments">
                            <h3>Komentarze (<?php echo $komentarze ?>)</h3>
                            <div class="container row">
                      <span>
                        <?php if ($_SESSION['z1']) {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://cdn.viddle.xyz/cdn/videos/avatars/'.$_SESSION['uid'].'/'.$_SESSION['uid'].'.'.$avatar.'">';
                        } else {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://beta.viddle.xyz/anonim.png">';
                        } ?>
                      </span>
                                <form method="post">
                      <span class="md-form my-0 mx-2" style="color: white !important;">
                          <input class="form-control mr-sm-2 d-none d-lg-block" style="color: white !important; width: 32rem;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz">
			              <input class="form-control mr-sm-2 d-lg-none" style="color: white !important; width: 100%;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz" name="tresc1">
                      </span>
                                    <input type="submit" class="btn btn-primary" style="padding: 10px;" value="Opublikuj">

                                </form>
                            </div>
                            <div class="container row" style="margin-top: 10px;">
                    <span>
                    </span>
                                <br></br>
                                <?php
                                if ($result3 = @$connect->query(sprintf("SELECT * FROM viddle_comments"))) $d3 = $result3->num_rows;
                                if ($d3 > '0') {
                                    $pytanie = '$connect->query("SELECT * FROM viddle_comments")';
                                    $k1 = $d3 + '1';
                                    for ($k2 = 1;$k2 < $k1;$k2 += 1) {
                                        $ktresc = '';
                                        if ($comment = $pytanie = $connect->query("SELECT * FROM viddle_comments WHERE id2='$k2'")) {
                                            $dane3 = $comment->fetch_assoc();
                                            $ktresc = $dane3['tresc'];
                                            $kuid = '';
                                            $kdate = '';

                                            $dataczas = new DateTime('2022-05-01 09:33:59');
                                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dane3['published']);
                                            $data = $dataczas->diff($date);
                                            $data->format('%y');

                                            if ($dane3['videoid'] == $id) {
                                                $uiddd = $dane3['uid'];
                                                if ($result4 = $connect->query("SELECT * FROM viddle_users WHERE uid='$uiddd'")) {
                                                    $dane4 = $result4->fetch_assoc();
                                                    $kuav = $dane4['avatarname'];
                                                    $kuname = $dane4['login'];
                                                    $kuid = $dane4['uid'];
                                                    if ($kuav == 'x') {
                                                        $av11 = 'anonim.png';
                                                    } else {
                                                        $av11 = '/grafic/' . $dane3['uid'] . 'a.' . $dane4['avatarname'] . '';
                                                    }
                                                    ?> <br></br>
                                                    <span class="md-form mx-2" style="color: white !important; margin-top: -45px; padding: 2px;">
		<img style="border-radius:50%;margin-right:5px;" class="img-responsive" width="48px" src="<?php echo $av11 ?>">
                        <h6 style="margin-left: 55px; margin-bottom: 10px; font-weight: bold;"><?php echo $kuname ?> • <?php echo $dane3['published'] ?></h6>
                        <p style="text-align: left; margin-top: -6px; margin-left: 55px;"><?php echo $ktresc ?></p>
                 </span>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="md-form form-group">
                        <div style="width: auto; height: auto; cursor: default; padding-left: 15px;">
                            <h4 style="margin-bottom: 10px;">Polecane filmy</h4>
                            <div class="container">
                                <div class="row">
                                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                    <p style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitleone); ?><br></strong>
                                        <?php echo ($randomuserone); ?><br>
                                        <?php echo ($randomviewsone); ?> wyświetleń</p>
                                </div>
                                <br>
                                <div class="row">
                                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                    <p class="text-truncate" style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitletwo); ?><br></strong>
                                        <?php echo ($randomusertwo); ?><br>
                                        <?php echo ($randomviewstwo); ?> wyświetleń</p>
                                </div>
                                <br>
                                <div class="row">
                                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                    <p class="text-truncate" style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitlethree); ?><br></strong>
                                        <?php echo ($randomuserthree); ?><br>
                                        <?php echo ($randomviewsthree); ?> wyświetleń</p>
                                </div>
                                <br>
                                <div class="row">
                                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                    <p class="text-truncate" style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitlefour); ?><br></strong>
                                        <?php echo ($randomuserfour); ?><br>
                                        <?php echo ($randomviewsfour); ?> wyświetleń</p>
                                </div>
                                <br>
                                <div class="row">
                                    <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                    <p class="text-truncate" style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitlefive); ?><br></strong>
                                        <?php echo ($randomuserfive); ?><br>
                                        <?php echo ($randomviewsfive); ?> wyświetleń</p>
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
    <?php
} ?>

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
<?php
    if ($video_e == true) {
        require_once("partials/footer.php");
    } else {
        return;
    }
?>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Film nie został znaleziony!</h5>
            </div>
            <div class="modal-body">
                Być może film nie istnieje, lub został usunięty przez administratora. Jeżeli wpisywałeś/aś 
                ID filmu w pasku adresu URL ręcznie, upewnij się że nie dokonałeś/aś pomyłki.
            </div>
            <div class="modal-footer">
                <a href="/"><button type="button" class="btn btn-blue-grey waves-effect waves-light"><p style="margin: 10px;">Powrót na stronę główną</p></button></a>
            </div>
        </div>
    </div>
</div>
<?php if ($video_e == false)
{
    echo "<script>
		$('#staticBackdrop').modal('show');
	  </script>";
}
?>
<div class="hiddendiv common"></div></body></html>
