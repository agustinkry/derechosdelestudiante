<?php

include_once '../../../../include/include_backend.php';

$institutionId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($institutionId > 0) {

        $oDbaBckInstitution = new DbaBckInstitution();
        
        //now delete item
        if ($oDbaBckInstitution->deleteInstitution($institutionId)) {
            $response = array(
                "result" => true
            );
        } else {
            $response = array(
                "result" => false
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
