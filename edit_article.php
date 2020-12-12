<?php

$idToModify = $_GET['id'];

include('head_and_footer/open_database.php');

// Afficher le titre et le contenu de l'article avant modification
$statement = $pdo->prepare("
    SELECT 
        ar.title, 
        ar.content,
        ar.author_id,
        CONCAT(at.first_name, ' ', at.last_name) AS author_name,
        ar.category_id,
        c.name AS category_name, 
        ar.image
    FROM articles AS ar
    INNER JOIN authors AS at ON ar.author_id = at.id
    INNER JOIN categories AS c ON ar.category_id = c.id
    WHERE ar.id = ?;
");

$statement->execute(array($idToModify));

$allData = $statement->fetchAll(PDO::FETCH_ASSOC);

// Select the authors
$statement = $pdo->prepare("
    SELECT CONCAT(first_name, ' ', last_name) AS author, id
    FROM authors;
");

$statement->execute();

$authorsList = $statement->fetchAll(PDO::FETCH_ASSOC);

// Select the categories
$statement = $pdo->prepare("
    SELECT name, id
    FROM categories;
");

$statement->execute();

$categoriesList = $statement->fetchAll(PDO::FETCH_ASSOC);
    
$pdo = null;

require('edit_article.phtml');