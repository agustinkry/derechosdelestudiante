<?php

include_once '../../../../include/include_backend.php';

if (isset($_FILES['file_data'])) {

    $oUtlFile = new UtlFile();
    $response = $oUtlFile->uploadFileRandName($_FILES['file_data'], TEMP_PATH, 'image');


    $oRespuesta = new stdClass();

    if ($response["result"] == true) {
        $oRespuesta->result = true;
        $oRespuesta->message = 'Archivo subido correctamente.';
        $oRespuesta->image = $response["name"];
        $oRespuesta->error = "";
    } else {
        $oRespuesta->image = '';
        $oRespuesta->result = false;
        $oRespuesta->message = $response["code"];
        $oRespuesta->error = "Ha ocurrido un error inesperado";
    }


    header('Content-Type: application/json');

    echo json_encode($oRespuesta);
}