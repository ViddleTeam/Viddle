<html lang="pl-PL"><head>
	
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Udostępnij film na Viddle</title>
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.patryqhyper.pl/vdp/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="style.css">
    <meta property="og:title" content="VDP - polska alternatywa dla YouTube">
    <meta property="og:description" content="Filmy, muzyka i wiele więcej. Udostępniaj swoje filmy znajomym, rodzinie, oraz całemu światu, za pomocą VDP.">
	<script src="script.js"></script>
    <script src="https://kit.fontawesome.com/604acb9c5e.js"></script>
	<link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-font-face.min.css" media="all"><link rel="stylesheet" href="https://kit-free.fontawesome.com/releases/latest/css/free-v4-shims.min.css" media="all">
	<script src="https://cdn.tiny.cloud/1/9n5avfoajfr11lw9hhd4o45rxfafzr79vlo04km6r4kp8i7l/tinymce/5/tinymce.min.js" referrerpolicy="origin"/></script>
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
          <a class="nav-link" href="index.php" title="Strona główna"><img src="https://media.discordapp.net/attachments/627764286785060899/725795384802410617/houm.png" width="20px"/> <p class="d-lg-none">Strona główna</p></a>
		</li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="trending.php" title="Popularne"><img src="https://media.discordapp.net/attachments/627764286785060899/725795329810628628/fajer.png" width="20px"/> <p class="d-lg-none">Popularne</p></a>
        </li>
	  </div>
	  <div class="container row">
        <li class="nav-item">
          <a class="nav-link" href="discover.php" title="Odkrywaj"><img src="https://media.discordapp.net/attachments/627764286785060899/725795361268039811/dizkower.png" width="20px"/> <p class="d-lg-none">Odkrywaj</p></a>
        </li>
	  </div>
      </ul>
      <form class="form-inline" method="GET" action="search.php" style="margin-right: auto;">
        <input id="input_search" class="form-control mr-sm-2" style="width: 24rem; margin-top: 10px;" name="q" type="text" placeholder="Szukaj w Viddle" aria-label="Szukaj w Viddle">
      </form>
 
	<ul class="navbar-nav nav-flex-icons" style="margin-right: 10px;">
	<div class="container row">
		<li class="nav-item">
		  <a class="nav-link" href="upload.php" title="Udostępnij film na VDP"><img src="https://media.discordapp.net/attachments/627873018990952448/726773229863305276/AAAAA.png" width="20px" style="color: white;" /> <p class="d-lg-none">Udostępnij film na VDP</p></a>
		</li>
	</div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img width="32px" style="border-radius:50%;margin-right:5px;" class="img-responsive" src="https://cdn.discordapp.com/avatars/353067694565883915/e6d7166edad41a3a2d5000281d9f8b14.png?size=1024">SlaVistaPL</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item waves-effect waves-light" href="channel.php">Przejdź na kanał</a>
                      <a class="dropdown-item waves-effect waves-light" href="creatorstudio.php">Studio twórców</a>
                      <a class="dropdown-item waves-effect waves-light" href="#">Wyloguj się</a>
                    </div>
                </li>
            </ul>   
			</div>
  </nav>
      </header>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na VDP</h4>
				  <p style="color: white; margin-bottom: 20px;">Krok 1/3: Wybierz film do udostępnienia</p>
              </div>
            </div>
            <div class="tile" style="margin: auto;">
               <div class="card-upload border border-white;" style="margin: auto; width: 100%; height: auto;">
					<div class="card-body">
						<p style="align-items: center; color: white;">
							<center>
								<h2 style="color: white;">Wybierz plik wideo z komputera/telefonu</h2>
                <p style="color: white;">Maksymalny dozwolony rozmiar na jeden film wynosi 1 GB. Chcesz się dowiedzieć, ile dany film może ważyć? Użyj <a href="https://toolstud.io/video/filesize.php?">tego narzędzia.</a></p>
                <p style="color: white; font-weight: bold; margin-top: -10px;">Pamiętaj, że administracja VDP ma pełne prawo do usunięcia filmu, jeżeli narusza on prawa autorskie i/lub regulamin.</p>
								<input type="file" accept="video/mp4, video/mov" style="color: white; margin-top: 5px;" /> 
							</center>
						</p>
					</div>
			   </div>
            </div>
			<div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br></h4>
				  <p style="color: white; margin-bottom: 10px;">Krok 2/3: Nadaj nazwę filmowi oraz dodaj opis</p>
              </div>
            </div>
            <div class="container row" style="width: auto; color: white;">
               <form method="post">
                <div class="form-row" style="justify-content: center;">
                  <div class="col-md-12">
                    <div class="md-form form-group" style="width: 100%;">
                      <input type="email" style="color: white;" class="form-control" id="inputEmail4MD">
                      <label for="inputEmail4MD" style="color: white;">Tytuł filmu</label>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="md-form form-group">
                      <textarea id="form7" class="md-textarea form-control" rows="4" cols="137" style="color: white; width: 100%; resize: none; margin-top: -10px;"></textarea>
                      <label for="form7" style="color: white;">Opis filmu</label>
                    </div>
                  </div>
                </div>
			   <div style="justify-content: center;">
			   </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
    </div>
    </div>
      <div class="row">
          <div class="col-md-12">
            <br>
      <p style="color: white; margin-bottom: 20px;">Krok 3/3: Gotowy do przesłania?</p>
          </div>
        </div>
     <center>
     <button type="button" class="btn btn-success" style="margin-bottom: 10px;"><p style="margin: 10px; color: white;">Rozpocznij przesyłanie</p></button>
     </div>
</div>
</center>
        </div>
<!-- JS -->
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/jquery.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/bootstrap.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>