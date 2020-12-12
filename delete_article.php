<?php

$idToDelete = $_GET['id'];

include('head_and_footer/open_database.php');

// Commencer par supprimer les commentaires de l'article
// Puis supprimer les articles
$statement = $pdo->prepare("
    DELETE FROM comments WHERE article_id = ?;
    DELETE FROM articles WHERE id = ?;
");

$statement->execute([$idToDelete, $idToDelete]);

$pdo = null;

header('Location: admin.php');