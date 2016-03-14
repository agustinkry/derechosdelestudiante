<?php

define('AVOID_SECURITY', true);
include_once '../../../../include/include_backend.php';

try {
    $token = filter_var($_POST["token"], FILTER_SANITIZE_STRING);
    $password = md5($_POST["password"]);

    if ($token && $password && UtlCommon::isValidMd5($token)) {
        $oDbaBckAdminUser = new DbaBckAdminUser();

        if ($oDbaBckAdminUser->recoveryPassword($token, $password)) {
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
} catch (Exception $exc) {
    $response = array(
        "result" => false
    );
}

echo json_encode($response);
