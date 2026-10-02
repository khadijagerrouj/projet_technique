<?php
require_once "connexion.php";

$genres = $pdo->query("SELECT * FROM genres ORDER BY nom")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $genre_id = $_POST["genre_id"];

    $stmt = $pdo->prepare("INSERT INTO auteurs (nom) VALUES (?)");
    $stmt->execute([$auteur]);
    $auteur_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO livres 
        (titre, description, image, auteur_id, genre_id)
        VALUES (?, ?, ?, ?, ?)");

    $stmt->execute([
        $titre, $description, $image, $auteur_id, $genre_id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>📚 Ma Bibliothèque</h1>
    <nav>
        <a href="index.php">Livres</a>
        <a href="ajouter.php">Ajouter un livre</a>
    </nav>
</header>

<main>
    <div class="formulaire">
        <h2>Ajouter un livre</h2>

        <form method="POST">

            <label>Titre</label>
            <input type="text" name="titre" required>

            <label>Auteur</label>
            <input type="text" name="auteur" required>

            <label>Genre</label>
            <select name="genre_id" required>
                <option value="">-- Choisir un genre --</option>

                <?php foreach ($genres as $genre): ?>
                    <option value="<?= $genre['id'] ?>">
                        <?= htmlspecialchars($genre['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Image</label>
            <input type="text" name="image" placeholder="URL de l'image">

            <button type="submit">Ajouter le livre</button>

        </form>
    </div>
</main>

</body>
</html>