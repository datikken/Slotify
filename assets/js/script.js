let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];
let audioElement;
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let shuffle = false;
var userLoggedIn;
let timer;


function createPlaylist(username) {
    let alert = prompt('Please enter a name of your playlist');

    if(alert != null) {
        $.post('includes/handlers/ajax/createPlaylist.php', {name: alert, username: userLoggedIn})
        .done(function(error) {
            openPage('yourMusic.php');

        if(error != null) {
            console.log(error);
            return;
          }
        })
    }
}

function formatTime(sec) {
    let time = Math.round(sec);
    let minutes = Math.floor(time/60);
    let seconds = time - minutes * 60;

    let extraZero = (seconds < 10) ? '0': '';

    return minutes + ":" + extraZero + seconds;
}

function openPage(url) {
    if(timer != null) {
        clearTimeout(timer);
    }
    if(url.indexOf('?') == -1) {
        url = url + '?';
    }
    var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    $('#mainContent').load(encodedUrl);
    $('body').scrollTop(0);
    history.pushState(null,null, url);
}

function updateTimeProgressBar(audio) {
    $('.progressTime.current').text(formatTime(audio.currentTime));
    $('.progressTime.remaining').text(formatTime(audio.duration - audio.currentTime));

    let progress = audio.currentTime / audio.duration * 100;
    $('.playbackBar .progress').css('width', progress + '%');
}

function updateVolumeProgressBar(audio) {
    let volume = audio.volume * 100;
    $('.volumeBar .progress').css('width', volume + '%');
}
function playFirstSong() {
    setTrack(tempPlaylist[0], tempPlaylist, true); 
}
function Audio(){

    this.currentlyPlaying;
    this.audio = document.createElement('audio');
    this.audio.addEventListener('ended', function() {
        nextSong();
    });
    
    this.audio.addEventListener("canplay", function() {
        const duration = formatTime(this.duration);
        $('.progressTime.remaining').text(duration);

    });

    this.audio.addEventListener("timeupdate", function() {
        if(this.duration) {
            updateTimeProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange", function() {
        updateVolumeProgressBar(this);
    });

    this.setTrack = function(track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }
    this.play = function() {
        this.audio.play();
    }
    this.pause = function() {
        this.audio.pause();
    }
    this.setTime = function(seconds) {
        this.audio.currentTime = seconds;
    }
}