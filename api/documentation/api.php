<?php
require("../../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/API_RES_POSEIDON/models']);

header('Content-Type: application/x-json');
echo $openapi->toJSON();