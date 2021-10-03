<?php
class Season {

    private $seasonNumber, $videos;

    public function __construct($seasonNumber, $videos) {
        $this->seasonNumber = $seasonNumber;
        $this->videos = $videos;
    }

    public function getSeasonNumber() {  // Retrieves season number
        return $this->seasonNumber;
    }

    public function getVideos() { // Retrieves video number
        return $this->videos;
    }

}
?>