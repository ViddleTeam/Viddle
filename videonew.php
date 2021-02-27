<?php
session_start();
require 'danesql.php';
require_once 'partials/navbar.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];

$stmt = sprintf("SELECT * FROM viddle_videos WHERE video_id = '%s'", $db->real_escape_string($id));
if ($result = $db->query($stmt)) {
    [
        'title' => $title,
        'opis' => $description,
        'publisher' => $publisher,
        'video_id' => $video_id,
        'publishdate' => $published_at,
        'upvotes' => $upvotes,
        'downvotes' => $downvotes
    ] = $result->fetch_assoc();
}
?>
<div style="margin-top: 60px;" class="container">
    <p>
        Title => <?= $title ?>
        Description => <?= $description ?>
        Publisher => <?= $publisher ?>
        Video ID => <?= $video_id ?>
        Published at => <?= $published_at ?>
        Upvotes => <?= $upvotes ?>
        Downvotes => <? $downvotes ?>
    </p>
</div>