<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../models/artigiano.php';

$database = new Database();
$db = $database->getConnection();

$artigiano = new Artigiano($db);

$stmt = $artigiano->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $artigiani_arr = array();
    $artigiani_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $artigiano_item = array(
            "id" => $CodiceArtigiano,
            "nome" =>  $Nome,
            "cognome" => $Cognome,
            "codice_fiscale" => $CodiceFiscale,
            "data_di_nascita" => $DataDiNascita,
            "username" => $Username,
            "password" => $Password
        );

        array_push($artigiani_arr["records"], $artigiano_item);
    }

    http_response_code(200);

    echo json_encode($artigiani_arr);
}
else {
    http_response_code(404);

    echo json_encode (
        array("message" => "Non sono stati trovati artigiani")
    );
}

?>