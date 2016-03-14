<?php

include_once '../../../../include/include_backend.php';

$institutionId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);



try {

    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $location = filter_var($_POST["location"], FILTER_SANITIZE_NUMBER_INT);

    if (is_numeric($location) && $name) {


        $oDataInstitution = new DataInstitution();

        $oDataInstitution->setName($name);
        $oDataInstitution->setLocation($location);

        $oDbaBckInstitution = new DbaBckInstitution();


        if ($institutionId <= 0) {

            $institutionId = $oDbaBckInstitution->createInstitution($oDataInstitution);
            
            if ($institutionId > 0) {
                $response = array(
                    "result" => true,
                    "institutionId" => $institutionId,
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

            $oDataInstitution->setId($institutionId);

            $oDbaBckInstitution->editInstitution($oDataInstitution);

            $response = array(
                "result" => true,
                "institutionId" => $institutionId,
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
