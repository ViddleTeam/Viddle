<link rel="stylesheet" href="style.css">
<style>
body {
  top: 50%;
  left: 50%;
}
</style>
<?php
$id = $_GET['id'];
if($id=="1") {
  $test = "Wystąpił poważny błąd serwisu! Jeżeli problem nie ustąpi, skontaktuj się z deweloperami strony.<br /> <h3>Kod błędu: 0x00001c</h3>";
} elseif($id=="2") {
  $test = "Twój plik jest za duży, lub użyłeś złęgo formatu pliku!<br /> Dozwolone formaty: .mp4, .wmv, .webm, .mov, .3gp<br />.Jeżeli problem nie ustąpi, skontaktuj się z deweloperami strony.<br /> <h3>Kod błędu: 0x00002c</h3>";
} elseif($id=="3") {
  $test = "Wystąpił poważny błąd serwisu! Jeżeli problem nie ustąpi, skontaktuj się z deweloperami strony.<br /> <h3>Kod błędu: 0x00003c</h3>";
} else {
  $test = "Heh, śmieszne. Wystąpił błąd taki, że w linku nie podano kodu błędu. Śmieszne, co nie?";
?>
<center><h1>Wystąpił błąd!</h1><br />
<?php echo($test) ?><br />
<a href="index.php"><p style="color: white;"><button>Powrót do strony głównej</button></p></a></center>
