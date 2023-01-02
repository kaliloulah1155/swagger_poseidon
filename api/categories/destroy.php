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

$params = [];
if (!empty($_POST['id'])) {
    $params['ID'] = $_POST['id'];
}  

if($categorie->delete_record($params))
{
    echo json_encode(array('message' => 'Catégorie supprimée'));
}else{
    echo json_encode(array('message' => "Catégorie non supprimée ou inexistante"));
}
