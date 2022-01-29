<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../models/artigiano.php';

$database = new Database();
$db = $database->getConnection();

$artigiano = new Artigiano($db);

$data = json_decode(file_get_contents("php://input"));


if(
    !empty($data->Nome) &&
    !empty($data->Cognome) &&
    !empty($data->CodiceFiscale) &&
    !empty($data->DataDiNascita) &&
    !empty($data->Username) &&
    !empty($data->Password)
) {
    $artigiano->Nome = $data->Nome;
    $artigiano->Cognome = $data->Cognome;
    $artigiano->CodiceFiscale = $data->CodiceFiscale;
    $artigiano->DataDiNascita = $data->DataDiNascita;
    $artigiano->Username = $data->Username;
    $artigiano->Password = $data->Password;

    if($artigiano->create()) {
        http_response_code(201);

        echo json_encode(array("message" => "e' stato creato un artigiano"));
    }
    else {
        http_response_code(503);

        echo json_encode(array("message" => "Non e' stato possibile creare l'artigiano"));
    }
}
else {
    http_response_code(400);

    echo json_encode(array("message" => "Non e' stato possibile creare l'artigiano. I dati non sono stati inseriti correttamente"));
}



?>