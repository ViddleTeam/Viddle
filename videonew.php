<?php
session_start();
require 'danesql.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$already_seen = false;
$user_ip = null;
if (!empty($_SERVER['HTTP_CLIENT_IP'])) $user_ip = $_SERVER['HTTP_CLIENT_IP'];
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
else $user_ip = $_SERVER['REMOTE_ADDR'];
$polecenie = sprintf("SELECT * FROM viddle_videos WHERE video_id = %s", $db->real_escape_string($id));
if ($result = $db->query($polecenie)) {
    $rows = $result->num_rows;
}
?>
<p>Witaj na nowej stronie Video!</p>
