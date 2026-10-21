<?php
$fichier = "data.json";

$categories = json_decode(file_get_contents($fichier), true) ?? [];

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo json_encode($categories);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    $data["id"] = count($categories) + 1;
    $categories[] = $data;

    file_put_contents($fichier, json_encode($categories));

    echo json_encode(["message" => "Ajout réussi"]);
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    $categories = array_filter($categories, function ($cat) use ($data) {
        return $cat["id"] != $data["id"];
    });

    file_put_contents($fichier, json_encode(array_values($categories)));

    echo json_encode(["message" => "Suppression réussie"]);
}
