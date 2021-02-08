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
        require 'danesql.php';
        $db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
        $search_query = $db->real_escape_string(htmlentities($_GET['q']));
    ?>
    <div class="container" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Wyniki wyszukiwania</h4>
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
                <div class="tile" style="margin: auto;">
                    <?php
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
                    ?>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <span style="margin-left: 10px;">
                      <a href="https://beta.viddle.xyz/channel?id=5fd60fc0868fe5fd60fc086901"><img width="96px" style="border-radius:50%; margin-right:5px;" class="img-responsive" src="https://cdn.viddle.xyz/cdn/videos/avatars/5fd60fc0868fe5fd60fc086901/5fd60fc0868fe5fd60fc086901.jpeg"></a>
                    </span>
                    <span style="margin-left: 10px; margin-right: auto; align-items: center;">
                        <h4 style="align-items: center;"><a href="https://beta.viddle.xyz/channel?id=5fd60fc0868fe5fd60fc086901">SlaVistaPL</a></h4>
                        <p style="text-align: left; margin-bottom: 20px; margin-top: -6px;">0 obserwujących</p>
                    </span>
                    <span style="margin-left: auto; margin-right: -20px;">
                        <button type="button" class="btn btn-success"><p style="margin: 10px;">Obserwuj</p></button>
                    </span>
                </div><br>
            </div>
        </div>
</div>
<?php
    require_once ('partials/footer.php');
?>
<div class="hiddendiv common"></div></body></html>