<?php
$title = 'Studio Twórców';
require_once('partials/navbar.php');
?>
<div class="website">
<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="margin-bottom: 10px; margin-top:70px; margin-left: 10%; margin-right: 10%;">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Strona główna</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Twoje filmy</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="margin-top: 10px;">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="container">
        <div class="row">
          <div class="col-lg-12" style="display: -webkit-box;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;-webkit-box-pack: center;justify-content: center;"></div>
        </div>
          <div class="row" style="justify-content: center;">
              <div class="col-lg-12">
                  <h4 class="tile-before" style="color:white;">Podgląd twojego kanału</h4>
              </div>
              <div class="card-creatorstudio border border-white" style="padding: 10px;">
                <p>Wyświetlenia (ostatnie 24 godziny)</p>
                <h3>21 370 <small style="color: #00dd10;"><small>(+1 254)</small></small></h3>
            </div>
            <div class="card-creatorstudio border border-white" style="padding: 10px;">
                <p>Obserwujący (ostatnie 24 godziny)</p>
                <h3>78 <small style="color: #00dd10;"><small>(+11)</small></small></h3>
            </div>
            <div class="card-creatorstudio border border-white" style="padding: 10px;">
                <p>Komentarze (ostatnie 24 godziny)</p>
                <h3>15 <small style="color: #00dd10;"><small>(+3)</small></small></h3>
            </div>
            <div class="col-lg-12">
                <h4 class="tile-before" style="color:white; margin-top: 20px;">Statystyki ostatniego filmu</h4>
                <p>Statystyki związane z twoim najnowszym filmem.</p>
                <div class="row" style="justify-content: center;">
            <div class="card-creatorstudio border border-white" style="padding: 10px;">
              <p>Wyświetlenia</p>
              <h3>775</h3>
          </div>
          <div class="card-creatorstudio border border-white" style="padding: 10px;">
              <p>Średni czas oglądania (w minutach)</p>
              <h3>67</h3>
          </div>
          <div class="card-creatorstudio border border-white" style="padding: 10px;">
              <p>Komentarze</p>
              <h3>7</h3>
          </div>
          </div>
        </div>
        </div>
            </div>
</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Twoje filmy</div>
</div>
</div>

<?php
require_once('partials/footer.php');
?>

<div class="hiddendiv common"></div></body></html>
