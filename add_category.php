<?php

$newCategory = htmlspecialchars($_POST['newCategory']);

if(!empty($newCategory)) {
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        INSERT INTO categories (name)
        VALUES (?);
    ");
            
    $statement->execute([$newCategory]);
    
    $pdo = null;
    
    header('Location: create_article.php'); 
} else {
    header('Location: create_article.php');
}