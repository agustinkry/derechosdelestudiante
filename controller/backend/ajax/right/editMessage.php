<?php

include_once '../../../../include/include_backend.php';

try {

    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $messageId = filter_var($_POST["messageId"], FILTER_SANITIZE_NUMBER_INT);

    if ($message && $messageId) {

        $oDbaMessage = new DbaBckMessage();

        if ($oDbaMessage->editMessage($messageId, $message)) {
            $response = array(
                "result" => true
            );
        } else {
            $response = array(
                "result" => false,
                "c" => 3
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
