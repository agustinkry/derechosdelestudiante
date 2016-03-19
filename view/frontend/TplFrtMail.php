<?php

class TplFrtMail {

    public static function getContactMail($name, $age, $email, $institution, $subject, $message) {
        $oTpl = new UtlTemplate('contact.html', TPL_PATH . "mail/");

        $oTpl->assign("NAME", $name);
        $oTpl->assign("AGE", $age);
        $oTpl->assign("EMAIL", $email);
        $oTpl->assign("INSTITUTION", $institution);
        $oTpl->assign("SUBJECT", $subject);
        $oTpl->assign("MESSAGE", $message);
        
        self::assignConstants($oTpl);

        return $oTpl->getOutputContent();
    }

    protected static function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);
        $oTpl->assignGlobal("WEB_URL",WEB_PATH);
    }

}
