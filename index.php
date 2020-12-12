<?php

session_start ();

include('head_and_footer/open_database.php');

$statement = $pdo->prepare("
    SELECT 
        ar.id,
        ar.title,
        ar.content,
        ar.publication_date,
        CONCAT(at.first_name, ' ', at.last_name) AS author,
        c.name AS category,
        ar.image,
        CASE    
            WHEN ar.image IS NULL THEN '' 
            ELSE ar.title
        END AS legend,
        ar.uplike
    FROM articles AS ar
    INNER JOIN authors AS at ON ar.author_id = at.id
    INNER JOIN categories AS c ON ar.category_id = c.id
    ORDER BY ar.publication_date DESC;
");

$statement->execute();

$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;

require('index.phtml');