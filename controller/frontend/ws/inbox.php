<?php

include_once '../../../include/include_frontend.php';

$content = file_get_contents('php://input');

$oContent = json_decode($content);
$response = filter_var($oContent->StrippedTextReply, FILTER_SANITIZE_STRING);
$toEmail = filter_var($oContent->To, FILTER_SANITIZE_EMAIL);
$fromMail = filter_var($oContent->From, FILTER_SANITIZE_EMAIL);
$mailId = filter_var($oContent->MessageID, FILTER_SANITIZE_STRING);

if ($response && $toEmail && $mailId && $fromMail) {
    preg_match("/R([0-9]*)M([0-9]*)-(.*)/", $toEmail, $outPut);
    
    $responseParsed = explode("\r\n\r\n", $response);
    $response = $response[0];

    if (is_numeric($outPut[1]) && is_numeric($outPut[2])) {
        //save message
        $parentMessageId = $outPut[2];
        $rightId = $outPut[1];

        $oDataMessage = new DataMessage();

        $oDataMessage->setInBox(false);
        $oDataMessage->setMessage($response);
        $oDataMessage->setRightId($rightId);
        $oDataMessage->setStatus(true);
        $oDataMessage->setEmail($toEmail);
        $oDataMessage->setParentMessageId($parentMessageId);

        //send response


        $oDbaBckRight = new DbaFrtRight();
        $oRight = $oDbaBckRight->getRight($rightId);

        $oDbaMessage = new DbaFrtMessage();
        $oDataMessageUser = $oDbaMessage->getMessage($parentMessageId);

        $oDbaCategory = new DbaFrtCategory();
        $oDataCategory = $oDbaCategory->getCategoryByRight($rightId);


        if ($oRight) {

            //construir mail

            $categoryPath = $oDataCategory->getId() . "/" . UtlText::urlOptimize($oDataCategory->getName());
            $rightPath = $oRight->getId() . "/" . UtlText::urlOptimize($oRight->getTitle());
            $rightUrl = WEB_PATH . "derechos/" . $categoryPath . "/" . $rightPath;


            $html = TplBckMail::getContactMail($oDataMessageUser->getName(), $oDataMessageUser->getMessage(), $response, $rightUrl);
            $oMail = UtlConfigMail::getConfiguredMail();

            $oMail->addAddress($oDataMessageUser->getEmail());
            $oMail->Subject = UtlBckMessages::$NEW_QUESTION_MSG_MAIL_SUBJECT . $oRight->getTitle();
            $oMail->Body = $html;

            $oMail->send();

            //save to bd
            $oDbaFrtMessage = new DbaFrtMessage();
            $messageId = $oDbaFrtMessage->createMessage($oDataMessage);
        }
    }
}