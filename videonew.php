<?php
session_start();
require 'danesql.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$already_seen = false;
//$polecenie = sprintf("SELECT * FROM viddle_videos WHERE id = %s", $db->real_escape_string($id));
$polecenie = "SELECT * FROM viddle_videos WHERE id = $id";
if ($result = $db->query($polecenie)) {
    $rows = $result->num_rows;
    $vid = $result->fetch_assoc();
    echo "<p>$vid->title</p>";
}