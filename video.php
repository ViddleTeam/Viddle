<?php
session_start();
$id = $_GET['id'];
require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$uidtest = $_SESSION['id'];
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
        $data = $result->fetch_assoc();
        $publisher = $data['publisher'];
        $file = $data['fname'];
        $title = $data['title'];
        $opis = $data['opis'];
        $views = $data['views'];
        $comment_count = $data['comments'];
        $likes = $data['upvotes'];
        $dislikes = $data['downvotes'];
        $video_exists = true;
        if (!$opis) $opis = "Brak opisu dla tego filmu";
        if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE uid='%s'", mysqli_real_escape_string($connect, $publisher)))) $d2 = $result->num_rows;
        if ($d2 == '1') {
        }
    } else {
        $video_exists = false;
    }
    if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE uid='$publisher'", mysqli_real_escape_string($connect, $id)))) $d2 = $result->num_rows;
    if ($d2 == '1') {
        $data = $result->fetch_assoc();
        $observators = $data['observators'];
        $name = $data['login'];
        $uid = $data['uid'];
        $av6 = $data['avatarname'];
        $video_exists = true;
        if ($av6 == 'x') {
            $av7 = 'anonim.png';
        } else {
            $av7 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$publisher.'/'.$publisher.'.'.$av6. '';
        }
    } else {
        $video_exists = false;
    }
    //Liczba obserwacji
    $resulttwo = $connect->query("SELECT * FROM viddle_followers WHERE followed='$uid'");
    $followcount = $resulttwo->num_rows;
    if ($_SESSION['z1'] == true) {
	$test = $connect->query("SELECT * FROM viddle_followers WHERE followed='$uid' AND following='$uidtest'");
 	$followcount = $resulttwo->num_rows;
	if($followcount == 1) {
		$isfollowinguser = true;
	} else {
		$isfollowinguser = false;
	}
    } else {
	  $isfollowinguser = false;
    }
}
if ($resulto = @$connect->query(sprintf("SELECT * FROM viddle_obserwators WHERE obserwujący='%s' AND obserwuje='%s'", mysqli_real_escape_string($connect, $_SESSION['uid']), mysqli_real_escape_string($connect, $publisher)))) $ilosc = $resulto->num_rows;
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
if ($video_e == true) {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip2 = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip2 = $_SERVER['REMOTE_ADDR'];
    }
    if ($resultv = @$connect->query(sprintf("SELECT * FROM `viddle_vievs` WHERE ip='%s' AND vid='%s'", mysqli_real_escape_string($connect, $ip2), mysqli_real_escape_string($connect, $id)))) {
        $d3 = $resultv->num_rows;
        if ($d3 == '0') {
            $wstaw = $vievs + '1';
            if ($syf = @$connect->query(sprintf("UPDATE `viddle_videos` SET views='%s' WHERE video_id='%s'", mysqli_real_escape_string($connect, $wstaw), mysqli_real_escape_string($connect, $id)))) {
                if ($w = $connect->query("INSERT INTO `viddle_vievs` VALUES (NULL, '$id', '$ip2')")) {
                    header('location: ' . $_SERVER['REQUEST_URI'] . '');
                }
            }
        }
    }
}

$uid = $_SESSION['uid'];
$polecenie = "SELECT * FROM viddle_oceny WHERE uid='$uid'";
if ($c2 = $connect->query($polecenie)) {
    $cheack3 = $c2->num_rows;
    if ($cheack3 == '1') {
        $data10 = $c2->fetch_assoc();

        if ($data10['ocena'] == '1') {
            $like = 'color: #00c3ff;';
        } else {
            $dislike = 'color: #00c3ff;';
        }
    }
}
if (isset($_SESSION['uid'])) {
    $uidm = $_SESSION['uid'];
    $polecenie = "SELECT * FROM viddle_users WHERE uid='$uidm'";
    if ($c2 = $connect->query($polecenie)) {
        $d = $c2->fetch_assoc;
        $es = $d['emailver'];
        if ($es == '0') {
            $disable = 'pointer-events: none; cursor: default;';
            $powod = 'Musisz zweryfikować adres e-mail w celu oddania głosu na film.';
        } else {
            $disable = '';
            $powod = '';
        }
    }
} else {
    $disable = 'pointer-events: none; cursor: default;';
    $powod = '';
}
/*if (isset($_POST['comment'])) {
    $cmt = $_POST['comment'];
    $polecenie = sprintf('INSERT INTO viddle_comments (tresc, uid, published, videoid) VALUES (%s, %s, %s, %s)', $connect->real_escape_string($cmt, $_SESSION['uid'], new DateTime(), $_GET['id']));
    $connect->query($polecenie);
}*/

