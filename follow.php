<script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
<?php
if ($_POST['followid'] == false) {
    header('Location: index.php');
}
session_start();
if ($_SESSION['z1'] == true) {

} else {
echo('Wystąpił błąd - użytkownik zalogowany.');
}
echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
?>
