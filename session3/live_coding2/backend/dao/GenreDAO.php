<?php
    require_once "../classes/genre.php";
    class GenreDAO{
        private static $dataFile="../database/genre_data.json";

        public function AfficherTous(){
            $data=[];
            $genres=json_decode(file_get_contents(self::$dataFile),true);
            foreach($genres as $genre){
                $g=new Genre($genre["id"],$genre["nom"],$genre["auteur"]);
                $data[]=$g;
            }
            return $data;
        }

        public function ajouter($nom,$auteur){
            $data=[];
            $genres=$this->AfficherTous();
            $id=count($genres)+1;
            if(trim($nom)=="" || trim($auteur)==""){
                throw new Error("tout les champs sont obligatoire");
            }
            else{
                $genres[]=new Genre($id,$nom,$auteur);
                foreach ($genres as $genre){
                    $data[]=[
                        "id"=>$genre->getId(),
                        "nom"=>$genre->getNom(),
                        "auteur"=>$genre->getauteur(),
                    ];
                }

                file_put_contents(self::$dataFile,json_encode($data,JSON_PRETTY_PRINT));
            }
        }
    }

?>