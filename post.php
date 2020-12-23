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
  $destination = fopen("ftp://epiz_27397314:KoDX5JDbEQ3iP@ftpupload.net/" . $film, "wb");
  $source = file_get_contents($film);
  fwrite($destination, $source, strlen($source));
} else {
header('Location: index.php');
} */
echo('Strona w budowie.');
?>
