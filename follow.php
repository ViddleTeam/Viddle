<script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
<?php
/*if ($_POST['followid'] == false) {
    header('Location: index.php');
}
session_start();
if ($_SESSION['z1'] == true) {
  $error = 0;
  $followid = $_POST['followid'];
  require "danesql.php";
  $connect = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
  $login = $_SESSION['user'];
  $result = $connect -> query("SELECT * FROM viddle_users WHERE login='$login';");
  $dane = $result -> fetch_assoc();
  $userid = $dane['uid'];
  $login = $_SESSION['user'];
  if ($userid == $followid) {
    echo('Wystąpił błąd - nastąpiła próba zaobserwowania samego siebie.');
    $error = 1;
  }
  $result = $connect->query("SELECT * FROM viddle_users WHERE uid='$followid'");
  $d2 = $result->num_rows;
  if (isset($d2) && $d2 == '0') {
    echo('Wystąpił błąd - nieprawidłowe ID użytkownika.');
    $error = 1;
  }
  if ($isfollowing = @$connect->query(sprintf("SELECT * FROM viddle_followers WHERE followed='$followid' AND follower='$userid'"))) {
    $d2 = $isfollowing->num_rows;
    if (isset($d2) && $d2 == '0') {
      if ($error==0) {
      $success = $connect->query("INSERT INTO viddle_followers VALUES (0, '$followid', '$userid');");
      echo('Użytkownik zaobserwowany pomyślnie.');
      }
    } elseif ($error == 0) {
      if ($error==0) {
      $success = $connect->query("DELETE FROM viddle_followers WHERE followed='$followid' AND follower='$userid';");
      echo('Użytkownik odobserwowany pomyślnie.');
      }
    }
  }
} else {
  echo('Wystąpił błąd - użytkownik nie jest zalogowany.');
}
//echo('Jeżeli trafiłeś tutaj przez przypadek, to i tak nic tutaj nie ma ciekawego.');
header("Location: javascript://history.go(-1); Location.reload()");*/
require_once 'danesql.php';
session_start();
if (!isset($_GET['follow_id'])) header('Location: index');
echo $_SESSION;
if ($_SESSION['z1'] == true) {
    $error = 0;
    $db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
    if ($result = $db->query("SELECT * FROM viddle_users WHERE login='${_GET['follow_id']}'")) {
        $assoc = $result->fetch_assoc();
    }
}
?>
