<?php

session_start ();

$lastName=htmlspecialchars($_POST['last_name']);
$firstName=htmlspecialchars($_POST['first_name']);
$email=htmlspecialchars($_POST['email']);
$login=htmlspecialchars($_POST['login']);
$password=password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);

if(!empty($lastName) && !empty($firstName) && !empty($email) && !empty($login) && !empty($password)) {
    
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("
        INSERT INTO users (
            first_name, 
            last_name,
            email,
            login,
            password
        )
        VALUES (
            :first_name, 
            :last_name,
            :email,
            :login,
            :password
        );
    ");
            
    $statement->execute(array(
            'first_name' => $firstName, 
            'last_name' => $lastName,
            'email' => $email, 
            'login' => $login, 
            'password' => $password
    ));

    $pdo = null;
    
    header('Location: registrationOk.phtml'); 
} else {
    header('Location: echec.phtml');
}