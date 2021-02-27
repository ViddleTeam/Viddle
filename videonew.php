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
$user_stmt = sprintf("SELECT login FROM viddle_users WHERE uid = '%s'", $db->real_escape_string($publisher));
[
        'login' => $username,
] = $db->query($stmt)->fetch_assoc();
?>
<div style="margin-top: 60px;" class="container">
    <p>
        Title => <?= $title ?>
        Description => <?= $description ?>
        Publisher => <?= $publisher ?> | <?= $username ?>
        Video ID => <?= $video_id ?>
        Published at => <?= $published_at ?>
        Upvotes => <?= $upvotes ?>
        Downvotes => <? $downvotes ?>
    </p>
</div>