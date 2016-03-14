<?php

include_once '../../../../include/include_backend.php';

$denouncedId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($denouncedId > 0) {

        $oDbaBckDenounced = new DbaBckDenounced();

        $oDenounced = $oDbaBckDenounced->getDenounced($denouncedId);

        if ($oDenounced) {
            //first get Prejudice to delete image
            if (UtlFile::fileExists(MEDIA_DENOUNCED_PATH . $oDenounced->getImage())) {
                @unlink(MEDIA_DENOUNCED_PATH . $oDenounced->getImage());
            }

            //now delete item
            if ($oDbaBckDenounced->deleteDenounced($denouncedId)) {
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
