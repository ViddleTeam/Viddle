<?php

session_start();

$login = $_SESSION['user'];

require "danesql.php";
$connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
if ($result = @$connect->query(
		    sprintf("SELECT * FROM viddle_users WHERE login='%s'",
		    mysqli_real_escape_string($connect,$login))))
	
	$d2 = $result->num_rows;
	if($d2 == '1')
	{
		$dane = $result->fetch_assoc();
		
		$av5 = $dane['avatarname'];
		$ba2 = $dane['banername'];
		
		
		if($av5 == 'x')
		{
			$av4 = 'avatardomyslny.jpg';
		}
		else
		{
			$av4 = 'grafic/'.$id.'a.'.$av5.'';
		}
		
		if($ba2 == 'x')
		{
			$ba3 = 'http://wallpapercave.com/wp/t05PXKg.jpg';
		}
		else
		{
			$ba3 = 'grafic/'.$id.'b.'.$ba2.'';
		}
		
	}
	else
	{	
		header('location: index.php');
	}
$title = "zmiana grafiki kanału";
require_once('partials/navbar.php');
?>
      <div class="container" style="margin-top:30px;">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
        </div>
        </div>
          <div class="row">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white; margin-top: 40px;"><br>Udostępnij film na VDP</h4>
				  
		      
								<h2 style="color: white;">Twój avatar</h2>
                <p style="color: white;">oto twój aktualny avatar:</a></p>
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
<?php 
require_once('partials/footer.php');
?>
<!-- JS -->
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/jquery.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/bootstrap.min.js"></script>
<script src="https://cdn.patryqhyper.pl/vdp/mdb/js/mdb.min.js"></script>
<script src="script.js"></script>

<div class="hiddendiv common"></div></body></html>
