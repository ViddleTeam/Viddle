<?php
session_start();
$ok = true;

$q = $_GET['q'];
$q = htmlentities($q, ENT_QUOTES, "UTF-8");
require 'danesql.php';
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
try {
       $videov = false; 

if((strlen($q) < '1') || (strlen($q) == '1')) {
 
    $error = '2';
    throw new Exception($q->error);
} else {
if($connect->connect_errno) {
    $error = '1';
    throw new Exception($connect->error);
} else {

 $qII = mysqli_real_escape_string($connect, htmlspecialchars($q));

 if($resultv = $connect->query("SELECT * FROM viddle_videos WHERE publisher AND title LIKE '%$qII%'")) {
    $d2 = $resultv->num_rows;
    
    if(!$d2 == '0') {
        $videov = true;
    } else {
        $error = '4';
        throw new Exception($d2->error);
    }
    
} else {
    $error = '3';
    throw new Exception($result->error);
}
}
}
} catch (Exception $e) {

    if($error == '1') {
        $e_kom = '<div class="alert alert-danger" role="alert" style="width: 100%; text-align: center;">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0001</div>';
    }
if($error == '3') {
        $e_kom = '<div class="alert alert-danger" role="alert" style="width: 100%; text-align: center;">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0002</div>';
    }

if($error == '2') {
        $e_kom = '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Twoje zapytanie musi mieć co najmniej 2 znaki.</div>';
    }
    
    if($error == '4') {
        $e_kom = '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Nie odnaleziono treści odpowiadających Twojemu zapytaniu.</div>';
    }
 
} 

