<?php 
require_once 'includes/entete.php';

//Ecriture de l'api
echo json_encode([
    'user'=>$jwt->getPayload($token),
    'token'=>$token
]);