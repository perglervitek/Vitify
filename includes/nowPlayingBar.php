<?php
    $query = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 15");
    $resultArray = array();
    while($row =mysqli_fetch_array($query)){
        array_push($resultArray, $row["id"]);
    }

    $jsonArray = json_encode($resultArray);
  ?>
<script>
    $( document ).ready(function () {
        currentPlayList = <?php echo $jsonArray;?>;
        audioElement = new Audio();
        setTrack(currentPlayList[0], currentPlayList, false);
    });
    function setTrack(trackId, newPlayList, play) {

        $.post("includes/handlers/ajax/getSongJson.php", {songId: trackId}, function (data) {
            var track = JSON.parse(data);
            $(".trackName span").text(track.title);
            $.post("includes/handlers/ajax/getArtistJson.php", {artistId: track.artist}, function (data) {
                var artist = JSON.parse(data);
                $(".artistName span").text(artist.name);
            });
            audioElement.setTrack(track.path);
            audioElement.play();
        });

        if(play){
            audioElement.play();
        }
    }

    function playSong() {
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }
    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }
</script>
<div id="nowPlayingContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img class="albumArtWork" src="http://www.politicalmetaphors.com/wp-content/uploads/2015/04/blog-shapes-square-windows.jpg">
                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>
                    <span class="artistName">
                        <span></span>
                    </span>
                </div>
                </span>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="controlButton previous" title="Previous button">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>
                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>
                    <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>
                    <button class="controlButton next" title="Next button">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>
                    <button class="controlButton repeat" title="Repeat button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
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
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="Volume button">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>