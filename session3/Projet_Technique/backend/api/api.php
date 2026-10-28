<?php
header('Content-Type : application/json');
require '../controllers/controller.php';

$controller = new genreController();

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $data = file_get_contents('php://input');
    $newgenre = json_decode($data, true);
    $controller->addinggenre($newgenre);
}else{
    $controller->gettinggenre();
}

?>