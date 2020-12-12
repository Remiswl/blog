<?php

session_start ();

if (($_SESSION['rights']) == 'admin'){
    
    $login = htmlspecialchars($_POST['user']);
    $rights = htmlspecialchars($_POST['right']);
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        UPDATE users 
        SET rights = ?
        WHERE login = ?;
    ");
    
    $statement->execute(array($rights, $login));
    
    $pdo = null;
    
    header('Location: admin.php');

} else {
    header('Location: error.phtml');
}