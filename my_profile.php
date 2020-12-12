<?php

// On démarre la session
session_start ();

// On récupère nos variables de session
if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	
	include('my_profile.phtml');
	
} else {
    
	include('error.phtml');
	
}