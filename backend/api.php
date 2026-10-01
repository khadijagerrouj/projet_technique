<?php
header('Content-Type: application/json');
$file = __DIR__ . '/data.json';

class Livre
{
    public function __construct(private int $id, private string $titre, private string $auteur, private string $genre) {}
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getTitre(): string { return $this->titre; }
    public function setTitre(string $titre): void { $this->titre = $titre; }
    public function getAuteur(): string { return $this->auteur; }
    public function setAuteur(string $auteur): void { $this->auteur = $auteur; }
    public function getGenre(): string { return $this->genre; }
    public function setGenre(string $genre): void { $this->genre = $genre; }
    public function toArray(): array { return ['id' => $this->id, 'titre' => $this->titre, 'auteur' => $this->auteur, 'genre' => $this->genre]; }
}

class Auteur
{
    public function __construct(private int $id, private string $nom) {}
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function toArray(): array { return ['id' => $this->id, 'nom' => $this->nom]; }
}

class Genre
{
    public function __construct(private int $id, private string $nom) {}
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function toArray(): array { return ['id' => $this->id, 'nom' => $this->nom]; }
}

$data = json_decode(file_get_contents($file), true);
if ($_SERVER['REQUEST_METHOD'] === 'GET') { echo json_encode($data); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input || !isset($input['type'])) {
        echo json_encode(['success' => false, 'message' => 'Données invalides']);
        exit;
    }
    $resources = [
        'livre' => ['livres', Livre::class, ['titre', 'auteur', 'genre']],
        'auteur' => ['auteurs', Auteur::class, ['nom']],
        'genre' => ['genres', Genre::class, ['nom']],
    ];
    $type = $input['type'];
    if (!isset($resources[$type])) {
        echo json_encode(['success' => false, 'message' => 'Type inconnu']);
        exit;
    }
    [$collection, $class, $fields] = $resources[$type];
    $values = array_map(fn($field) => $input[$field], $fields);
    $item = new $class(count($data[$collection]) + 1, ...$values);
    $data[$collection][] = $item->toArray();
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(['success' => true, 'message' => 'Ajout effectué']);
    exit;
}
echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);