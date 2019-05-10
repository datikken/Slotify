<?php 
    $songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
?>

<script>
    $(document).ready(function() {
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(id, newPlaylist, play) {

        $.post('includes/handlers/ajax/getSongJson.php', { songId: id }, function(data) {
           const track = JSON.parse(data);
           $('.trackName span').text(track.title); 

           $.post('includes/handlers/ajax/getArtistJson.php', { artistId: track.artist }, function(data) {
             const artist = JSON.parse(data);
             $('.artistName span').text(artist.name); 

           });

           audioElement.setTrack(track.path);
           audioElement.play();
        })

        if(play) {
            audioElement.play();
        }
        audioElement.pause();
    }

    function playSong() {
        $('.controlButton.play').hide();
        $('.controlButton.pause').show();
        audioElement.play();
    }
    function pauseSong() {
        $('.controlButton.play').show();
        $('.controlButton.pause').hide();
        audioElement.pause();
    }
</script>

<div id="nowPlayingBarContainer">
<div class="nowPlayingBar">
    <div class="nowPlayingLeft">
        <div class="content">
            <span class="albumLink">
                <img src="https://ewscripps.brightspotcdn.com/dims4/default/39fa9e4/2147483647/strip/true/crop/1000x563+0+0/resize/1280x720!/quality/90/?url=https%3A%2F%2Fewscripps.brightspotcdn.com%2F8d%2Fcc%2Fbc12c88e4679a97466d123f02c78%2Fsweathearts-valentines-day-candy-pexels-2017.png" alt="">
            </span>
            <div class="trackInfo">
                <span class="trackName">
                    <span></span>
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
                <button class="controlButton play" title="Play button" onclick="playSong()">
                    <img src="assets/icons/play.png" alt="Play">
                </button>
                <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
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