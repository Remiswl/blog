<?php

$articleId = htmlspecialchars($_GET['id']);

include('head_and_footer/open_database.php');

// Enregistrer le like supplémentaire dans la BDD
$statement = $pdo->prepare("
    UPDATE articles
    SET downlike = downlike + 1
    WHERE id = ?;
");

$statement->execute(array($articleId));

$pdo = null;

header('Location: article.php?id='.$articleId);