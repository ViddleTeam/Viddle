<?php
session_start();
$test = $_GET['button'];
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
            $av7 = 'https://cdn.viddle.xyz/cdn/videos/avatars/' . $publisher . '/' . $publisher . '.' . $av6 . '';
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
//Losowanie ID polecanych filmów:
$randomvidone = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
$data = $randomvidone->fetch_assoc();
$randomvidone = $data['video_id'];
$randomone = $data['publisher'];
do {
    $randomvidtwo = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $data = $randomvidtwo->fetch_assoc();
    $randomvidtwo = $data['video_id'];
    $randomtwo = $data['publisher'];
} while ($randomvidtwo == $randomvidone);
do {
    $randomvidthree = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $data = $randomvidthree->fetch_assoc();
    $randomvidthree = $data['video_id'];
    $randomthree = $data['publisher'];
} while ($randomvidthree == $randomvidtwo or $randomvidthree == $randomvidone);
do {
    $randomvidfour = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $data = $randomvidfour->fetch_assoc();
    $randomvidfour = $data['video_id'];
    $randomfour = $data['publisher'];
} while ($randomvidfour == $randomvidthree or $randomvidfour == $randomvidtwo or $randomvidfour == $randomvidone);
do {
    $randomvidfive = $connect->query("SELECT * FROM viddle_videos ORDER BY RAND() LIMIT 1;");
    $data = $randomvidfive->fetch_assoc();
    $randomvidfive = $data['video_id'];
    $randomfive = $data['publisher'];
} while ($randomvidfive == $randomvidfour or $randomvidfive == $randomvidthree or $randomvidfive == $randomvidtwo or $randomvidfive == $randomvidone);
//Wyświetlania wylosowanych polecanych filmów:
$randomviewsone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
$data = $randomviewsone->fetch_assoc();
$randomviewsone = $data['views'];
$randomviewstwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
$data = $randomviewstwo->fetch_assoc();
$randomviewstwo = $data['views'];
$randomviewsthree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
$data = $randomviewsthree->fetch_assoc();
$randomviewsthree = $data['views'];
$randomviewsfour = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfour';");
$data = $randomviewsfour->fetch_assoc();
$randomviewsfour = $data['views'];
$randomviewsfive = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfive';");
$data = $randomviewsfive->fetch_assoc();
$randomviewsfive = $data['views'];
//Twórcy wylosowanych polecanych filmów:
$randomuserone = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomone';");
$data = $randomuserone->fetch_assoc();
$randomuserone = $data['login'];
$randomusertwo = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomtwo';");
$data = $randomusertwo->fetch_assoc();
$randomusertwo = $data['login'];
$randomuserthree = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomthree';");
$data = $randomuserthree->fetch_assoc();
$randomuserthree = $data['login'];
$randomuserfour = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomfour';");
$data = $randomuserfour->fetch_assoc();
$randomuserfour = $data['login'];
$randomuserfive = $connect->query("SELECT * FROM viddle_users WHERE uid = '$randomfive';");
$data = $randomuserfive->fetch_assoc();
$randomuserfive = $data['login'];
//Tytuły wylosowanych polecanych filmów:
$randomtitleone = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidone';");
$data = $randomtitleone->fetch_assoc();
$randomtitleone = $data['title'];
if (strlen($randomtitleone) > 27) {
    $randomtitleone = substr_replace($randomtitleone, "...", 27);
}
$randomtitletwo = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidtwo';");
$data = $randomtitletwo->fetch_assoc();
$randomtitletwo = $data['title'];
if (strlen($randomtitletwo) > 27) {
    $randomtitletwo = substr_replace($randomtitletwo, "...", 27);
}
$randomtitlethree = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidthree';");
$data = $randomtitlethree->fetch_assoc();
$randomtitlethree = $data['title'];
if (strlen($randomtitlethree) > 27) {
    $randomtitlethree = substr_replace($randomtitlethree, "...", 27);
}
$randomtitlefour = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfour';");
$data = $randomtitlefour->fetch_assoc();
$randomtitlefour = $data['title'];
if (strlen($randomtitlefour) > 27) {
    $randomtitlefour = substr_replace($randomtitlefour, "...", 27);
}
$randomtitlefive = $connect->query("SELECT * FROM viddle_videos WHERE video_id = '$randomvidfive';");
$data = $randomtitlefive->fetch_assoc();
$randomtitlefive = $data['title'];
if (strlen($randomtitlefive) > 27) {
    $randomtitlefive = substr_replace($randomtitlefive, "...", 27);
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
?>
<?php
require_once ("partials/navbar.php");
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
                        <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://cdn.viddle.xyz/cdn/videos/videos/<?php echo $id . '/' . $file ?>&title=<?php echo $title ?>" style="width: 100%; height: 360px;" frameborder="0" allowfullscreen></iframe>
                        <div class="card-videoch" style="padding: 12px; margin-top: 10px; cursor: default; width: 100%;">
                            <h4 class="text-truncate"><?php echo $title ?></h4>
                            <div class="container row" style="margin-top: 20px;">
                  <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=<?=$publisher ?>"><img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?php echo $av7; ?>"></a>
                  </span>
                                <span style="margin-left: 10px; margin-right: auto;">
                                    <h5 style="align-items: center;"><a href="https://beta.viddle.xyz/channel?id=<?=$publisher ?>"><?php echo $name ?></a></h5>
                    <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;"><?php echo $followcount ?> obserwujących</p>
                  </span>
                                <span style="margin-left: auto; margin-right: -20px;">
                                    <?php if ($uid != $publisher) { 
					if ($_SESSION['z1'] == true) {
						if($isfollowinguser == true) {
							echo '<button href="/follow.php?' . $uid . '" class="btn btn-primary" style="padding: 10px; background-color: #808080;">Obserwujesz</button>';
						} else {
							echo '<button href="/follow.php?' . $uid . '" class="btn btn-primary" style="padding: 10px;">Obserwuj</button>';
						}
					} else {
						echo '<button type="button" class="btn btn-primary" style="padding: 10px;" data-toggle="modal" data-target="#exampleModal">Obserwuj</button>';
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
                    	<h4 style="font-weight: bold;"><i class="fas fa-eye" style="margin-right: 5px;"></i> <?php echo $views ?></h4>

                      <span style='margin-right: 5px;'><div onclick="like()" style='<?php echo $disable ?>'><i class="fas fa-arrow-up" <?php echo $like ?>"></i> <?php echo $likes ?></div></span> <a style='<?php echo $disable ?>' href="dislike.php?id=<?php echo $id ?>"><i class="fas fa-arrow-down" style="<?php echo $dislike ?> margin-left: 10px; margin-right: 5px;"></i> <?php echo $dislikes ?></a>
                    </span>
			      <script>
			      function like() {
			      <?php 
	    			

if(!isset($_SESSION['uid'])) {
	$_SESSION['pol'] = true;
	header('location: video.php?id='.$id.'');
} else {

require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$uid = $_SESSION['uid'];

$r = '1';

if ($result = @$connect->query(
sprintf("SELECT * FROM viddle_videos WHERE video_id='%s'",
mysqli_real_escape_string($connect,$id)))) {
$d2 = $result->num_rows;
$data = $result->fetch_assoc();
	
$like = $data['upvotes'];
$dislike = $data['downvotes'];

if($d2 == '1')
{
	if ($result1 = @$connect->query(
	sprintf("SELECT * FROM viddle_oceny WHERE videoid='%s' AND uid='%s' AND ocena='%s'",
	mysqli_real_escape_string($connect,$id),
	mysqli_real_escape_string($connect,$_SESSION['uid']),
	mysqli_real_escape_string($connect,$r)))) 
	{
		$d3 = $result1->num_rows;
		
		if($d3 == '1')
		{
			echo '1';
			$w = $like - '1';
			if($gg = @$connect->query(
			sprintf("DELETE FROM viddle_oceny WHERE videoid='%s' AND uid='%s'",
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$uid)))) {
				echo '2';
				
				if($gg = @$connect->query(
				sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
				mysqli_real_escape_string($connect,$w),
				mysqli_real_escape_string($connect,$id)))) {
					echo '3';
					header('location: video.php?id='.$id.'');
				}
					
			}
		} else {
			$o = '0';
			if ($result2 = @$connect->query(
			sprintf("SELECT * FROM viddle_oceny WHERE videoid='%s' AND uid='%s' AND ocena='%s'",
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$_SESSION['uid']),
			mysqli_real_escape_string($connect,$o)))) 
			{
				$w = 
				$d4 = $result2->num_rows;
				
				if($d4 == '1')
				{
						echo '6';
			$w = $dislike - '1';
			$w2 = $like + '1';
			if($gg = @$connect->query(
			sprintf("UPDATE viddle_oceny SET ocena='%s' WHERE videoid='%s' AND uid='%s'",
			mysqli_real_escape_string($connect,$r),
			mysqli_real_escape_string($connect,$id),
			mysqli_real_escape_string($connect,$uid)))) {
				echo '2';
				if($gg = @$connect->query(
			sprintf("UPDATE viddle_videos SET downvotes='%s' WHERE video_id='%s'",
			mysqli_real_escape_string($connect,$w),
			mysqli_real_escape_string($connect,$id)))) {
					
					if($gg = @$connect->query(
			sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
			mysqli_real_escape_string($connect,$w2),
			mysqli_real_escape_string($connect,$id)))) {
						
						echo '3';
				
					header('location: video.php?id='.$id.'');
						
					}
					
				}
				
					
			}
					
				} else {
					$d = '1';
					if ($syf = @$connect->query(
					sprintf("INSERT INTO `viddle_oceny` VALUES (NULL,'%s','%s','%s')",
					mysqli_real_escape_string($connect,$uid),
					mysqli_real_escape_string($connect,$id),
					mysqli_real_escape_string($connect,$d))))
					{
						$w = $like + '1';
						if($gg = @$connect->query(
						sprintf("UPDATE viddle_videos SET upvotes='%s' WHERE video_id='%s'",
						mysqli_real_escape_string($connect,$w),
						mysqli_real_escape_string($connect,$id)))) {
							echo '3';
							header('location: video.php?id='.$id.'');
						}
						
					}
				}
			}
			
			
		}
	}
		
} else {
	header('location: index.php');
}

}
}	
	    			?>
			      }
			      </script>
                                <?php echo $powod ?>
                            </div><br>
                            <p><?php echo $opis ?></p>
                        </div>
                        <div class="comments">
                            <h3>Komentarze (<?=$comment_count ?>)</h3>
                            <div class="container row">
                      <span>
                        <?php /*if ($_SESSION['z1']) {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://cdn.viddle.xyz/cdn/videos/avatars/' . $_SESSION['uid'] . '/' . $_SESSION['uid'] . '.' . $avatar . '">';
                        } else {
                            echo '<img style="border-radius: 50%; margin-right: 8px;" class="img-responsive" width="48px" src="https://beta.viddle.xyz/anonim.png">';
                        }*/
                        ?>
                      </span>
                                <!--<form method="post" action="comment.php">
                      <span class="md-form my-0 mx-2" style="color: white !important;">
                          <input
                                  class="form-control mr-sm-2 input-block-level"
                                  type="text"
                                  id="input"
                                  placeholder="Dodaj komentarz..."
                                  aria-label="Dodaj komentarz"
                                  name="comment"
                          >
                          <input class="form-control mr-sm-2 d-none d-lg-block" style="color: white !important; width: 32rem;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz" name="comment">
			              <input class="form-control mr-sm-2 d-lg-none" style="color: white !important; width: 100%;" type="text" placeholder="Dodaj komentarz" aria-label="Dodaj komentarz" name="comment">
                      </span>
                                    <input type="submit" class="btn btn-primary" style="padding: 10px;" value="Opublikuj">

                                </form>-->
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
                                <form method="post" action="video.php">

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
                                                        $av11 = '/grafic/' . $data3['uid'] . 'a.' . $data4['avatarname'] . '';
                                                    }
                                                    ?>
                                                    <!--<span class="md-form mx-2" style="color: white !important; margin-top: -45px; padding: 2px;">
		<img style="border-radius:50%;margin-right:5px; margin-top: 30px!important;" class="img-responsive" width="48px" src="<?php echo $av11 ?>">
                        <h6 style="margin-left: 55px; margin-bottom: 10px; font-weight: bold;"><?php echo $kuname ?> • <?php echo $data3['published'] ?></h6>
                        <p style="text-align: left; margin-top: -6px; margin-left: 55px;"><?php echo $ktresc ?></p>
                 </span>-->
                  <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=<?=$kuid ?>"><img width="48px" style="border-radius:50%; margin-right:5px;" class="img-responsive d-none d-md-block" src="<?= $av11 ?>"></a>
                  </span>
                                    <span style="margin-left: 10px; margin-right: auto;">
                                    <h6 style="align-items: center; font-weight: bold;"><a href="https://beta.viddle.xyz/channel?id=<?=$kuid ?>"><?= $kuname ?> • <?= $data3['published'] ?></a></h6>
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
                                <a href="/video?id=<?=$randomvidone
                                ?>">
                                    <div class="row">
                                        <img src="https://www.serialio.com/sites/default/files/styles/card/public/2017-12/placeholder_600x400.png?itok=EetlztMJ" width="35%">
                                        <p style="margin-left: 10px; margin-top: 5px;"><strong><?php echo ($randomtitleone); ?><br></strong>
                                            <?php echo ($randomuserone); ?><br>
                                            <?php echo ($randomviewsone); ?> wyświetleń</p>
                                    </div>
                                </a>
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
    require_once ("partials/footer.php");
} else {
    return;
}
?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
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
<div class="hiddendiv common"></div><script type="text/javascript">
    var ezCanEngagePage = false;
    (function() {
        var attachEvent = function(element, evt, func) {
            if (element.addEventListener) {
                element.addEventListener(evt, func, false);
            } else {
                element.attachEvent("on" + evt, func);
            }
        };
        attachEvent(document.body, "ezPageEngageable", function (e) {
            ezCanEngagePage = true;
        });
        attachEvent(document.body, "ezCMPComplete", function (e) {
            if (typeof(_ezaq) !== "undefined"){
                __ez.bit.AddAndFire(_ezaq["page_view_id"], [(new __ezDotData('pageview_updated_t_time', Date.now()))]);
            }
        });
    })();</script>
