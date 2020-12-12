<?php

$title = htmlspecialchars($_POST['title']);
$article = htmlspecialchars($_POST['article']);
$author = htmlspecialchars($_POST['author']);
$category_name = htmlspecialchars($_POST['categories']);

// Gestion de l'image
    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['img']) AND $_FILES['img']['error'] == 0) {
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['img']['name']);

        
        $extension_upload = $infosfichier['extension'];

          
        $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
           
        if (in_array($extension_upload, $extensions_autorisees)) {
            
            $name = uniqid();
            
            $fileDestination = 'uploads/'.$name.'.'.$extension_upload;

            move_uploaded_file($_FILES['img']['tmp_name'], $fileDestination);
        }
}

if(!empty($title) && !empty($article)) {
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        INSERT INTO articles (
            title, 
            content, 
            author_id, 
            category_id, 
            image
        )
        VALUES (
            ?, 
            ?, 
            (SELECT id FROM authors AS at WHERE CONCAT(at.first_name, ' ', at.last_name) = ?), 
            (SELECT id FROM categories WHERE categories.name = ?),
            ?
        );
    ");
    
    $statement->execute(array($title, $article, $author, $category_name, $fileDestination));
    
    $pdo = null;
     
    header('Location: index.php'); 
} else {
    header('Location: create_article.php');
}