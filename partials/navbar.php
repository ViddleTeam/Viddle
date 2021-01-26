<?php
session_start();
if ($_SESSION['z1'] == true) {
    $i = '1';
    
    $avatar = 'test.png';
    $login = $_SESSION['user'];
    require "danesql.php";
    $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
    if ($result = @$connect->query(sprintf("SELECT * FROM viddle_users WHERE login='%s'", mysqli_real_escape_string($connect, $login)))) $d2 = $result->num_rows;
    if (isset($d2) && $d2 == '1') {
        $dane = $result->fetch_assoc();
        $_SESSION['avatar'] = $dane['avatarname'];
        $avatar = $dane['avatarname'];
        $uid = $dane['uid'];
        $_SESSION['uid'] = $dane['uid'];
        $_SESSION['email'] = $dane['email']; 
        $block = $dane['block'];
        if ($avatar == 'x') {
            $av2 = '0';
            $av3 = 'avatardomyslny.jpg';
        } else {
            $av2 = '1';
            $av3 = 'grafic/' . $uid . 'a.' . $avatar . '';
        }
    } else {
    }
} else {
    $i = '0';
}
$str = "/channel.php?id=";
$url = $_SERVER['REQUEST_URI'];
$cond = strpos($url, $str) !== false;
$ttl = isset($title) && $cond ? "Viddle - $title" : 'Viddle - Viddle';

if($block == '1')
{
     $_SESSION['blokada'] = true;
     header('location: block.php');
}
?>
<!DOCTYPE html>
<html lang="pl-PL"><head>
    <script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/logo (1).png">
    <script data-ad-client="ca-pub-4393741826344878" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <title><?php echo $ttl ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <?php
    if ($_SESSION['z1'] == true) {
        echo '<script>
            function noActivityModal() {
                setTimeout(function() {
                    $(document).ready(function(){
                        $("#noActivityModal").modal("show");
                    });
                }, 60000 * 10);
            }
        </script>';
    } else {
        return;
    }
    ?>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/css/uikit.min.css" />
    UIkit JS
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/js/uikit-icons.min.js"></script>-->
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js" integrity="sha512-G3jAqT2eM4MMkLMyQR5YBhvN5/Da3IG6kqgYqU9zlIH4+2a+GuMdLb5Kpxy6ItMdCfgaKlo2XFhI0dHtMJjoRw==" crossorigin="anonymous"></script>
    <meta name="turbolinks-cache-control" content="no-cache">-->
</head>
<body onblur="noActivityModal()">
    <div id="noActivityModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Nie wykryto żadnej aktywności od dłuższego czasu</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Wykryliśmy brak aktywności z twojej strony przez ponad 10 minut. Czy chcesz się wylogować?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding: 10px;">Pozostaw mnie zalogowanego</button>
                    <a href="/logout"><button type="button" class="btn btn-primary" style="padding: 10px;">Wyloguj się</button></a>
                </div>
            </div>
        </div>
    </div>
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
            <a class="navbar-brand" href="index.php"><img src="https://media.discordapp.net/attachments/785086822220169217/796438597258444830/vlogocropped.png?width=25&height=25" width="25px" height="25px"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-6"
                    aria-controls="navbarSupportedContent-6" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-6">
                <ul class="navbar-nav mr-auto">
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="index" title="Strona główna"><img src="https://media.discordapp.net/attachments/785086822220169217/796438583912562698/viconhome.png?width=132&height=127" width="20px"/> <span class="d-lg-none">Strona główna</span></a>
                        </li>
                    </div>
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="trending" title="Popularne"><img src="https://media.discordapp.net/attachments/785086822220169217/796438586274742332/vicontrending.png?width=99&height=123" width="20px"/> <span class="d-lg-none">Popularne</span></a>
                        </li>
                    </div>
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="discover" title="Odkrywaj"><img src="https://media.discordapp.net/attachments/785086822220169217/796438582041772102/vicondiscover.png?width=116&height=116" width="20px"/> <span class="d-lg-none">Odkrywaj</span></a>
                        </li>
                    </div>
                </ul>
                <form class="form-inline" method="GET" action="search" style="margin-right: auto;">
                    <input id="input_search" class="form-control mr-sm-2" style="width: 20rem;" name="q" type="text" placeholder="Szukaj w Viddle" aria-label="Szukaj w Viddle">
                </form>

                <?php
                if ($i == '1') { ?>

                <ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php" title="Udostępnij film"><img src="https://media.discordapp.net/attachments/785086822220169217/796438592850362378/viconupload.png?width=117&height=72" width="20px" style="color: white;" /> <span class="d-lg-none">Udostępnij film</span></a>
                        </li>
                    </div>
                    <?php
                    } ?>
                    <?php if ($i == '0') { ?>
                        <a class="nav-link" href="login.php" style="color: white;">Zaloguj się</a>

                        <?php
                    } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="32px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $av3 ?>"></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-default" style="min-width: 150px;" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item waves-effect waves-light" href="channel?id=<?php if (isset($uid)) echo $uid ?>">Strona twojego kanału</a>
                            <a class="dropdown-item waves-effect waves-light" href="creatorstudio">Studio twórców</a>
                            <a class="dropdown-item waves-effect waves-light" href="profilechange">Ustawienia grafiki kanału</a>
                            <a class="dropdown-item waves-effect waves-light" href="developers">Dla deweloperów</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item waves-effect waves-light" href="logout">Wyloguj się</a>
                            <?php
                            } 
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class=""></div>
    <!--    <header>
            <nav class="uk-navbar-container" uk-navbar style="background: #262626; height: fit-content;">
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li class="uk-active">
                            <a href="/">
                                <img src="https://cdn.ampersandbot.pl/p1X7yQuco.png" width="120px" />
                            </a>
                        </li>
                        <li class="uk-parent"><a href="#">link 2</a></li>
                        <li><a href=""></a></li>
                    </ul>
                </div>
            </nav>
        </header>-->
