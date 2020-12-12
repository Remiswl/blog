<?php

$pseudo = htmlspecialchars($_POST['pseudo']);
$comment = htmlspecialchars($_POST['comment']);
$articleId = htmlspecialchars($_GET['id']);

if(!empty($pseudo) && !empty($comment)) {
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        INSERT INTO comments (content, nickname, article_id)
        VALUES (?, ?, ?);
    ");
            
    $statement->execute(array($comment, $pseudo, $articleId));
    
    $pdo = null;
    
    header('Location: article.php?id='.$articleId); 
} else {
    header('Location: article.php?id='.$articleId);
}