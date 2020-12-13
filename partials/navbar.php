<?php
session_start();
if ($_SESSION['z1'] == true) 
{
    $i = '1';
    $avatar = 'test.png';
    echo "<script>console.log('${$_SESSION['user']}')</script>";
    echo '<script>console.log("script")</script>';
    
    $login = $_SESSION[
    require "danesql.php";
    $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
    if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))

            $d2 = $result->num_rows;
			if($d2 == '1')
			{
} 
else 
{
    $i = '0';
}
$str = "/channel.php?id=";
$url = $_SERVER['REQUEST_URI'];
$cond = strpos($url, $str) !== false;
$ttl = isset($title) && $cond ? "Viddle - $title" : 'Viddle - Viddle';
?>
<html lang="pl-PL"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $ttl ?></title>
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
    <!-- UIkit CSS -->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/css/uikit.min.css" />
    UIkit JS
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.16/dist/js/uikit-icons.min.js"></script>-->
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle - polska alternatywa dla YouTube">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą Viddle.">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
    <link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js" integrity="sha512-G3jAqT2eM4MMkLMyQR5YBhvN5/Da3IG6kqgYqU9zlIH4+2a+GuMdLb5Kpxy6ItMdCfgaKlo2XFhI0dHtMJjoRw==" crossorigin="anonymous"></script>
    <meta name="turbolinks-cache-control" content="no-cache">-->
    </head>
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
                            <a class="nav-link" href="index.php" title="Strona główna"><img src="https://media.discordapp.net/attachments/627764286785060899/725795384802410617/houm.png" width="20px"/> <span class="d-lg-none">Strona główna</span></a>
                        </li>
                    </div>
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="trending.php" title="Popularne"><img src="https://media.discordapp.net/attachments/627764286785060899/725795329810628628/fajer.png" width="20px"/> <span class="d-lg-none">Popularne</span></a>
                        </li>
                    </div>
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="discover.php" title="Odkrywaj"><img src="https://media.discordapp.net/attachments/627764286785060899/725795361268039811/dizkower.png" width="20px"/> <span class="d-lg-none">Odkrywaj</span></a>
                        </li>
                    </div>
                </ul>
                <form class="form-inline" method="GET" action="search.php" style="margin-right: auto;">
                    <input id="input_search" class="form-control mr-sm-2" style="width: 24rem; margin-top: 10px;" name="q" type="text" placeholder="Szukaj w Viddle" aria-label="Szukaj w Viddle">
                </form>
                
                <?php
                if ($i == '1') { ?>

                <ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php" title="Udostępnij film na Viddle"><img src="https://media.discordapp.net/attachments/627873018990952448/726773229863305276/AAAAA.png" width="20px" style="color: white;" /> <span class="d-lg-none">Udostępnij film na Viddle</span></a>
                        </li>
                    </div>
                    
                    <?php } ?>
                   
                            <?php if ($i == '0') { ?>
                    <a href="login.php">zaloguj się</a>
                                
                            <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="32px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="<?php echo $avatar ?>"></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-default" style="min-width: 150px;" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item waves-effect waves-light" href="channel.php?id=<?php if (isset($uid)) echo $uid  ?>">Strona twojego kanału</a>
                                <a class="dropdown-item waves-effect waves-light" href="creatorstudio.php">Studio twórców</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item waves-effect waves-light" href="logout.php">Wyloguj się</a>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
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
