<?php

include_once '../../../../include/include_backend.php';

$messageId = filter_var($_POST["messageId"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($messageId > 0) {
        $oDbaBckMessage = new DbaBckMessage();
        if ($oDbaBckMessage->deleteMessage($messageId)) {
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
