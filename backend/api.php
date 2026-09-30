<?php

header('Content-Type: application/json');

$file = 'data.json';


/* =========================
   CLASSE LIVRE
========================= */

class Livre
{
    private int $id;
    private string $titre;
    private string $auteur;
    private string $genre;

    public function __construct(int $id, string $titre, string $auteur, string $genre)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->genre = $genre;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }
}


/* =========================
   CLASSE AUTEUR
========================= */

class Auteur
{
    private int $id;
    private string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
}


/* =========================
   CLASSE GENRE
========================= */

class Genre
{
    private int $id;
    private string $nom;

    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
}


/* =========================
   LIRE LES DONNÉES
========================= */

$data = json_decode(file_get_contents($file), true);


/* =========================
   GET
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    echo json_encode($data);

    exit;
}


/* =========================
   POST
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['type'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Données invalides'
        ]);
        exit;
    }


    /* Ajouter un livre */

    if ($input['type'] === 'livre') {

        $id = count($data['livres']) + 1;

        $livre = new Livre(
            $id,
            $input['titre'],
            $input['auteur'],
            $input['genre']
        );

        $data['livres'][] = [
            'id' => $livre->getId(),
            'titre' => $livre->getTitre(),
            'auteur' => $livre->getAuteur(),
            'genre' => $livre->getGenre()
        ];
    }


    /* Ajouter un auteur */

    elseif ($input['type'] === 'auteur') {

        $id = count($data['auteurs']) + 1;

        $auteur = new Auteur(
            $id,
            $input['nom']
        );

        $data['auteurs'][] = [
            'id' => $auteur->getId(),
            'nom' => $auteur->getNom()
        ];
    }


    /* Ajouter un genre */

    elseif ($input['type'] === 'genre') {

        $id = count($data['genres']) + 1;

        $genre = new Genre(
            $id,
            $input['nom']
        );

        $data['genres'][] = [
            'id' => $genre->getId(),
            'nom' => $genre->getNom()
        ];
    }


    else {
        echo json_encode([
            'success' => false,
            'message' => 'Type inconnu'
        ]);
        exit;
    }


    /* Enregistrer dans JSON */

    file_put_contents(
        $file,
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );


    echo json_encode([
        'success' => true,
        'message' => 'Ajout effectué'
    ]);

    exit;
}


echo json_encode([
    'success' => false,
    'message' => 'Méthode non autorisée'
]);