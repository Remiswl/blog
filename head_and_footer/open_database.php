<?php

try {
    $pdo = new PDO(
        'mysql:host=home.3wa.io:3307;dbname=live-33_remis00_blog2',
        'remis00',
        '97b61d90ODM0YWQxNzBhZDBjYTNkYTY5MzMxMTM163237559',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}

$pdo->exec('set names utf8');