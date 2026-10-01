<?php
header('Content-Type: application/json');
$file = __DIR__ . '/data.json';
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
if ($_SERVER['REQUEST_METHOD'] === 'GET') { echo json_encode(['genres' => $data['genres']]); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!is_array($input) || ($input['type'] ?? '') !== 'genre' || !isset($input['nom']) || !is_string($input['nom']) || trim($input['nom']) === '') {
        echo json_encode(['success' => false, 'message' => 'Données invalides']);
        exit;
    }
    $genre = new Genre(count($data['genres']) + 1, trim($input['nom']));
    $data['genres'][] = $genre->toArray();
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(['success' => true, 'message' => 'Ajout effectué']);
    exit;
}
echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);