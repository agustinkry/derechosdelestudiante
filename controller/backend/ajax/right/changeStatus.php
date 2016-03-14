<?php

include_once '../../../../include/include_backend.php';

$prejudiceId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
$status = filter_var($_POST["status"], FILTER_SANITIZE_NUMBER_INT);

try {
    if ($prejudiceId > 0) {
        $oDbaBckPrejudice = new DbaBckPrejudice();
        
        $oDbaBckPrejudice->changeStatus($prejudiceId, $status);
        $response = array(
            "result" => true
        );
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
