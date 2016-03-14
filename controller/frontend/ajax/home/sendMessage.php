<?php

include_once '../../../../include/include_frontend.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {

    $name = filter_var($_POST["first-name"], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $institution = filter_var($_POST["institution"], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    if ($name && $email && $institution && $message) {
        $html = TplFrtMail::getContactMail($name, $age, $email, $institution, $subject, $message);
        $oMail = UtlConfigMail::getConfiguredMail();

        $oMail->addAddress($email);
        $oMail->Subject = $subject ? $subject : "Consulta sin asunto";
        $oMail->Body = $html;
        $oMail->addReplyTo($email);

        $oMail->send();

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