if($vievs = $connect->query("SELECT * FROM viddle_vievs WHERE vid='$id'")) {
	$viev = $vievs->num_rows;
}
?>
<?php
require_once("partials/navbar.php");
?>
<meta property="og:title" content="<?php echo $title; ?> na Viddle">
<meta property="og:opis" content="<?php echo $opis; ?>">
<meta property="theme-color" content="#e7698b">
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
<?php
if ($video_e == true) {
    ?>
    <div class="container" style="margin-top: 70px; justify-content: center;">
        <form>
            <div class="form-row">
                <div class="col-md-7">
                    <div class="md-form form-group">
                        <iframe src="https://cdn.plrjs.com/player/3ehs9nbnddz9a/5beqbolw927d.html?file=https://cdn.viddle.xyz/cdn/videos/videos/<?php echo $id . '/' . $file ?>&title=<?php echo $title ?>&autoplay=1" style="width: 100%; height: 360px;" frameborder="0" allowfullscreen></iframe>
                        <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 100%;">
                            <h4 class="text-truncate"><?php echo $title ?></h4>
                            <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=<?=$publisher ?>"><img width="48px" height="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?php echo $av7; ?>"></a>
                  </span>
                                <span style="margin-left: 10px; margin-right: auto;">
                                    <h5 style="align-items: center;"><a href="https://beta.viddle.xyz/channel?id=<?=$publisher ?>" class="videoprop"><?php echo $name; ?></a></h5>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?php echo $followcount ?> obserwujących</p>
                  </span>
                                <span style="margin-left: auto; margin-right: -20px;">
                                    <?php if ($uid != $publisher) { 
					if ($_SESSION['z1'] == true) {
						if($isfollowinguser == true) {
							echo '<button href="/follow.php?'.$uid.'" class="btn btn-primary" style="padding: 10px; background-color: #808080;">Obserwujesz</button>';
						} else {
							echo '<button href="/follow.php?'.$uid.'" class="btn btn-primary" style="padding: 10px;">Obserwuj</button>';
						}
					} else {
						echo '<button type="button" class="btn btn-primary" style="padding: 10px;" data-toggle="modal" data-target="#loginModal">Obserwuj</button>';
					}
                                    } else { ?>
                                        <span class="d-inline-block material-tooltip-main" tabindex="0" data-toggle="tooltip" title="Nie trzeba obserwować swojego kanału.">
                    <button class="btn btn-success" style="pointer-events: none" type="button" disabled>
                        <p style="margin: 10px;">Obserwuj</p>
                    </button>
                </span>
                                        <?php
                                    } ?>
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
                    	<h4 style="font-weight: bold;"><i class="fas fa-eye" style="margin-right: 5px;"></i> <?php echo $viev ?></h4>
                        <?php if ($_SESSION['z1']) { ?>
                        <span style='margin-right: 5px;'><a href="like.php?id=<?php echo $id ?>" class="videoprop"><i class="fas fa-arrow-up" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $likes ?></a></span> <a href="dislike.php?id=<?php echo $id ?>" class="videoprop"><i class="fas fa-arrow-down" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?></a>
                        <?php } else { ?>
                        <span data-toggle="tooltip" title="Zaloguj się, żeby móc oddać głos na film."><a href="like.php?id=<?php echo $id ?>" class="videoprop disabled"><i class="fas fa-arrow-up" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $likes ?></a> <a href="dislike.php?id=<?php echo $id ?>" class="videoprop disabled"><i class="fas fa-arrow-down" style="margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?></a></span>
                        <?php } ?>
                    </span>
			      
                                <?php echo $powod ?>
                            </div><br>
                            <p id="description" onclick="ecdesc()"><?php echo $opis ?></p>
                        </div>
                        <div class="comments">
                            <h3>Komentarze (<?=$comment_count ?>)</h3>
                            <div id="commentcont"></div>
                    <div class="container row">
                      <span>
                        <?php if ($_SESSION['z1']) {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://cdn.viddle.xyz/cdn/videos/avatars/' . $_SESSION['uid'] . '/' . $_SESSION['uid'] . '.' . $avatar . '">';
                        } else {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://beta.viddle.xyz/anonim.png">';
                        }
                        ?>
                      </span>
                    <form method="post">
                      <span class="md-form my-0 mx-2" style="color: white !important;">
			              <input class="form-control mr-sm-2 d-lg-block" style="color: white !important; width: 100%;" id="commentbox" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz" name="comment">
                      </span>
                        <input type="submit" class="btn btn-primary" style="padding: 10px;" value="Opublikuj">
				    </form>
                                <!--<form method="post" action="video?id=">
                                    <span class="md-form my-0 mx-2" style="color: white!important">
                                        <input class="form-control mr-sm-2 d-none d-lg-block"
                                               style="color: white !important; width: 32rem;"
                                               type="text"
                                               id="input"
                                               placeholder="Dodaj komentarz..."
                                               aria-label="Dodaj komentarz..."
                                               name="comment">
                                        <input class="btn btn-primary" type="submit" value="Opublikuj">
                                    </span>
                                </form>-->
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
                                    for ($k2 = 1;$k2 < $k1;$k2+= 1) {
                                        $ktresc = '';
                                        if ($comment = $pytanie = $connect->query("SELECT * FROM viddle_comments WHERE id2='$k2'")) {
                                            $data3 = $comment->fetch_assoc();
                                            $ktresc = $data3['tresc'];
                                            $kuid = '';
                                            $kdate = '';
                                            $dataczas = new DateTime('2022-05-01 09:33:59');
                                            $date = DateTime::createFromFormat('Y-m-d H:i:s', $data3['published']);
                                            $data = $dataczas->diff($date);
                                            $data->format('%y');
                                            if ($data3['videoid'] == $id) {
                                                $uiddd = $data3['uid'];
                                                if ($result4 = $connect->query("SELECT * FROM viddle_users WHERE uid='$uiddd'")) {
                                                    $data4 = $result4->fetch_assoc();
                                                    $kuav = $data4['avatarname'];
                                                    $kuname = $data4['login'];
                                                    $kuid = $data4['uid'];
                                                    if ($kuav == 'x') {
                                                        $av11 = 'anonim.png';
                                                    } else {
                                                        $av11 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$data3['uid'].'/'.$data3['uid'].'.'.$data4['avatarname'].'';
                                                    }
                                                    ?>
                                                    <!--<span class="md-form mx-2" style="color: white !important; margin-top: -45px; padding: 2px;">
		<img style="border-radius:50%;margin-right:5px; margin-top: 30px!important;" class="img-responsive" width="48px" src="<?php echo $av11 ?>">
                        <h6 style="margin-left: 55px; margin-bottom: 10px; font-weight: bold;"><?php echo $kuname ?> • <?php echo $data3['published'] ?></h6>
                        <p style="text-align: left; margin-top: -6px; margin-left: 55px;"><?php echo $ktresc ?></p>
                 </span>-->
                  <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=<?=$kuid ?>"><img width="48px" height="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?= $av11 ?>"></a>
                  </span>
                                    <span style="margin-left: 5px; margin-right: auto;">
                                        <h6 style="align-items: center; font-weight: bold;"><a href="https://beta.viddle.xyz/channel?id=<?=$kuid ?>" class="commentch"><?= $kuname ?></a> • <?= $data3['published'] ?></h6>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?= $ktresc ?></p>
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
                                <?php
                                if($res = $connect->query("SELECT * FROM `viddle_videos` ORDER BY RAND() LIMIT 5")) {
                                    while($v = $res->fetch_assoc()){
                                        $vid = $v['video_id'];
                                        $title = $v['title'];
                                        if(strlen($title) > '15') {
                                            $title = substr_replace($title, "...", 15);
                                        }
                                        $viev = $connect->query("SELECT * FROM viddle_vievs WHERE vid='$vid'");
                                        $vievs = $viev->num_rows;
                                        $uid = $v['publisher'];
                                        $us = $connect->query("SELECT * FROM viddle_users WHERE uid='$uid'");
                                        $user = $us->fetch_assoc();
                                        $min = $v['minname'];
                                        if($min == 'x' || $min == 'X') {
                                            $minscr = 'https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg';
                                        } else {
                                            $minscr = 'https://cdn.viddle.xyz/cdn/videos/videos/'.$vid.'/'.$vid.'m.'.$min;
                                        }
                                        echo '
                                        <a href="video?id='.$vid.'" class="videoprop">
                                            <div class="row">
                                                <img src="'.$minscr.'" width="160px" height="100px">
                                                <p style="margin-left: 10px; margin-top: 5px;"><strong>'.$title.'</strong><br>
                                                '.$user['login'].'<br>
                                                '.$vievs.' wyświetleń</p>
                                            </div>
                                        </a><br>';
                                    }
                                }
                                ?>
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
    require_once ("partials/footer.php");
} else {
    return;
}
?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title">Musisz się zalogować, żeby skorzystać z tej funkcji.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Zarejestrowani użytkownicy mogą udostępniać filmy, oddawać głosy, czy pisać komentarze. Zaloguj się, lub zarejestruj, żeby móc skorzystać z tej funkcji.</p>
      </div>
      <div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px;">Zamknij okno</button>
	<a href="login.php"><button type="button" class="btn btn-primary" style="padding: 10px;">Zaloguj się</button></a>
      </div>
    </div>
  </div>
</div>

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
<?php if ($video_e == false) {
    echo "<script>
		$('#staticBackdrop').modal('show');
	  </script>";
}
?>
<div class="hiddendiv common"></div>
</body></html>
