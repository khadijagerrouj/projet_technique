<?php
    require_once "../dao/GenreDAO.php";
    require_once "BaseService.php";
    class GenreService extends BaseService{
        private GenreDAO $genreDao;
        public function __construct(){
            $this->genreDao= new GenreDAO();
        }

        public function listerGenres(){
            $genres=$this->genreDao->AfficherTous();
            $data=[];
            foreach($genres as $genre){
                $data[]=[
                    "id"=>$genre->getId(),
                    "nom"=>$genre->getNom(),
                    "auteur"=>$genre->getauteur(),
                ];
            }
            return $data;
        }

        public function ajouterGenre(){
            $input=json_decode(file_get_contents("php://input"),true);
            try{
                http_response_code(200);
                $this->genreDao->ajouter($input["nom"],$input["auteur"]);
                return ["success"=>true,"message"=>"Genre est bien ajoute"];
            }catch(Error $e){
                http_response_code(500);
                return ["success"=>false,"message"=>$e->getMessage()];
            }
        }
    }
?>