<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../service/genreservice.php';

$controller = new GenreService();

if(($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST'){
    $result = $controller->ajouterGenre();
}else{
    $result = $controller->listerGenres();
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>