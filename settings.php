<?php
$title = "Ustawienia";
require_once('partials/navbar.php');
?>
<div class="container" style="margin-top:40px;">
    <h4 class="tile-before" style="color:white; margin-top: 60px;"><br>Ustawienia konta</h4>
    <p>Zmień hasło, nazwę czy awatar</p>
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
      aria-selected="true">Ustawienia ogólne</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
      aria-selected="false">Strefa niebezpieczna</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><table class="table" style="color: white !important;">
  <thead>
    <tr>
      <th scope="col">Ustawienie</th>
      <th scope="col">Akcja</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <th scope="row">
            <b>Zmień nazwę konta</b><br>
            <p>Nie podoba się Tobie obecna nazwa? Możesz ją zmienić tutaj.</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;">Zmień nazwę konta</button></td>
    </tr>
    <tr>
        <th scope="row">
            <b>Zmień hasło</b><br>
            <p>Uważasz, że Twoje obecne hasło jest zbyt słabe? Ustaw tutaj silniejsze!</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;" >Zmień hasło</button></td>
    </tr>
    <tr>
        <th scope="row">
            <b>Weryfikacja dwuetapowa <span class="badge badge-warning">Już wkrótce</span></b><br>
            <p>Silne hasło Twoim zdaniem nie wystarczy? Włącz weryfikację dwuetapową, żeby jeszcze bardziej chronić swoje konto.</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;">Włącz 2FA</button></td>
    </tr>
  </tbody>
</table></div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Już wkrótce!</div>
</div>
</div>
<?php
require_once('partials/footer.php');
?>

<div class="hiddendiv common"></div></body></html>