<script type="text/javascript">var cmpCookies={};cmpCookies["3"]=["ezoab_244621=mod48; Path=/; Domain=beautifytools.com; Expires=Tue, 16 Feb 2021 23:36:07 UTC","ezoadgid_244621=-1; Path=/; Domain=beautifytools.com; Expires=Tue, 16 Feb 2021 23:36:07 UTC","ezoref_244621=google.pl; Path=/; Domain=beautifytools.com; Expires=Wed, 17 Feb 2021 01:06:07 UTC"];
</script>

<script>
    var __ezCmpConfig = {
        version: 4,
        pageIsEngageable: false,
        results: {"domain":".beautifytools.com","contentData":{"languages":{"de":"de","en":"en","es":"es","fr":"fr","it":"it"},"list":[{"id":106,"did":0,"language":"en","dialogHeading":"This website uses cookies","dialogBody":"This website use cookies to personalize content, provide custom experiences, target ads, to provide social media features and to analyse our traffic. We also share information about your use of our site with our social media, advertising and analytics partners who may combine it with other information that you've provided to them or that they've collected from your use of their services. Below you have the option of selecting which types of cookies you'll allow to store your personal information. To view the vendor list or change consent settings at any time please visit our privacy policy using the link below.","declineButton":"Allow Necessary Cookies \u0026 Continue","acceptButton":"Continue with Recommended Cookies","okButton":"Save","cookieInfo":"Cookies are small text files that can be used by websites to make a user's experience more efficient.\r\n\r\nThe law states that we can store cookies that contain personal information on your device if they are strictly necessary for the operation of this site. For all other types of cookies that contain personal information we need your permission.\r\n\r\nThis site uses different types of cookies. Some cookies are placed by third party services that appear on our pages.","necessaryCategory":"Necessary","necessaryopis":"Necessary cookies help make a website usable by enabling basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.                            ","preferenceCategory":"Preferences","preferenceopis":"Preference cookies enable a website to remember information that changes the way the website behaves or looks, like your preferred language or the region that you are in.","statisticsCategory":"Statistics","statisticsopis":"Statistic cookies help website owners to understand how visitors interact with websites by collecting and reporting information anonymously.","marketingCategory":"Marketing","marketingopis":"Marketing cookies are used to track visitors across websites. The intention is to display ads that are relevant and engaging for the individual user and thereby more valuable for publishers and third party advertisers.","unclassifiedCategory":"Unclassified","unclassifiedopis":"Unclassified cookies are cookies that we are in the process of classifying, together with the providers of individual cookies.","cookieDetailsLink":"Cookie Details","aboutCookiesLink":"About Cookies","privacyPolicyLink":"Privacy Policy","columnName":"Name","columnPurpose":"Purpose","columnPII":"May Contain Personal Information","columnDuration":"Duration","mainHeading":"Privacy \u0026 Transparency","purposes":"Purposes","legitimateInterest":"Legitimate Interest","consent":"Consent","specialPurposes":"Special Purposes","manageSettings":"Manage Settings","saveSettings":"Save Settings \u0026 Exit","vendors":"Vendor List","nonTcfVendors":"Additional Vendors","features":"Features","specialFeatures":"Special Features","acceptAllButton":"Accept All \u0026 Continue","purposePrefix":"We and our partners use cookies to ","stackPrefix":"We and our partners use data for ","mainBody":"An example of data being processed may be a unique identifier stored in a cookie. Some of our partners may process your data as a part of their legitimate business interest without asking for consent. To view the purposes they believe they have legitimate interest for, or to object to this data processing use the vendor list link below. The consent submitted will only be used for data processing originating from this website. If you would like to change your settings or withdraw consent at any time, the link to do so is in our privacy policy accessible from our home page."},{"id":107,"did":0,"language":"fr","dialogHeading":"Ce site web utilise des cookies","dialogBody":"Nous utilisons des cookies pour personnaliser le contenu et les publicités, pour fournir des fonctionnalités de médias sociaux et pour analyser notre trafic. Nous partageons également des informations sur votre utilisation de notre site avec nos partenaires de médias sociaux, de publicité et d'analyse qui peuvent les combiner avec d'autres informations que vous leur avez fournies ou qu'ils ont collectées à partir de votre utilisation de leurs services. S'il vous plaît lire plus sur notre page de politique de confidentialité. Pour consulter la liste des fournisseurs ou modifier les paramètres de consentement à tout moment, veuillez consulter notre politique de confidentialité en utilisant le lien ci-dessous.","declineButton":"Utilisez les cookies nécessaires uniquement et continuez","acceptButton":"Autoriser tous les cookies et continuer","okButton":"D'accord","cookieInfo":"Les cookies sont de petits fichiers texte qui peuvent être utilisés par les sites Web pour rendre l'expérience utilisateur plus efficace.\r\n\r\nLa loi stipule que nous pouvons stocker des cookies sur votre appareil s'ils sont strictement nécessaires au fonctionnement de ce site. Pour tous les autres types de cookies, nous avons besoin de votre permission.\r\n\r\nCe site utilise différents types de cookies. Certains cookies sont placés par des services tiers qui apparaissent sur nos pages.","necessaryCategory":"Nécessaire","necessaryopis":"Les cookies nécessaires permettent de rendre un site Web utilisable en activant des fonctions de base telles que la navigation dans les pages et l'accès à des zones sécurisées du site Web. Le site Web ne peut pas fonctionner correctement sans ces cookies.","preferenceCategory":"Préférences","preferenceopis":"Les cookies de préférence permettent à un site Web de mémoriser des informations qui modifient le comportement ou l'aspect du site Web, comme votre langue préférée ou la région dans laquelle vous vous trouvez.","statisticsCategory":"Statistiques","statisticsopis":"Les cookies statistiques aident les propriétaires de sites Web à comprendre comment les visiteurs interagissent avec les sites Web en collectant et en signalant les informations de manière anonyme.","marketingCategory":"Commercialisation","marketingopis":"Les cookies de marketing sont utilisés pour suivre les visiteurs sur les sites Web. L'intention est d'afficher des publicités pertinentes et engageantes pour l'utilisateur individuel et donc plus utiles pour les éditeurs et les annonceurs tiers.","unclassifiedCategory":"Non classé","unclassifiedopis":"Les cookies non classés sont des cookies que nous sommes en train de classer, ainsi que les fournisseurs de cookies individuels.","cookieDetailsLink":"Détails du cookie","aboutCookiesLink":"À propos des cookies","privacyPolicyLink":"Politique de confidentialité","columnName":"Prénom","columnPurpose":"Objectif","columnPII":"Peut contenir des informations personnelles","columnDuration":"Durée","mainHeading":"Confidentialité et Transparence","purposes":"Objectifs","legitimateInterest":"Intérêt Légitime","consent":"Consentement","specialPurposes":"Objectifs Spéciaux","manageSettings":"Gérer les Paramètres","saveSettings":"Enregistrer les Paramètres","vendors":"Liste de Fournisseurs","nonTcfVendors":"Fournisseurs Supplémentaires","features":"Caractéristiques","specialFeatures":"Particularités","acceptAllButton":"Accepter Tout et Continuer","purposePrefix":"Nous et nos partenaires utilisons des cookies pour ","stackPrefix":"Nous et nos partenaires utilisons les données pour ","mainBody":"Un exemple de données traitées peut être un identifiant unique stocké dans un cookie. Certains de nos partenaires peuvent traiter vos données dans le cadre de leurs intérêts commerciaux légitimes sans vous demander votre consentement. Pour connaître les raisons pour lesquelles ils estiment avoir un intérêt légitime ou pour s'opposer à ce traitement de données, utilisez le lien de la liste des fournisseurs ci-dessous. Le consentement soumis ne sera utilisé que pour le traitement des données provenant de ce site web. Si vous souhaitez modifier vos paramètres ou retirer votre consentement à tout moment, le lien pour ce faire se trouve dans notre politique de confidentialité accessible depuis notre page d'accueil."},{"id":108,"did":0,"language":"de","dialogHeading":"Diese Website verwendet Cookies","dialogBody":"Um diese Website zu betreiben, ist es für mich notwendig Cookies zu verwenden. Einige Cookies sind erforderlich, um die Funktionalität zu gewährleisten, andere brauche ich für Statistiken und wieder andere helfen mir dir nur die Werbung anzuzeigen, die dich interessiert. Mehr erfährst du in meiner Datenschutzerklärung.","declineButton":"Nur notwendige Cookies","acceptButton":"Weiter mit den empfohlenen Cookies","okButton":"Speichern","cookieInfo":"Cookies sind kleine Textdateien, die von Websites verwendet werden können, um die Nutzererfahrung effizienter zu gestalten.\n\nDas Gesetz besagt, dass wir Cookies, die persönliche Informationen auf Ihrem Gerät enthalten, speichern können, wenn sie für den Betrieb dieser Website unbedingt erforderlich sind. Für alle anderen Arten von Cookies, die persönliche Informationen enthalten, benötigen wir Ihre Erlaubnis.\n\nDiese Seite verwendet verschiedene Arten von Cookies. Einige Cookies werden von Drittanbietern auf unseren Seiten platziert. ","necessaryCategory":"Notwendig","necessaryopis":"Notwendige Cookies helfen dabei, eine Website nutzbar zu machen, indem grundlegende Funktionen wie Seitennavigation und Zugriff auf sichere Bereiche der Website aktiviert werden. Die Website kann ohne diese Cookies nicht ordnungsgemäß funktionieren.","preferenceCategory":"Präferenzen","preferenceopis":"Präferenz-Cookies ermöglichen es einer Website, Informationen zu speichern, die das Verhalten oder das Aussehen der Website ändern, wie z.B. Ihre bevorzugte Sprache oder die Region, in der Sie sich befinden.","statisticsCategory":"Statistiken","statisticsopis":"Statistische Cookies helfen Website-Betreibern zu verstehen, wie Besucher mit Websites interagieren, indem sie Informationen anonym sammeln und melden.","marketingCategory":"Marketing","marketingopis":"Marketing-Cookies werden verwendet, um Besucher auf Websites zu verfolgen. Die Absicht besteht darin, relevante und ansprechende Anzeigen für den einzelnen Nutzer anzuzeigen und somit für Publisher und Werbetreibende von Drittanbietern nützlicher zu sein.","unclassifiedCategory":"Nicht klassifiziert","unclassifiedopis":"Nicht klassifizierte Cookies sind Cookies, die wir gerade klassifizieren, sowie die Lieferanten einzelner Cookies.","cookieDetailsLink":"Details von Cookies","aboutCookiesLink":"Über Cookies","privacyPolicyLink":"Datenschutzerklärung","columnName":"Name","columnPurpose":"Ziel","columnPII":"Kann persönliche Informationen enthalten","columnDuration":"Dauer","mainHeading":"Datenschutz \u0026 Transparenz","purposes":"Verwendungszwecke","legitimateInterest":"Legitimes Interesse","consent":"Consent","specialPurposes":"besondere Verwendungszwecke","manageSettings":"Einstellungen verwalten","saveSettings":"Einstellungen speichern \u0026 Beenden","vendors":"Anbieter-Liste","nonTcfVendors":"Zusätzliche Anbieter","features":"Eigenschaften","specialFeatures":"Besondere Eigenschaften","acceptAllButton":"Alle akzeptieren \u0026 fortfahren","purposePrefix":"Wir und unsere Partner verwenden Cookies, um","stackPrefix":"Wir und unsere Partner verwenden Daten für","mainBody":"Ein Beispiel für Daten, welche verarbeitet werden, kann eine in einem Cookie gespeicherte eindeutige Kennung sein. Einige unserer Partner können Ihre Daten im Rahmen ihrer legitimen Geschäftsinteressen verarbeiten, ohne Ihre Zustimmung einzuholen. Um die Verwendungszwecke einzusehen, für die diese ihrer Meinung nach ein berechtigtes Interesse haben, oder um dieser Datenverarbeitung zu widersprechen, verwenden Sie den unten stehenden Link zur Anbieterliste. Die übermittelte Einwilligung wird nur für die von dieser Webseite ausgehende Datenverarbeitung verwendet. Wenn Sie Ihre Einstellungen ändern oder Ihre Einwilligung jederzeit widerrufen möchten, finden Sie den Link dazu in unserer Datenschutzerklärung, die von unserer Homepage aus zugänglich ist"},{"id":1528,"did":0,"language":"es","dialogHeading":"Este sitio web utiliza cookies","dialogBody":"Este sitio web utiliza cookies para personalizar el contenido, proporcionar experiencias personalizadas, mostrar anuncios, proporcionar características de redes sociales y analizar nuestro tráfico. También compartimos información sobre su uso en nuestro sitio con nuestros socios de redes sociales, publicidad y análisis que pueden combinarlo con otra información que les haya proporcionado o que hayan recopilado sobre el uso de sus servicios. A continuación, tiene la opción de seleccionar qué tipos de cookies permitirá que almacenen su información personal. Para ver la lista de proveedores o cambiar la configuración de consentimiento en cualquier momento, visite nuestra \"Política de privacidad\" utilizando el siguiente enlace.","declineButton":"Permitir las Cookies Necesarias y Continuar","acceptButton":"Continuar con las Cookies Recomendadas","okButton":"Guardar","cookieInfo":"Las cookies son pequeños archivos de texto que los sitios web pueden usar para hacer que la experiencia del usuario sea más eficiente.\nLa ley establece que podemos almacenar cookies que contienen información personal en su dispositivo si son estrictamente necesarias para el funcionamiento de este sitio. Para todos los demás tipos de cookies que contienen información personal, necesitamos su permiso.\nEste sitio utiliza diferentes tipos de cookies. Algunas cookies son colocadas por servicios de terceros que aparecen en nuestras páginas.","necessaryCategory":"Necesarias","necessaryopis":"Las cookies necesarias ayudan a que un sitio web sea utilizable al habilitar funciones básicas como la navegación de páginas y el acceso a áreas seguras del sitio web. El sitio web no puede funcionar correctamente sin estas cookies.","preferenceCategory":"Preferencias","preferenceopis":"Las cookies de preferencias, permiten que un sitio web guarde la información que modifica, la forma en que se comporta o se ve el sitio web, así como, su idioma preferido o la región en la que se encuentra.","statisticsCategory":"Estadísticas","statisticsopis":"Las cookies de estadísticas ayudan a los propietarios de los sitios web, a comprender cómo los visitantes interactúan con los sitios mediante la recolección y reporte de información anónima.","marketingCategory":"Mercadeo","marketingopis":"Las cookies de mercadeo se utilizan para seguir a los visitantes en los sitios web. La intención es mostrar anuncios que sean relevantes y atractivos para el usuario y, por tanto, más valiosos para editores y anunciantes externos.","unclassifiedCategory":"Sin clasificación","unclassifiedopis":"Las cookies no clasificadas son cookies que estamos en proceso de clasificar, junto con los proveedores de cookies individuales.","cookieDetailsLink":"Detalles de Cookies","aboutCookiesLink":"Acerca de las Cookies","privacyPolicyLink":"Enlace de políticas de privacidad","columnName":"Nombre","columnPurpose":"Propósito","columnPII":"Puede contener información personal","columnDuration":"Duración","mainHeading":"Privacidad y transparencia","purposes":"Propósitos","legitimateInterest":"Interés legítimo","consent":"Consentimiento","specialPurposes":"Fines especiales","manageSettings":"Administrar configuración","saveSettings":"Guardar configuración y salir","vendors":"Lista de proveedores","nonTcfVendors":"Proveedores adicionales","features":"Funciones","specialFeatures":"Funciones especiales","acceptAllButton":"Aceptar todo y continuar","purposePrefix":"Nosotros y nuestros socios utilizamos cookies para ","stackPrefix":"Nosotros y nuestros socios usamos datos para ","mainBody":"Un ejemplo de datos procesados ​​puede ser un identificador único almacenado en una cookie. Algunos de nuestros socios pueden procesar sus datos como parte de su interés comercial legítimo sin solicitar su consentimiento. Para ver los propósitos que creen que tienen interés legítimo u oponerse a este procesamiento de datos, utilice el enlace de la lista de proveedores a continuación. El consentimiento enviado solo se utilizará para el procesamiento de datos que tienen su origen en este sitio web. Si desea cambiar su configuración o retirar el consentimiento en cualquier momento, el enlace hacerlo está en nuestra política de privacidad accesible desde nuestra página de inicio."},{"id":1715,"did":0,"language":"it","dialogHeading":"questo sito usa i cookie","dialogBody":"Questo sito web utilizza i cookie per personalizzare i contenuti, fornire esperienze personalizzate, annunci mirati, fornire funzionalità di social media e analizzare il nostro traffico. Condividiamo anche informazioni sull'utilizzo del nostro sito con i nostri partner di social media, pubblicità e analisi che possono combinare con altre informazioni che avete fornito loro o che hanno raccolto dall'utilizzo dei loro servizi da parte vostra. Di seguito avete la possibilità di selezionare quali tipi di cookie consentite di memorizzare le vostre informazioni personali. Per visualizzare l'elenco dei fornitori o modificare le impostazioni di consenso in qualsiasi momento, visitate la nostra politica sulla privacy utilizzando il link sottostante","declineButton":"accettare necessario","acceptButton":"accetta tutto e continua","okButton":"accetta","cookieInfo":"I cookie sono piccoli file di testo che possono essere utilizzati dai siti web per rendere più efficiente l'esperienza dell'utente. La legge afferma che possiamo memorizzare i cookie che contengono informazioni personali sul tuo dispositivo se sono strettamente necessari per il funzionamento di questo sito. Per tutti gli altri tipi di cookie che contengono informazioni personali abbiamo bisogno della tua autorizzazione. Questo sito utilizza diversi tipi di cookie. Alcuni cookie sono inseriti da servizi di terze parti che compaiono sulle nostre pagine.","necessaryCategory":"necessario","necessaryopis":"I cookie di preferenza consentono ad un sito web di memorizzare informazioni che cambiano il modo in cui il sito web si comporta o il suo aspetto, come la lingua preferita, o la regione in cui ci si trova","preferenceCategory":"preferenze","preferenceopis":"I cookie di preferenza consentono a un sito web di ricordare le informazioni che cambiano il modo in cui il sito web si comporta o appare, come la tua lingua preferita o la regione in cui ti trovi.","statisticsCategory":"statistiche","statisticsopis":"I cookie statistici aiutano i proprietari dei siti web a capire come i visitatori interagiscono con i siti raccogliendo e trasmettendo informazioni in forma anonima.","marketingCategory":"marketing","marketingopis":"I cookie per il marketing vengono utilizzati per tracciare i visitatori dei siti web. L'intenzione è quella di visualizzare annunci che siano rilevanti e coinvolgenti per il singolo utente e quindi di maggior valore per gli editori e gli inserzionisti di terze parti","unclassifiedCategory":" ","unclassifiedopis":" ","cookieDetailsLink":"dettagli cookie","aboutCookiesLink":"informazioni sui cookie","privacyPolicyLink":"informativa sulla privacy","columnName":" ","columnPurpose":" ","columnPII":" ","columnDuration":" ","mainHeading":"privacy e trasparenza","purposes":"finalita","legitimateInterest":"interesse legittimo","consent":"consentire","specialPurposes":"scopi specifici","manageSettings":"gestire le impostazioni","saveSettings":"accetta","vendors":"lista dei fornitori","nonTcfVendors":"fornitori aggiuntivi","features":"caratteristiche","specialFeatures":"caratteristiche speciali","acceptAllButton":"accetta tutto e continua","purposePrefix":"Noi e i nostri partner utilizziamo i cookie per","stackPrefix":"Noi e i nostri partner utilizziamo i cookie per","mainBody":"Un esempio di trattamento dei dati può essere un identificatore univoco memorizzato in un cookie. Alcuni dei nostri partner possono trattare i vostri dati come parte del loro legittimo interesse commerciale senza chiedere il consenso. Per visualizzare le finalità per le quali ritengono di avere un interesse legittimo o per opporsi a questo trattamento dei dati, utilizzare il link della lista dei fronitori qui sotto. Il consenso fornito sarà utilizzato solo per il trattamento dei dati provenienti da questo sito web. Se si desidera modificare le impostazioni o non dare il consenso in qualsiasi momento, il link per farlo è nella nostra politica sulla privacy accessibile dalla nostra home page"}]},"settings":{"DomainSettingId":12420,"DomainId":244621,"defaultLanguage":"en","IsDialogEnabled":true,"IsOrigDialogEnabled":true,"IsMinorContent":false,"IsTCF2":false,"IsAMPDialogEnabled":false,"AutoDetectLanguage":true,"IsThirdParty":false,"IsWorldWide":false,"IsIabLspaSignatory":false,"ShowAcceptNecessaryButton":false,"ShowCategoryCheckboxes":false,"dialogAccentColor":"#5fa624","dialogBackgroundColor":"#ffffff","dialogTextColor":"#000000","checkedConsentBoxes":"preference,statistics","country":"BD","ccpaBannerPosition":"bottom","AltConsentEnabled":true,"hasNoConsentPage":false},"vendors":{"vendorList":null},"ezCMP":"ezCMPCookieConsent","ckLength":365,"cmpAllCookies":null,"cmpCookieTranslations":null,"privacy":"http://beautifytools.com/privacy.php"},
        styles: '#ez-cookie-dialog-wrapper {width: 100% !important;height: 100% !important;margin: 0 auto !important;position: fixed !important;top: 0 !important;left: 0 !important;background-color: rgba(0, 0, 0, 0.5) !important;font-family: Arial, serif !important;z-index: 2000000000 !important;overflow-y: auto !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table-box {overflow-y: auto !important;max-height: 150px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog .select-wrapper span, #ez-cookie-dialog-wrapper #ez-cookie-dialog .select-wrapper ul, #ez-cookie-dialog-wrapper #ez-cookie-dialog .select-wrapper input {display: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog {display: block !important;position: relative !important;opacity: 1 !important;visibility: visible !important;margin: 150px auto 0 !important;width: 650px !important;-webkit-box-sizing: content-box !important;-moz-box-sizing: content-box !important;box-sizing: content-box !important;max-width: 90% !important;background: {background_color}!important;padding: 12px 24px !important;overflow: hidden !important;z-index: 2000000000 !important;border: 10px solid {accent_color}!important;box-shadow: #333 1px 1px 10px 1px !important;line-height: 1.2 !important;text-align: left !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog h2 {font-size: 20px !important;line-height: 16px !important;font-weight: 700 !important;margin: 10px 0 16px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog p {margin: 12px 0 !important;line-height: 16px !important;text-indent: 0 !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog button {line-height: 16px !important;text-transform: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog select, #ez-cookie-dialog-wrapper #ez-cookie-dialog input {display: inline-block !important;position: relative !important;opacity: 1 !important;margin: 3px !important;font-size: 13px !important;color: {text_color};background-color: {background_color}!important;width: initial !important;padding: 0 !important;border: 1px solid {accent_color}!important;border-radius: 0 !important;height: initial !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog a, #ez-cookie-dialog-wrapper #ez-cookie-dialog p, #ez-cookie-dialog-wrapper #ez-cookie-dialog h2, #ez-cookie-dialog-wrapper #ez-cookie-dialog button {color: {text_color}!important;font-style: normal !important;text-decoration: none !important;font-variant: normal !important;font-family: Arial, serif !important;box-shadow: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog p, #ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details-opis, #ez-cookie-dialog-wrapper #ez-cookie-dialog button {font-weight: 400 !important;font-size: 10pt !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details-opis {padding: 10px 0 5px !important;color: {text_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details {height: 34px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details, #ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-about-cookies {display: table-cell !important;color: {accent_color}!important;vertical-align: bottom !important;position: relative !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details:after {width: 0px !important;height: 0px !important;border-left: 4px solid transparent !important;border-right: 4px solid transparent !important;border-top: 4px solid {accent_color}!important;content: "" !important;position: absolute !important;right: -14px !important;bottom: 6px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details.open:after {border-bottom: 4px solid {accent_color}!important;border-top: 0 solid transparent !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-about-cookies-text {display: none !important;margin-top: 12px !important;text-align: left !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-necessary-cookies {border: none !important;font-family: Arial, serif !important;color: #ffffff !important;background: #333333 !important;padding: 10px 20px 10px 20px !important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-necessary-cookies:hover {cursor: pointer !important;background: #111111 !important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-all-cookies {border: none !important;font-family: Arial, serif !important;color: {accept_button_text_color}!important;background: {accent_color}!important;padding: 10px 20px 10px 20px !important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-all-cookies:hover {cursor: pointer !important;background: {accent_color}!important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #privacy-link {font-size: 12px !important;display: block !important;margin-top: 20px !important;text-decoration: underline !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-ok-cookies {border: 1px solid {background_color}!important;font-family: Arial, serif !important;font-size: 9pt !important;color: {text_color}!important;background: {background_color}!important;padding: 5px 15px !important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-ok-cookies:hover {cursor: pointer !important;background: {background_color}!important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-about-cookies-container {margin: 32px auto 12px !important;width: 100% !important;display: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog a {color: {accent_color}!important;text-decoration: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #privacy {text-align: right !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-options {display: flex !important;flex-direction: row !important;margin: 12px 0 !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-details-container {display: none !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog .ez-cookie-option {flex: 1 !important;font-family: Arial, serif !important;font-size: 9pt !important;display: block !important;line-height: 26px !important;color: {text_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog .ez-cookie-option label {cursor: pointer !important;font-size: 12px !important;color: {text_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table {max-width: 525px !important;width: 525px !important;margin-top: 12px !important;font-family: Arial, serif !important;border-spacing: 1px !important;font-size: 8pt !important;border-collapse: separate !important;background-color: {background_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table th {background-color: {background_color}!important;color: {text_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #button-row {display: flex !important;flex-wrap: nowrap !important;justify-content: space-between !important;margin-right: 10px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #secondary-links {display: flex !important;font-size: 12px !important;margin-top: 20px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #secondary-links .bar {margin: 0 5px !important;width:auto!important;height:auto!important;position:relative!important;background:0 0!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table td {background-color: {background_color}!important;font-size: 8pt !important;width: 30% !important;-ms-word-break: break-word !important;word-break: break-word !important;color: {text_color}!important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table td:nth-child(1) {width: 30% !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table td:nth-child(2) {width: 50% !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table td:nth-child(3) {width: 20% !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table th, #ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table td {text-align: left !important;padding: 3px !important;vertical-align: top !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog .ez-cookie-option input {vertical-align: middle !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-language {position: absolute !important;top: 10px !important;right: 10px !important;color: {text_color}!important;}@media only screen and (max-width: 600px) {#ez-cookie-dialog-wrapper #ez-cookie-dialog {margin-top: 5px !important;width: 100% !important;padding: 10px !important;border-width: 5px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #button-row {flex-direction: column !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-options {flex-direction: column !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-necessary-cookies {margin-bottom: 5px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog h2 {margin: 5px 0 !important;margin-right: 44px !important;font-size: 16px !important;}#ez-cookie-dialog-wrapper #ez-cookie-dialog #ez-cookie-table-box {overflow-y: auto !important;max-height: 100px !important;}}.cDuration {display: none;}',
        wrapper: '<div id="ez-cookie-dialog-wrapper"> <div id="ez-cookie-dialog"> <select id="ez-cookie-language" onchange="ezCMP.changeLanguage(this.value)">{language-options}</select> <div id="ez-cookie-form"></div> </div></div>',
        template:'<div id="ez-cookie-template"> <h2>{dialog-heading}</h2> <p>{dialog-body}</p><p><span id="button-row"> <span> <button id="ez-necessary-cookies" style="display:{decline-botton-text-display}" onclick="ezCMP.handleDeclineClick()">{decline-button-text}</button> <button id="ez-all-cookies" onclick="ezCMP.handleAcceptClick()">{accept-button-text}</button> </span> <span> <a id="ez-cookie-details" onclick="ezCMP.toggleDetails(true)" href="javascript:void(0);">{cookie-details-link}</a> </span> </span> </p><div id="ez-cookie-options" style="display:{cookie-options-display}"> <div class="ez-cookie-option"><label><input id="ez-cookie-option-necessary" type="checkbox" value="1" disabled checked/>{necessary}</label></div><div class="ez-cookie-option"><label><input id="ez-cookie-option-preference" type="checkbox" value="0"{preference-checked}/>{preference}</label></div><div class="ez-cookie-option"><label><input id="ez-cookie-option-statistics" type="checkbox" value="0"{statistics-checked}/>{statistics}</label></div><div class="ez-cookie-option"><label><input id="ez-cookie-option-marketing" type="checkbox" value="0"{marketing-checked}/>{marketing}</label></div><div class="ez-cookie-option"><button id="ez-ok-cookies" onclick="ezCMP.handleOkClick()">{ok-button-text}</button></div></div><div id="ez-cookie-details-container"> <div> <select onchange="ezCMP.loadDetails(this.value)"> <option value="necessary">{necessary}</option> <option value="preference">{preference}</option> <option value="statistics">{statistics}</option> <option value="marketing">{marketing}</option> <option value="unclassified">{unclassified}</option> </select> </div><div id="ez-cookie-details-opis"></div><div style="overflow-x:auto;" id="ez-cookie-table-box"> <table id="ez-cookie-table"> <thead> <tr> <th>{column-name}</th> <th>{column-purpose}</th> <th>{column-pii}</th> <th class="cDuration">{column-duration}</th> </tr></thead> <tbody id="ez-cookie-table-body"> </tbody> </table> </div></div><p id="ez-about-cookies-text">{cookie-info}</p><div id="secondary-links"> <a id="ez-about-cookies" href="javascript:void(0);" onclick="ezCMP.toggleAbout()">{about-cookies-link}</a> <span class="bar">|</span> <a href="{privacy}" target="_privacy">{privacy-link}</a> </div></div>'
    };
</script>
<script type="text/javascript" src="https://ezodn.com/cmp/altconsent.js?v=8"></script>
<script type="text/javascript"  async src="/utilcave_com/inc/ezcl.webp?cb=4"></script></body></html>
