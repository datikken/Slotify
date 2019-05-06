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
<div id="mainContainer">
<div id="topContainer">
    <div id="navBarContainer">
        <nav class="navBar">
            <a href="index.php" class="logo">
                <img src="assets/icons/logo.png" alt="">
            </a>
            <div class="group">
                <div class="navItem search">
                    <a href="search.php" class="navItemLink">Search
                        <img src="assets/icons/search.png"  class="icon" alt="Search">
                    </a>
                </div>
            </div>
            <div class="group">
                <div class="navItem">
                    <a href="browse.php" class="navItemLink">Browse</a>
                </div>
                <div class="navItem">
                    <a href="yourMusic.php" class="navItemLink">Your music</a>
                </div>
                <div class="navItem">
                    <a href="profile.php" class="navItemLink">Profile</a>
                </div>
            </div>
        </nav>        
    </div>
</div>

    <div id="nowPlayingBarContainer">
        <div class="nowPlayingBar">
            <div class="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img src="https://ewscripps.brightspotcdn.com/dims4/default/39fa9e4/2147483647/strip/true/crop/1000x563+0+0/resize/1280x720!/quality/90/?url=https%3A%2F%2Fewscripps.brightspotcdn.com%2F8d%2Fcc%2Fbc12c88e4679a97466d123f02c78%2Fsweathearts-valentines-day-candy-pexels-2017.png" alt="">
                    </span>
                    <div class="trackInfo">
                        <span class="trackName">
                            <span>Smile</span>
                        </span><br/>
                        <span class="artistName">
                            <span>Tikken</span>
                        </span>
                    </div>
                </div>
            </div>
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
                          <div class="progressBar">
                              <div class="progressBarBg">
                                  <div class="progress"></div>
                              </div>
                          </div>
                        <span class="progressTime remaining">0.00</span>
                    </div>
                </div>
            </div>
            <div class="nowPlayingRight">
                <div class="volumeBar">
                    <button class="controlButton volume" title="Volume button">
                        <img src="assets/icons/volume.png" alt="">
                    </button>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</body>
</html>