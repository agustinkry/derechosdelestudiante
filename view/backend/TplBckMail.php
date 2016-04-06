<?php

class TplBckMail {

    public static function getGenericMail($title, $leadBody, $link, $linkText, $centralBody = "", $calloutBody = "") {
        $oTpl = new UtlTemplate('generic.html', TPL_PATH . "mail/");
        $oTpl->assign("title", $title);
        $oTpl->assign("lead_body", $leadBody);
        $oTpl->assign("link", $link);
        $oTpl->assign("link_text", $linkText);
        $oTpl->assign("central_body", $centralBody);
        $oTpl->assign("callout_body", $calloutBody);
        return $oTpl->getOutputContent();
    }

    public static function getContactMail($name, $userMessage, $responseMessage, $rightUrl) {
        $oTpl = new UtlTemplate('contact.html', TPL_PATH . "mail/");
        
        $oTpl->assign("RIGHT_URL", $rightUrl);
        $oTpl->assign("MESSAGE", $responseMessage);
        $oTpl->assign("USER_MESSAGE", $userMessage);
        $oTpl->assign("NAME", $name);
        
        return $oTpl->getOutputContent();
    }

}
