<?php 

header('Access-Control-Allow-Origin:*');   // On peut changer * par le lien du site web autorisé
header("Access-Control-Allow-Headers: Authorization,Origin, X-Requested-With, Content-Type,Accept");
header('Content-Type:application/json');
//include 'db.php';
require_once 'config.php';
require_once 'JWT.php';



//On interdit toute méthode qui n'est pas POST
if($_SERVER['REQUEST_METHOD'] !=='POST'){
   http_response_code(405);
   echo json_encode([
       'message'=>'Methode non autorisée'
   ]) ;
   exit;
}
//on verifie si on recoit un token
if(isset($_SERVER['Authorization'])){
    $token=trim($_SERVER['Authorization']);
}elseif(isset($_SERVER['HTTP_AUTHORIZATION'])){
    $token=trim($_SERVER['HTTP_AUTHORIZATION']);  
}elseif(function_exists('apache_request_headers')){
    $requestHeaders=apache_response_headers();

    if(isset($requestHeaders['Authorization'])){
        $token=trim($requestHeaders['Authorization']);
    }
}
//print $_SERVER["HTTP_AUTHORIZATION"];
//print apache_request_headers()["Authorization"];
//print $app->request->headers("Authorization");

//exit;
if(!isset($token) || !preg_match('/Bearer\s(\S+)/',$token,$matches)){
    http_response_code(400);
    echo json_encode(['message'=>'Token introuvable']);
    exit;
}
//on extrait le token
$token =str_replace('Bearer ','',$token);
$jwt=new JWT();

//on verifie la validité 
if(!$jwt->isValid($token)){
    http_response_code(400);
    echo json_encode(['message'=>'Token invalide']);
    exit;
} 

//On verifie la signature
if(!$jwt->check($token,'')){
    http_response_code(403);
    echo json_encode([
        'error'=>403,
        'message'=>'Le token est invalide'
    ]);
    exit;
} 

//On verifie l'expiration
if($jwt->isExpired($token)){
    http_response_code(403);
    echo json_encode([
        'error'=>403,
        'message'=>'Le token a expiré'
    ]);
    exit;
} 
