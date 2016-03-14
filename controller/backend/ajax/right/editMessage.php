<?php

include_once '../../../../include/include_backend.php';

try {

    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $parentMessageId = filter_var($_POST["parentMessageId"], FILTER_SANITIZE_NUMBER_INT);
    $rightId = filter_var($_POST["rightId"], FILTER_SANITIZE_NUMBER_INT);
    $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);

    if ($message && $parentMessageId && $rightId && $userEmail) {


        $oDataMessage = new DataMessage();

        $oDataMessage->setInBox(false);
        $oDataMessage->setMessage($message);
        $oDataMessage->setRightId($rightId);
        $oDataMessage->setStatus(true);
        $oDataMessage->setEmail($userEmail);
        $oDataMessage->setParentMessageId($parentMessageId);


        $oDbaBckRight= new DbaBckRight();
        $oRight = $oDbaBckRight->getRight($rightId);

        if ($oRight) {
            $link = WEB_PATH . "prejuicio/" . $rightId;

            $html = TplBckMail::getGenericMail(UtlBckMessages::$NEW_PRE_MSG_MAIL_TITLE, UtlBckMessages::$NEW_PRE_MSG_MAIL_BODY . $message, $link, UtlBckMessages::$NEW_PRE_MSG_MAIL_LINK_TEXT);
            $oMail = UtlConfigMail::getConfiguredMail();

            $oMail->addAddress($userEmail);
            $oMail->Subject = UtlBckMessages::$NEW_PRE_MSG_MAIL_SUBJECT . " - ##" . $rightId;
            $oMail->Body = UtlBckMessages::$REPLAY_ABOVE_THIS_LINE . $html;

            $oMail->send();

            //save to bd
            $oDbaBckMessage = new DbaBckMessage();
            $messageId = $oDbaBckMessage->createMessage($oDataMessage);

            if ($messageId > 0) {
                $response = array(
                    "result" => true,
                    "messageId" => $messageId,
                    "creation" => true
                );
            } else {
                $response = array(
                    "result" => false,
                    "creation" => true,
                    "c" => 3
                );
            }
        } else {
            $response = array(
                "result" => false,
                "creation" => true,
                "c" => 4
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
