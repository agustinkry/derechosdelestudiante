<?php

class UtlConfigMail {

    public static function getConfiguredMail() {
        $oMail = new UtlMail();
        $oMail->isSMTP();
        //$oMail->SMTPDebug = 3;
        $oMail->Host = MAIL_HOST;
        $oMail->SMTPAuth = true;
        $oMail->Username = MAIL_USERNAME;
        $oMail->Password = MAIL_PASSWORD;
        $oMail->SMTPSecure = "tls";
        $oMail->Port = 587;
        $oMail->CharSet = "UTF-8";
        $oMail->From = FROM_MAIL;
        $oMail->FromName = MAIL_FROM_NAME;
        $oMail->isHtml(true);
        
        return $oMail;
    }

}
