<?php

class Album{

    private $title;
    private $genre;
    private $artistId;
    private $artworkPath;
    private $con;
    private $id;

    public function __construct($con, $id){
        $this->con = $con;
        $this->id = $id;


        $albumQuery = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
        $album = mysqli_fetch_array($albumQuery);

        $this->title = $album["title"];
        $this->artist = $album["artist"];
        $this->genre = $album["genre"];
        $this->artworkPath = $album["artworkPath"];
    }

    public function getTitle(){
        return $this->title;
    }
    public function getArtist(){
        return new Artist($this->con, $this->artist);
    }
    public function getGenre(){
        return $this->genre;
    }
    public function getArtWorkPath(){
        return $this->artworkPath;
    }
    public function getNumberOfSongs(){
        $query = mysqli_query($this->con, "SELECT * FROM songs WHERE album='$this->id'");
        return mysqli_num_rows($query);
    }
    public function  getSongsId(){
        $query= mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
        $array = array();
        while($row =mysqli_fetch_array($query)){
            array_push($array, $row["id"]);
        }

        return $array;
    }
}