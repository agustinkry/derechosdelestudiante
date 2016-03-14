<?php

define('AVOID_SECURITY', true);
include_once '../../../../include/include_backend.php';

try {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if ($email) {
        $oDbaBckAdminUser = new DbaBckAdminUser();

        $token = $oDbaBckAdminUser->generateToken($email);

        if ($token != "") {

            $link = ADMIN_URL . "forgot_password/" . $token;

            $html = TplBckMail::getGenericMail(UtlBckMessages::$FORGOT_PASSWORD_MAIL_TITLE, UtlBckMessages::$FORGOT_PASSWORD_MAIL_BODY, $link, UtlBckMessages::$FORGOT_PASSWORD_MAIL_LINK_TEXT);
            $oMail = UtlConfigMail::getConfiguredMail();

            $oMail->addAddress($email);
            $oMail->Subject = UtlBckMessages::$FORGOT_PASSWORD_MAIL_SUBJECT;
            $oMail->Body = $html;


            if ($oMail->send()) {
                $response = array(
                    "result" => true
                );
            } else {
                $response = array(
                    "result" => false
                );
            }
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
