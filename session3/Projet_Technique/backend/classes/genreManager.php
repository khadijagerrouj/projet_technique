<?php
require 'genre.php';

class genreManager{
    private $file;

    public function __construct(){
        $this->file = '../database/genre_data.json';
    }

    public function getgenre(){
        if(file_exists($this->file)){
            $json = file_get_contents($this->file);
            return json_decode($json,true);
        }
        return [];
    }

    public function addgenre($newgenre){
        $genre = $this->getgenre();
        $genre[] = $newgenre;
        file_put_contents($this->file, json_encode($genre));
    }
}
?>