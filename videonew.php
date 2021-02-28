<?php
session_start();
require 'danesql.php';
require_once 'partials/navbar.php';
$db = new mysqli(SQLHOST, SQLUSER, SQLPASS, DBNAME);
$id = $_GET['id'];
$_SESSION['id'] = $_GET['id'];
$video_found = false;
$stmt = sprintf("SELECT * FROM viddle_videos WHERE video_id = '%s'", $db->real_escape_string($id));
$video = [];
$publisher = [];
if ($result = @$db->query($stmt)) {
    if ($result->num_rows == '1') $video_found = true;
    else $video_found = false;
    $video = $result->fetch_assoc();
}
/*
 * DANE z video:
 * video_id -> id
 * publisher -> publisher
 * views -> views
 * comments -> comment_count
 * upvotes -> upvotes
 * downvotes -> downvotes
 * title -> title
 * publishdate -> published_at
 * opis -> description
 * fname -> filename
 */
if ($result = @$db->query("SELECT * FROM viddle_users WHERE uid")) {
    $publisher = $result->fetch_assoc();
}
/*
 * DANE Z publisher:
 * login -> username
 * observators -> followers
 * avatarname -> avatar
 */
$avatar_url = null;
if ($publisher['avatarname'] == 'x') {
    $avatar_url = 'anonim.png';
} else {
    $avatar_url = "https://cdn.viddle.xyz/cdn/videos/avatars/${publisher['publisher']}/${publisher['publisher']}.${publisher['avatarname']}";
}
?>
<div style="margin-top: 70px; justify-content: center;" class="container">
    <?php if ($video_found) { ?>
        <div class="row">
            <div class="col-md-7">
                <iframe src="https://cdn.plrjs.com/player/frb26f6hndyna/d838dwutz4s3.html?file=https://cdn.viddle.xyz/cdn/videos/videos/<?= $video_id.'/'.$filename ?>&title=<?= $title ?>" style="width: 100%; height: 360px;" frameborder="0" allowfullscreen></iframe>
                <div class="card-videoch" style="margin-top: 10px; padding: 12px; cursor: default; width: 100%;">
                    <h4 class="text-truncate"><?= $title ?></h4>
                    <div class="container row" style="margin-top: 20px;">
                        <span style="margin-left: 10px;">
                            <a href="channel?id=<?= $publisher ?>">
                                <img width="48pc" style="border-radius: 50%; margin-right: 5%;" class="img-responsive d-none d-md-block" src="<?= $av7; ?>"/>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>