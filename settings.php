<?php session_start();
$title = "Ustawienia";
require_once('partials/navbar.php');
?>
<html>
<head>
</head>
<body>
<div class="container" style="margin-top:40px;">
    <h4 class="tile-before" style="color:white; margin-top: 60px;"><br>Ustawienia konta</h4>
    <p>Zarządzaj swoim kontem.</p>
    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
      aria-selected="true">Ogólne</a>
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

            <b>✏️ Zmień nazwę konta</b><br>
            <p>Zmień obecną nazwę konta, pamiętaj że to może utrudnić znalezienie kanału twoim obecnym obserwatorom.</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;">Zmień</button></td>
    </tr>
    <tr>
        <th scope="row">
            <b>🔑 Zmień hasło</b><br>
            <p>Zmień obecne hasło na koncie, po zmianie zostaniesz wylogowany z każdego urządzenia.</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;" >Zmień hasło</button></td>
    </tr>
    <tr>
        <th scope="row">
            <b>🔒 Weryfikacja dwuetapowa (2FA) <span class="badge badge-warning">Już wkrótce</span></b><br>
            <p>Weryfikacja dwuetapowa jest dobrym rozwiązaniem, żeby chronić swoje konto.</p>
        </th>
        <td><button type="button" class="btn btn-primary" style="padding: 10px;">Włącz</button></td>
    </tr>
  </tbody>
</table></div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Wkrótce.</div>
</div>
</div>
</body>
</html>
<?php
require_once('partials/footer.php');
?>

<div class="hiddendiv common"></div></body></html>

