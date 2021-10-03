<?php
class Video {
    private $con, $sqlData, $entity;

    public function __construct($con, $input) {
        $this->con = $con;

        if(is_array($input)) {
            $this->sqlData = $input;
        }
        else {
            $query = $this->con->prepare("SELECT * FROM videos WHERE id=:id");
            $query->bindValue(":id", $input);
            $query->execute();

            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }

        $this->entity = new Entity($con, $this->sqlData["entityId"]);
    }

    public function getId() {  // Retrieves video id
        return $this->sqlData["id"];
    }

    public function getTitle() {  // Retrieves title
        return $this->sqlData["title"];
    }

    public function getDescription() {  // Retrieves description
        return $this->sqlData["description"];
    }

    public function getFilePath() { // Retrieves file path
        return $this->sqlData["filePath"];
    }

    public function getThumbnail() {  // Retrieves thumbnail
        return $this->entity->getThumbnail();
    }

    public function getEpisodeNumber() { // Retrieves episode number
        return $this->sqlData["episode"];
    }

    public function getSeasonNumber() { // Retrieves season number
        return $this->sqlData["season"];
    }

    public function getEntityId() { // Retrieves entity ID
        return $this->sqlData["entityId"];
    }

    public function incrementViews() {  // Increments video views
        $query = $this->con->prepare("UPDATE videos SET views=views+1 WHERE id=:id");
        $query->bindValue(":id", $this->getId());
        $query->execute();
    }

    public function getSeasonAndEpisode() {
        if($this->isMovie()) {
            return;
        }

        $season = $this->getSeasonNumber();
        $episode = $this->getEpisodeNumber();

        return "Season $season, Episode $episode";
    }
    public function isMovie() {
        return$this->sqlData["isMovie"] == 1;
    }

    public function isInProgress($username) { // To aid in display play or continue watching button
        $query = $this->con->prepare("SELECT * FROM videoProgress WHERE videoId=:videoId AND username=:username");
        $query->bindValue(":videoId", $this->getId());
        $query->bindValue(":username", $username);
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function hasSeen($username) {
        $query = $this->con->prepare("SELECT * FROM videoProgress WHERE videoId=:videoId AND username=:username AND finished=1");
        $query->bindValue(":videoId", $this->getId());
        $query->bindValue(":username", $username);
        $query->execute();

        return $query->rowCount() != 0;
    }
}
?>