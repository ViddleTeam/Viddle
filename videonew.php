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
        'opis' => $description,
        'fname' => $filename
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
    <?php if ($video_found) { ?>
        <div class="row">
            <div class="col-md-7">
                <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://cdn.viddle.xyz/cdn/videos/videos/<?= $video_id.'/'.$filename ?>&title=<?= $title ?>" style="width: 100%; height: 360px;" frameborder="0" allowfullscreen></iframe>
                <div class="card-videoch" style="margin-top: 10px; padding: 12px; cursor: default; width: 100%;">
                    <h4 class="text-truncate"><?= $title ?></h4>
                </div>
            </div>
        </div>
    <?php } ?>
</div>