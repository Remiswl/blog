<?php

session_start ();

if (($_SESSION['rights']) == 'admin'){
    
    $articleId = $_GET;
    
    include('head_and_footer/open_database.php');
    
    // Importer le contenu de l'article
    $statement = $pdo->prepare("
        SELECT 
            ar.id,
            ar.title,
            ar.content,
            ar.publication_date,
            CONCAT(at.first_name, ' ', at.last_name) AS author,
            c.name AS category, 
            ar.title,
            CASE    
                WHEN ar.image IS NULL THEN '' 
                ELSE ar.title
            END AS legend,
            ar.uplike,
            ar.image,
            ar.downlike
        FROM articles AS ar
        INNER JOIN authors AS at ON ar.author_id = at.id
        INNER JOIN categories AS c ON ar.category_id = c.id;
    ");
    
    $statement->execute();
    
    $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    // Importer les commentaires
    $statement = $pdo->prepare("
        SELECT 
            c.content,
            c.nickname,
            c.article_id
        FROM comments AS c
    ");
    
    $statement->execute();
    
    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $pdo = null;
    
    require('article.phtml');
} else {
    header('Location: error.phtml');
}