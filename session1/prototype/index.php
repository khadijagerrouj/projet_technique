<?php
require_once "connexion.php";

$sql = "SELECT livres.*, auteurs.nom AS auteur, genres.nom AS genre
        FROM livres
        JOIN auteurs ON livres.auteur_id = auteurs.id
        JOIN genres ON livres.genre_id = genres.id";

$livres = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma Bibliothèque</title>
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
    <h2>Liste des livres</h2>

    <div class="livres">

        <?php foreach ($livres as $livre): ?>

        <div class="card">

            <?php if ($livre['image']): ?>
                <img src="<?= htmlspecialchars($livre['image']) ?>">
            <?php endif; ?>

            <h3><?= htmlspecialchars($livre['titre']) ?></h3>

            <p>Auteur : <?= htmlspecialchars($livre['auteur']) ?></p>

            <p>Genre : <?= htmlspecialchars($livre['genre']) ?></p>

            <p><?= htmlspecialchars($livre['description']) ?></p>

        </div>

        <?php endforeach; ?>

    </div>
</main>

</body>
</html>
