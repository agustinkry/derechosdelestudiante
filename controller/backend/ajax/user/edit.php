<?php

include_once '../../../../include/include_backend.php';

$userId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

$oDbaBckAdminUser = new DbaBckAdminUser();
$tmpUser = $oDbaBckAdminUser->getUser($userId);

$oUser = UtlSession::getBckUser();

if ($oUser->getRoot() == 1 || $oUser->getId() == $userId || ($userId && $oUser->getId() == $tmpUser->getCreatedBy()) || !$userId) {

    try {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $lastName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
        $root = isset($_POST["permission"]) ? filter_var($_POST["permission"], FILTER_SANITIZE_NUMBER_INT) : -1;
      


        if ($email && $name && $lastName && $root != -1 || $oUser->getId() == $userId) {


            $oDataAdminUser = new DataAdminUser();

            $oDataAdminUser->setEmail($email);
            $oDataAdminUser->setName($name);
            $oDataAdminUser->setLastName($lastName);
            $oDataAdminUser->setRoot($root == 1);
            $oDataAdminUser->setId($userId);


            $oDbaBckAdminUser = new DbaBckAdminUser();

            $mailExits = false;

            if ($userId <= 0) {
                if (!$oDbaBckAdminUser->checkEmailExists($email)) {
                    $oDataAdminUser->setCreatedBy($oUser->getId());
                    $userInfo = $oDbaBckAdminUser->createUser($oDataAdminUser);
                } else {
                    $mailExits = true;
                }

                if (isset($userInfo["id"]) && $userInfo["id"] > 0) {

                    //send invitation
                    $link = ADMIN_URL . "activate_account/" . $userInfo["token"];

                    $html = TplBckMail::getGenericMail(UtlBckMessages::$ACTIVATE_ACCOUNT_MAIL_TITLE, UtlBckMessages::$ACTIVATE_ACCOUNT_MAIL_BODY, $link, UtlBckMessages::$ACTIVATE_ACCOUNT_MAIL_LINK_TEXT);
                    $oMail = UtlConfigMail::getConfiguredMail();

                    $oMail->addAddress($email);
                    $oMail->Subject = UtlBckMessages::$ACTIVATE_ACCOUNT_MAIL_SUBJECT;
                    $oMail->Body = $html;
                    $oMail->send();

                    $response = array(
                        "result" => true,
                        "userId" => $userInfo["id"],
                        "creation" => true
                    );
                } else {
                    $response = array(
                        "result" => false,
                        "mailExits" => $mailExits,
                        "creation" => true,
                        "c" => 3
                    );
                }
            } else {

                if ($oUser->getId() == $userId && !$oUser->getRoot()) {
                    $oDataAdminUser->setRoot($oUser->getRoot());
                }

                $oDbaBckAdminUser->editUser($oDataAdminUser, $oUser->getRoot() == 1);


                $needsReload = false;

                if ($oUser->getId() == $userId) {
                    $oDbaBckAdminUser->reloadUser();
                    $needsReload = true;
                }

                $response = array(
                    "result" => true,
                    "userId" => $userId,
                    "creation" => false,
                    "needsReload" => $needsReload
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
}