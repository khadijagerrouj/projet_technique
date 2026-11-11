<?php
class Genre{
    private $id;
    private $nom;
    private $auteur;

    public function __construct($nom,$auteur){
        $this->nom = $nom;
        $this->auteur = $auteur;

    }

    public function getNom(): string{
        return $this->nom;
    }
    public function getauteur(): string{
        return $this->auteur;
    }

}
?>