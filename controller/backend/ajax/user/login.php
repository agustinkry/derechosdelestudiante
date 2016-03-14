<?php

define('AVOID_SECURITY', true);
include_once '../../../../include/include_backend.php';

try {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = md5($_POST["password"]);

    if ($email && $password) {
        $oDbaBckAdminUser = new DbaBckAdminUser();

        if ($oDbaBckAdminUser->login($email, $password)) {
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
