<?php


error_reporting(E_ALL);
ini_set('display_error', 1);


// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/Login.php';

// Call data .
$logger = new Login();
echo json_encode($logger->logger());
 
