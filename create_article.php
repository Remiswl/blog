<?php

session_start ();

if (($_SESSION['rights']) == 'admin'){
    require('create_article.phtml');
} else {
    header('Location: error.phtml');
}