<?php
$hideNav = true;
require("includes/header.php");

if(!isset($_GET["id"])) { // IF NO ID ECHO THE ERROR MESSAGE
    ErrorMessage::show("No ID passed into page");
}

$video = new Video($con, $_GET["id"]);
$video->incrementViews();

$upNextVideo = VideoProvider::getUpNext($con, $video);
?>

<div class="watchContainer">
<div class="videoControls watchNav">
        <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>
   
</div>

<div class="videoControls upNext" style="display:none;">
    <button>
    <i class="fas fa-redo" onclick="restartVideo();"></i>
    </button>
    <div class="upNextContainer">
        <h2>Up Next is:</h2>
        <h3><?php echo $upNextVideo->getTitle(); ?></h3>
        <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>

        <button class="playNext">
        <i class="fas fa-play" onclick="watchVideo(<?php echo $upNextVideo->getId(); ?>);"></i> Play
        </button>
    </div>
</div>
<video controls autoplay onended="showUpNext();">
        <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
    </video>
<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>