<?php

$newAuthorFirstName = htmlspecialchars($_POST['newAuthorFirstName']);
$newAuthorLastName = htmlspecialchars($_POST['newAuthorLastName']);

if(!empty($newAuthorFirstName) && !empty($newAuthorLastName)) {
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        INSERT INTO authors (first_name, last_name)
        VALUES (?, ?);
    ");
            
    $statement->execute([$newAuthorFirstName, $newAuthorLastName]);

    $pdo = null;
    
    header('Location: create_article.php'); 
} else {
    header('Location: create_article.php');
}