<?php
session_start();
require 'danesql.php';
require_once 'partials/navbar.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$video_found = false;
$stmt = sprintf("SELECT * FROM viddle_videos WHERE video_id = '%s'", $db->real_escape_string($id));
$assoc_video = [];
$assoc_user = [];
if ($result = @$db->query($stmt)) {
    if ($result->num_rows == '1') $video_found = true;
    else $video_found = false;
    $assoc_video = $result->fetch_assoc();
}
[
        'video_id' => $video_id,
        'publisher' => $publisher,
        'views' => $views,
        'comments' => $comments,
        'upvotes' => $upvotes,
        'downvotes' => $downvotes,
        'title' => $title,
        'publishdate' => $published_at,
        'opis' => $description
] = $assoc_video;
if ($result = @$db->query("SELECT * FROM viddle_users WHERE uid")) {
    $assoc_user = $result->fetch_assoc();
}
[
        'login' => $username,
        'observators' => $followers
] = $assoc_user;
?>
<div style="margin-top: 70px; justify-content: center;" class="container">
    <h1>
        Video ID => <?= $video_id ?>
        <br/>Publisher => <?= $publisher ?> | <?= $username ?>
        <br/>Views => <?= $views ?>
        <br/>Comments num => <?= $comments ?>
        <br/>Upvotes => <?= $upvotes ?>
        <br/>Downvotes => <?= $downvotes ?>
        <br/>Title => <?= $title ?>
        <br/>Published at => <?= $published_at ?>
        <br/>Followers => <?= $followers ?>
        <br/>Description => <?= $description ?>
    </h1>
</div>