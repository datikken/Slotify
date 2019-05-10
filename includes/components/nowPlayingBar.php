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
        updateVolumeProgressBar(audioElement.audio);

        $('.playbackBar .progressBar').mousedown(function() {
            mouseDown = true;
        });

        $('.playbackBar .progressBar').mousemove(function(e) {
            if(mouseDown) {
                timeFromOffset(e, this);
            }   
        });

        $('.playbackBar .progressBar').mouseup(function(e) {
            timeFromOffset(e, this);  
        });




        $('.volumeBar .progressBar').mousedown(function() {
            mouseDown = true;
        });

        $('.volumeBar .progressBar').mousemove(function(e) {
            if(mouseDown) {
                let percentage = e.offsetX / $(this).width();

                if(percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
              }
            }   
        });

        $('.volumeBar .progressBar').mouseup(function(e) {
            let percentage = e.offsetX / $(this).width();

            if(percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
            }
        });

        $(document).mouseup(function() {
            mouseDown = false;  
        });
    });

    function timeFromOffset(mouse, progressBar) {
        let percentage = mouse.offsetX / $(progressBar).width() * 100;
        let seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function setTrack(id, newPlaylist, play) {

        $.post('includes/handlers/ajax/getSongJson.php', { songId: id }, function(data) {
           const track = JSON.parse(data);
           $('.trackName span').text(track.title); 

           $.post('includes/handlers/ajax/getArtistJson.php', { artistId: track.artist }, function(data) {
             const artist = JSON.parse(data);
             $('.artistName span').text(artist.name); 
           });

           $.post('includes/handlers/ajax/getAlbumJson.php', { albumId: track.album }, function(data) {
             const album = JSON.parse(data);

             $('.albumLink img').attr("src", album.artworkPath); 
           });

           audioElement.setTrack(track);
           playSong();
        })

        if(play) {
            audioElement.play();
        }
        audioElement.pause();
    }

    function playSong() {
        if(audioElement.audio.currentTime == 0) {
            $.post('includes/handlers/ajax/updatePlays.php', { songId: audioElement.currentlyPlaying.id });
        } else {
            console.log('Dont update')
        }

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
                <img src="" alt="">
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