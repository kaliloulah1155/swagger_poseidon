<?php
error_reporting(E_ALL);
ini_set('display_error', 1);

//http://localhost:81/API_RES_POSEIDON/api/documentation/#/Authentification/Login%3A%3Alogger
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
require_once '../../core/entete.php';   // Chargement du token

include_once '../../models/Category.php';

$categorie = new Category();

 
    $params = [
        'id' => $_GET['id']
    ];
    if($categorie->read_single_category($params['id']))
    {
        echo json_encode(array('reponses' =>$categorie->read_single_category($params['id'])));
    }else{
        echo json_encode(array('reponses' => 'Pas de categorie'));
    }
