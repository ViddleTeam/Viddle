<?php
session_start();
require 'danesql.php';
require_once 'partials/navbar.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$stmt = sprintf("SELECT * FROM viddle_videos WHERE video_id = '%s'", $db->real_escape_string($id));
[
    'title' => $title,
    'opis' => $description,
    'publisher' => $publisher,
    'video_id' => $video_id,
    'publishdate' => $published_at,
    'upvotes' => $upvotes,
    'downvotes' => $downvotes
] = $db->query($stmt)->fetch_assoc();
[
        'login' => $username,
] = $db->query("SELECT * FROM viddle_users WHERE uid = '$publisher'")->fetch_assoc();
?>
<div style="margin-top: 60px;" class="container">
    <p>
        Title => <?= $title ?>
        <br></br>Description => <?= $description ?>
        <br></br>Publisher => <?= $publisher ?> | <?= $username ?>
        <br>Video ID => <?= $video_id ?>
        <br>Published at => <?= $published_at ?>
        <br></br>Upvotes => <?= $upvotes ?>
        <br></br>Downvotes => <? $downvotes ?>
    </p>
</div>