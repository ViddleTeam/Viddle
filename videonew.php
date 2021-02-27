<?php
session_start();
require 'danesql.php';
require_once 'partials/navbar.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$assoc = null;
$stmt = sprintf("SELECT * FROM viddle_videos WHERE video_id = '%s'", $db->real_escape_string($id));
if ($result = $db->query($stmt)) {
    $assoc = $result->fetch_assoc();
}
?>
<h1 style="margin-top: 50px;"><? array_map(function(string $value) {
    echo $value;
    }, $assoc) ?></h1>
