<?php

$idToModify = $_GET['id'];

$newTitle = htmlspecialchars($_POST['title']);
$newContent = htmlspecialchars($_POST['content']);
$newAuthorId = htmlspecialchars($_POST['author']);
$newCategoryId = htmlspecialchars($_POST['category']);

// Gestion de l'image
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

// Prise en compte des modifications
if(!empty($newTitle) && !empty($newContent)) {

    include('head_and_footer/open_database.php');
    
    // Modification de la table
    $statement = $pdo->prepare("
        UPDATE articles
        SET 
            title = ?, 
            content = ?,
            author_id = ?, 
            category_id = ?,
            image = ?
        WHERE id = ?;
    ");
    
    $statement->execute(array(
        $newTitle, 
        $newContent,
        $newAuthorId, 
        $newCategoryId,
        $fileDestination,
        $idToModify
    ));
    
    $pdo = null;    

}

header('Location: admin.php');