try {
	
	$channel = false;
if((strlen($q) < '1') || (strlen($q) == '1')) {
 
    $kerror = '2';
    throw new Exception($q->error);
} else {
	if($connect->connect_errno) {
	    $kerror = '1';
	    throw new Exception($connect->error);
	} else {

	 $qII = mysqli_real_escape_string($connect, htmlspecialchars($q));
		
  	 if($resultIII = $connect->query("SELECT * FROM viddle_users WHERE login LIKE '%$qII%'")) {
		 $d3 =mysqli_num_rows($resultIII);
		 
		 if(!$d3 == '0') {
			 $channel = true;
		 } else {
			$kerror = '4';
	   		throw new Exception($resultII->error);  
		 }
	 } else {
		$kerror = '3';
	   	throw new Exception($resultII->error); 
	 }
	}
}
	
} catch (Exception $e) {
	if($kerror == '1') {
		$k_com = '<div class="alert alert-danger" role="alert" style="width: 100%; text-align: center;">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0001</div>';
	}
	
	if($kerror == '2') {
		$k_com = '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Twoje zapytanie musi mieć co najmniej 2 znaki.</div>';
	}
	
	if($kerror == '3') {
		$k_com = '<div class="alert alert-danger" role="alert" style="width: 100%; text-align: center;">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0002</div>';
	}
	
	if($kerror == '4') {
		$k_com = '<div class="alert alert-info" role="alert" style="width: 100%; text-align: center;">Nie odnaleziono treści odpowiadających Twojemu zapytaniu.</div>';
	}
}
?>
<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wyniki wyszukiwania - Viddle</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
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
        require_once ("partials/navbar.php");
    ?>
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Wyniki wyszukiwania frazy <?php echo $q ?></h4>
            </div>
        </div>
        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Filmy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kanały</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="tile" style="margin: auto;"><center>
                    <?php if(isset($e_kom)) {

                    echo $e_kom;
                    }
			?></center>
                    <?php 
                    if($videov == true) {
                           
                            while($dane=$resultv->fetch_assoc()){
				    $uid = $dane['publisher'];
                                if(!isset($f_error)) {
                                  if ($p = @$connect->query(
		                     sprintf("SELECT * FROM viddle_users WHERE uid='%s'",
		                     mysqli_real_escape_string($connect,$uid))))  {  
                                          
                                          $num =mysqli_num_rows($p);
                                          $danee = mysqli_fetch_assoc($p);
                                          if(!$num == '0') {
                                                               $say = '<div class="card">
                                              <a href="video?id='.$dane['video_id'].'">
                                                  <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                                                  <p class="card-title">'.$dane['title'].'</p>
                                                  <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                                                  <div class="bottom-info">
                                                      <span>'.$danee['login'].'</span>
                                                      <span>•</span>
                                                      <span>'.$dane['views'].' wyświetleń</span>
                                                  </div>
                                              </a>
                                          </div>';
                                                 echo $say;
                                          } else {
                                                 $f_error = '<div class="alert alert-danger" role="alert">'.$dane['publisher'].'Wystąpił poważny błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0004</div>';
                                          }
                                   } else {
                                          $f_error = '<div class="alert alert-danger" role="alert">Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0003</div>';
                                   }
                                 }
                              }
		    } 
                       /*
                    if (strlen($search_query) >= 2) {
                        $x = $db->real_escape_string($search_query);
                        $stmt = $db->prepare("SELECT publisher, video_id, views, title FROM viddle_videos WHERE title LIKE %{$x}%");
                        $stmt->execute();
                        $stmt->store_result();
                        if ($stmt->num_rows === 0) echo('<div class="alert alert-info" role="alert">
                        Nie znaleziono filmów odpowiadających Twojej frazie.
                        </div>');
                        $stmt->bind_result($publisher, $video_id, $views, $title);
                        $stmt->fetch();
                        while ($stmt->fetch()) {
                            echo('<div class="card">
                                <a href="video">
                                    <img src="https://i.pinimg.com/originals/07/03/6e/07036e12e9ca047f542437befa8872d3.jpg" class="img-responsive card-img">
                                    <p class="card-title"><?php echo $title ?></p>
                                    <div class="hr" style="margin-top:-5px;margin-bottom:5px;"></div>
                                    <div class="bottom-info">
                                        <span><?php echo $publisher; ?></span>
                                        <span>•</span>
                                        <span>17.5k wyświetleń</span>
                                    </div>
                                </a>
                            </div>');
                        }
                    } else {
                        echo('<div class="alert alert-danger" style="min-width: 100%; text-align: center;" role="alert">
                            Twoja fraza powinna składać się z przynajmniej 2 znaków.
                        </div>');
                    }
                    */?>
                       <?php if(isset($f_error)) {
                           echo $f_error;
                    }
                       ?>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<?php if(isset($k_com)) {
			echo $k_com;
			}
			?> <?php
			 if($channel == true) {
                           
                            while($danec=$resultIII->fetch_assoc()){
				    
                                if(!isset($f_error)) {
					$id = $danec['uid'];
					$zapytanie = $connect->query("SELECT * FROM viddle_followers WHERE followed='$id'");
					$liczbaobs = $zapytanie->num_rows;
					if(!isset($liczbaobs)) {
						$blad = '5';
						$V = '<div class="alert alert-danger" role="alert">'.$dane['publisher'].'Wystąpił błąd serwisu! Skontaktuj się z supportem. Kod błędu: 0xf0005</div>';
						$k_com = $V;
					} else {
					$av = $danec['avatarname'];
				    if($av == 'x') {
					    $av2 = 'anonim.png';
				    } else {
					    $av2 = 'https://cdn.viddle.xyz/cdn/videos/avatars/'.$danec['uid'].'/'.$danec['uid'].'.'.$av.'';
				    }
					
                    $say = '<div class="row" style="width: 100%; align-items: center; margin: 25px 0 25px 0;">
                        <span style="margin-left: 10px;">
                        <a href=https://beta.viddle.xyz/channel?id="'.$danec['uid'].'"><img width="96px" style="border-radius:50%; margin-right:5px;" class="img-responsive" src="'.$av2.'"></a>
                        </span>
                        <span style="margin-left: 10px; margin-right: auto; align-items: center;">
                            <h4><a href="https://beta.viddle.xyz/channel?id='.$danec['uid'].'">'.$danec['login'].'</a></h4>
                            <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;">'.$liczbaobs.' obserwujących</p>
                        </span>
                        <span style="margin-left: auto; margin-right: -20px;">
                            <button type="button" class="btn btn-success"><p style="margin: 10px;">Obserwuj</p></button>
                        </span>
                    </div>';
                    echo $say;
				}
			    }
			    }         
                }
			if(isset($V)) {
			echo $V;
			}
			?>
            <br>
            </div>
        </div>
</div>
<?php
    require_once ('partials/footer.php');
?>
<div class="hiddendiv common"></div></body></html>
