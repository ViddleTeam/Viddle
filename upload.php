<?php
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