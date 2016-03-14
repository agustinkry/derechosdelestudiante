<?php

include_once '../../../../include/include_backend.php';

$denunciationTypeId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);

    if ($name && $description) {


        $oDataDenunciationType = new DataDenunciationType();

        $oDataDenunciationType->setId($denunciationTypeId);
        $oDataDenunciationType->setName($name);
        $oDataDenunciationType->setDescription($description);

        $oDbaBckDenunciationType = new DbaBckDenunciationType();

        if ($denunciationTypeId <= 0) {
            $denunciationTypeId = $oDbaBckDenunciationType->createDenunciationType($oDataDenunciationType);

            if ($denunciationTypeId > 0) {
                $response = array(
                    "result" => true,
                    "denunciationTypeId" => $denunciationTypeId,
                    "creation" => true
                );
            } else {
                $response = array(
                    "result" => false,
                    "creation" => true,
                    "c" => 3
                );
            }
        } else {
            $oDbaBckDenunciationType->editDenunciationType($oDataDenunciationType);

            $response = array(
                "result" => true,
                "denunciationTypeId" => $denunciationTypeId,
                "creation" => false
            );
        }
    } else {
        $response = array(
            "result" => false,
            "c" => 2
        );
    }
} catch (Exception $exc) {
    $response = array(
        "result" => false,
        "c" => 1
    );
}

echo json_encode($response);
