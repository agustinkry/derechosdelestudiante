<?php

include_once '../../../../include/include_backend.php';

$prejudiceId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($prejudiceId > 0) {

        $oDbaBckPrejudice = new DbaBckPrejudice();

        $oPrejudice = $oDbaBckPrejudice->getPrejudice($prejudiceId);

        if ($oPrejudice) {
            //first get Prejudice to delete image
            if (UtlFile::fileExists(MEDIA_PREJUDICE_PATH . $oPrejudice->getImage())) {
                @unlink(MEDIA_PREJUDICE_PATH . $oPrejudice->getImage());
            }

            //now delete item
            if ($oDbaBckPrejudice->deletePrejudice($prejudiceId)) {
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
