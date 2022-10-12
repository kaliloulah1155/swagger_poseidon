<?php 
header('Content-Type:application/json');
require_once('includes/config.php');
require_once 'classes/JWT.php';
 
//On crée le header
$header=[
    'typ'=>'JWT',
    'alg'=>'HS256'
];
    
//On crée le contenu (payload)

$payload=[
    'user_id'=>123,
    'owner'=>'POSEIDON JWT',
    'roles'=>[
        'ROLE_ADMIN',
        'ROLE_USER'
    ],
    'email'=>'pos_jwt@sesin_afrika.fr'
]; 
  $jwt =new JWT();

//$token=$jwt->generate($header,$payload,SECRET,60);
$token=$jwt->generate($header,$payload,SECRET,6000);

echo json_encode([
    'user_info'=>$payload,
    'token'=>$token
]);

