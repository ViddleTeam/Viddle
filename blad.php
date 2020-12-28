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
  $test = "Twój plik jest jakiś troszeczkę podejrzany... lub stało się coś nieoczekiwanego.<br />Wróć do poprzedniej strony i spróbuj ponownie.<br />Możliwe że to jest problem po naszej stronie, więc skontaktuj się z naszą drużyną!<br /><h2>Kod błędu: 0x00002c</h2>";
} elseif($id=="3") {
  $test = "Kurza twarz! Wystąpił poważny błąd serwisu. Koniecznie przekaż to naszej drużynie.<br /><h3>Kod błędu: 0x00003c</h3>";
} elseif($id=="4") {
  $test = "Hola, hola, za szybko wrzucasz filmy!<br />Poczekaj aż ktoś inny wrzuci film, żeby wrzucić kolejny.<br /><h3>Kod błędu: 0x00004c</h3>";
} elseif($id=="5") {
  $test = "Twój plik zdaje się być nam nieznany, lub nawet go nie ma.<br />Błąd z którym masz doczynienia nie występuje od <br />tak o, więc lepiej zgłoś to naszej drużynie!<br /><h2>Kod błędu: 0x00002c</h2>";
} else {
  $test = "Wystąpił nieznany błąd. Koniecznie przekaż to naszej drużynie, żeby mogła się temu przyjrzeć.<br />";
}
?>
<center>
<img src="pwnedimg.png" width="200" height="200"/>
<h1>Ups.</h1>
<?php echo($test) ?>
<a href="index.php"><p style="color: white;"><button class="btn btn-success">Powrót do strony głównej</button></p></a></center>
