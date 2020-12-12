<?php
session_start ();

$login = htmlspecialchars($_POST['login']);
$password = htmlspecialchars($_POST['password']);

// Si le visiteur a bien entré un login et un mot de passe
if (isset($login) && isset($password)) {
    
    // On ouvre la BDD pour consulter les clés login/password
    include('head_and_footer/open_database.php');
    
    $statement = $pdo->prepare("SELECT CONCAT(first_name, ' ', last_name) AS name, login, password, rights FROM users;");
    
    $statement->execute();
    
    $connexion = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $pdo = null;
    
    // Pour chacune des paires login/password de la BDD
    for ($index = 0; $index < sizeof($connexion); $index++) {
        
        // Si la paire entrée correspond à une des paires de la BDD: 
        if(
            ($login == $connexion[$index]['login']) && 
            (password_verify($password, $connexion[$index]['password']))
        ) {
          
            // On démarre la session
    		session_start ();
    		
    		// On enregistre les paramètres du visiteur comme variables de session
    		$_SESSION['login'] = $login;
    		$_SESSION['password'] = $password;
    		$_SESSION['name'] = $connexion[$index]['name'];
    		$_SESSION['logged_in'] = true;
    		$_SESSION['rights'] = $connexion[$index]['rights'];
            
           if ($_SESSION['rights'] == 'admin') {
        	    header('Location: admin.php');
            } else {
                header('Location: my_profile.php');
            }
        }
    }
} else {
    header('Location: login.phtml');
} 