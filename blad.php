<script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
<link rel="stylesheet" href="style.css">
<title>Wystąpił błąd!</title>
<style>
body {
  top: 50%;
  left: 50%;
}
button {
    outline: none;
    margin: 10px;
    height: 50px;
    width: 225px;
}
</style>
<?php
$id = $_GET['id'];
if($id=="1") {
  $test = "Kurza twarz! Wystąpił błąd serwisu. Koniecznie przekaż to naszej drużynie.
<br /><h2>Kod błędu: 0x00001c</h2>";
} elseif($id=="2") {
  $test = "Twój plik jest zbyt duży, lub stało się coś nieoczekiwanego.<br />Wróć do poprzedniej strony i spróbuj ponownie.<br />Możliwe że to jest problem po naszej stronie, więc skontaktuj się z naszą drużyną!<br /><h2>Kod błędu: 0x00002c</h2>";
} elseif($id=="3") {
  $test = "Kurza twarz! Wystąpił poważny błąd serwisu. Koniecznie przekaż to naszej drużynie.<br /><h3>Kod błędu: 0x00003c</h3>";
} elseif($id=="4") {
  $test = "Hola, hola, za szybko wrzucasz filmy!<br />Poczekaj aż ktoś inny wrzuci film, żeby wrzucić kolejny.<br /><h3>Kod błędu: 0x00004c</h3>";
} elseif($id=="5") {
  $test = "Twój plik zdaje się być nam nieznany, lub nawet go nie ma.<br />Błąd z którym masz do czynienia nie występuje bez<br />przyczyny, więc lepiej zgłoś to naszej drużynie!<br /><h2>Kod błędu: 0x00005c</h2>";
} elseif($id=="6") {
  $test = "Rozmiar miniaturki jest zbyt wielki.<br />Zalecamy zmniejszenie wymiarów miniaturki.<br /><h2>Kod błędu: 0x00006c</h2>";
} elseif($id=="7") {
  $test = "Złe rozszerzenie miniaturki.<br />Akceptowane rozszerzenia:<br />.png, .jpg, .jpeg, .bmp<br /><h2>Kod błędu: 0x00006c</h2>";
} elseif($id=="8") {
  $test = "Plik miniaturki zdaje się być nam nieznany, lub nawet go nie ma.<br />Błąd z którym masz do czynienia nie występuje bez<br />przyczyny, więc lepiej zgłoś to naszej drużynie!<br /><h2>Kod błędu: 0x00008c</h2>";
} elseif($id=="9") {
  $test = "Podczas dodawania miniaturki wystąpił nieznany błąd.<br />Spróbuj wrzucić ją jeszcze raz.<br />W przypadku dalszych problemów, skontaktuj<br />się z naszą drużyną!<br /><h2>Kod błędu: 0x00009c</h2>";
} elseif($id=="10") {
  $test = "Tytuł filmu jest zbyt długi.<br />Maksymalna długość to 52.<br /><h2>Kod błędu: 0x00010c</h2>";
} elseif($id=="11") {
  $test = "Opis filmu jest zbyt długi.<br />Maksymalna długość to 1024.<br /><h2>Kod błędu: 0x00011c</h2>";
} elseif($id=="12") {
  $test = "Upsss ... wydarzyło się coś nieoczekiwanego.<br />Najwidoczniej z jakiegoś powodu nie udało się przesłać miniaturki. Upewnij się czy plik z miniaturką nie jest uszkodzony, jeśli nie to zgłoś to naszej drużynie.<br /><h2>Kod błędu: 0x00012c</h2>";
} elseif($id=="404") {
  $test = "Awaria systemu FTP.<br />Usilnie próbujemy rozwiązać problem,<br />prosimy o cierpliwość.<br /><h2>Kod błędu: 0x00404c</h2>";
} elseif($id=="14") {
  $test = "Viddle wymaga JavaScript do poprawnego działania. Włącz obsługę JavaScript w swojej przeglądarce.";
} else {
  $test = "Wystąpił nieznany błąd. Koniecznie przekaż to naszej drużynie, żeby mogła się temu przyjrzeć.<br />";
}
?>
<center>
<img src="pwnedimg.png" width="200" height="200"/>
<h1>Ups.</h1> 
<?php 
echo $test;
if ($id != "14") {
  echo '<a href="index.php"><p style="color: white;"><button class="btn btn-success">Powrót do strony głównej</button></p></a>';
} else {
  return;
}
?>
</center>