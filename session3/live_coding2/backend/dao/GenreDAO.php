<?php
    require_once __DIR__ . '/../classes/genre.php';
    class GenreDAO{
        private static $dataFile=__DIR__ . '/../database/genre_data.json';
        public function AfficherTous(){
            $data=[];
            $genres=json_decode(file_get_contents(self::$dataFile),true);
            foreach($genres as $genre){
                $g=new Genre($genre["nom"],$genre["auteur"]);
                $data[]=$g;
            }
            return $data;
        }public function ajouter($nom,$auteur){
            $data=[];
            $genres=$this->AfficherTous();
            if(trim($nom)=="" || trim($auteur)==""){
                throw new InvalidArgumentException("Tous les champs sont obligatoires.");
            }else{
                $genres[]=new Genre($nom,$auteur);
                foreach ($genres as $genre){
                    $data[]=[
                        "nom"=>$genre->getNom(),
                        "auteur"=>$genre->getauteur(),
                    ];
                }
                file_put_contents(self::$dataFile,json_encode($data,JSON_PRETTY_PRINT));
            }
        }
    }

?>