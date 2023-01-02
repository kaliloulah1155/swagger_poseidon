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
if (!empty($_POST['slu'])) {
    $params['SLU'] = $_POST['slu'];
}  
if (!empty($_POST['len'])) {
    $params['LEN'] = $_POST['len'];
}  
if (!empty($_POST['lfr'])) {
    $params['LFR'] = $_POST['lfr'];
} 
if (!empty($_POST['pst'])) {
    $params['PST'] = $_POST['pst'];
} 
if (!empty($_POST['ica'])) {
    $params['ICA'] = $_POST['ica'];
} 
if (!empty($_POST['cod'])) {
    $params['COD'] = $_POST['cod'];
} 
if (!empty($_POST['stt'])) {
    $params['STT'] = $_POST['stt'];
}


if($categorie->update_new_record($params))
{
    echo json_encode(array('message' => 'Catégorie modifiée'));
}else{
    echo json_encode(array('message' => 'Catégorie non modifiée ou inexistante'));
}
 