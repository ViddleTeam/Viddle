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
    <title><?php if ($_SERVER('REQUEST_URI') == '/channel.php') { ?> SlaVistaPL na Viddle <?php } else { ?> Viddle - <?php } if (isset($title)) { echo $title; } else { echo 'Viddle'; } ?></title>
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="Viddle - polska alternatywa dla YouTube">
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

                <ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
                    <div class="container row">
                        <li class="nav-item">
                            <a class="nav-link" href="upload.php" title="Udostępnij film na Viddle"><img src="https://media.discordapp.net/attachments/627873018990952448/726773229863305276/AAAAA.png" width="20px" style="color: white;" /> <span class="d-lg-none">Udostępnij film na Viddle</span></a>
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