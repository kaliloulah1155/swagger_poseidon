<?php
    
    include 'db.php';
    // Database

   
    define('DB_HOST', 'localhost');
    define('DB_PORT', '5432');
    define('DB_NAME', 'NGSYS');
    define('DB_USERNAME', 'ngsys');
    define('DB_PASSWORD', 'ngsys');
    try {
        $db = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USERNAME." password=".DB_PASSWORD);
    } catch (\Throwable $e) {
        die('Erreur: '.$e->getMessage());
    }
    
?>