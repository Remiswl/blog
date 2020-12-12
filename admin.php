<?php

session_start ();

if (($_SESSION['rights']) == 'admin'){
    
    include('head_and_footer/open_database.php');
    
    // Afichage des articles
    $statement = $pdo->prepare("
        SELECT 
            ar.id,
            ar.title,
            ar.content,
            ar.publication_date,
            CONCAT(at.first_name, ' ', at.last_name) AS author,
            c.name AS category,
            CASE    
                WHEN ar.image IS NULL THEN '//:0' 
                ELSE ar.image
            END AS image,
            CASE    
                WHEN ar.image IS NULL THEN '' 
                ELSE ar.title
            END AS legend
        FROM articles AS ar
        INNER JOIN authors AS at ON ar.author_id = at.id
        INNER JOIN categories AS c ON ar.category_id = c.id
        ORDER BY ar.publication_date;
    ");
    
    $statement->execute();
    
    $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    // Gestion des droits - affichage des utilisateurs
    $statement = $pdo->prepare("SELECT CONCAT(first_name, ' ', last_name) AS name, login, rights FROM users;");
    
    $statement->execute();
    
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    
    // Gestion des droits - affichage des droits
    $statement = $pdo->prepare("SELECT DISTINCT rights FROM users;");
    
    $statement->execute();
    
    $rights = $statement->fetchAll(PDO::FETCH_ASSOC);


    $pdo = null;
    
    require('admin.phtml');
} else {
    header('Location: error.phtml');
}