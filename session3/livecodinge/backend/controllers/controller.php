<?php
require '../classes/genreManager.php';

class genreController{

    public function gettinggenre(){
        $gestion = new genreManager();
        $genre = $gestion->getgenre();

        header('Content-Type : application/json');
        echo json_encode($genre);
    }

    public function addinggenre($newgenre){
        $manage = new genreManager();
        $manage->addgenre($newgenre);

        header('Content-Type : application/json');
        echo json_encode(['message' => 'genre ajoutée avec succès']);
    }
}
?>