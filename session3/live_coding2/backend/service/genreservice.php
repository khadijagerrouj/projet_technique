<?php
    require_once __DIR__ . '/../dao/GenreDAO.php';
    require_once __DIR__ . '/BaseService.php';
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
                    "nom"=>$genre->getNom(),
                    "auteur"=>$genre->getauteur(),
                ];
            }
            return $data;
        }

        public function ajouterGenre(){
            $input=json_decode(file_get_contents("php://input"),true);
            try{
                if (!is_array($input)) {
                    throw new InvalidArgumentException("Les données envoyées sont invalides.");
                }
                $this->genreDao->ajouter($input["nom"] ?? "",$input["auteur"] ?? "");
                http_response_code(201);
                return ["success"=>true,"message"=>"Genre est bien ajoute"];
            }catch(InvalidArgumentException $e){
                http_response_code(400);
                return ["success"=>false,"message"=>$e->getMessage()];
            }
        }
    }
?>