<?php
/* if ($_SESSION['z1'] == true) {
  if ($_POST['titlevid'] == false) {
    header('Location: index.php');
  } else if ($_POST['desvid'] == false) {
    header('Location: index.php');
  } else if ($_POST['videovid'] == false) {
    header('Location: index.php');
  }
  $tytul = $_POST['titlevid'];
  $opis = $_POST['desvid'];
  $film = $_POST['videovid'];
  $destination = fopen("ftp://epiz_27397310:YPf7vgDQu3JpVm@ftpupload.net/" . $film, "wb");
  $source = file_get_contents($film);
  fwrite($destination, $source, strlen($source));
} else {
header('Location: index.php');
} */
echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
?>
