<?php 
include("includes/config.php");

// session_destroy(); logout

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
} else {
    header("Location: register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <title>Slotify</title>
</head>
<body>
    <div id="nowPlayingBarContainer">
        <div class="nowPlayingBar">
            <div class="nowPlayingLeft"></div>
            <div class="nowPlayingCenter">
                <div class="content playerControls">
                    <div class="buttons">
                        <button class="controlButton shuffle" title="Shuffle button">
                            <img src="assets/icons/shuffle.png" alt="Shuffle">
                        </button>
                        <button class="controlButton previous" title="Previous button">
                            <img src="assets/icons/previous.png" alt="Previous">
                        </button>
                        <button class="controlButton play" title="Play button">
                            <img src="assets/icons/play.png" alt="Play">
                        </button>
                        <button class="controlButton pause" title="Pause button" style="display: none;">
                            <img src="assets/icons/pause.png" alt="Pause">
                        </button>
                        <button class="controlButton next" title="Next button">
                            <img src="assets/icons/next.png" alt="Next">
                        </button>
                        <button class="controlButton repeat" title="Repeat button">
                            <img src="assets/icons/repeat.png" alt="Repeat">
                        </button>
                    </div>
                    <div class="playbackBar">
                        <span class="progressTime current">0.00</span>
                        <div class="progressBar"></div>
                        <span class="progressTime remaining">0.00</span>
                    </div>
                </div>
            </div>
            <div class="nowPlayingRight"></div>
        </div>

    </div>
</body>
</html>