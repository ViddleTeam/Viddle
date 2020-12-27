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
            <h4 class="tile-before" style="color:white;"><br>Zmień grafikę swojego kanału</h4><br>
            <center>
                <div class="card-channel" style="border-radius: 0 0 10px 10px; margin-left: 0px; margin-right: 0px; width: 100%; height: auto; padding: 20px;">
                    <img width="204px" style="border-radius:50%; margin-bottom:5px;" class="img-responsive" src="<?php if (isset($av4)) echo $av4 ?>"><br>
                    <button type="button" class="btn btn-blue-grey"><p style="margin: 10px;">Przywróć domyślny</p></button><br><br>
                    <p>Obsługiwane formaty: JPG, JPEG, PNG oraz BMP. Aktualizacja może potrwać do kilku minut.</p>
                </div>
            </center>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;">
    </div>
</div>
<?php
require_once('partials/footer.php');
?>
