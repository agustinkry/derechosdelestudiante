<?php

class TplFrtMail{
    public static function getContactMail($name, $age, $email, $institution, $subject, $message){
        $oTpl = new UtlTemplate('contact.html', TPL_PATH."mail/");
        
        $oTpl->assign("NAME", $name);
        $oTpl->assign("AGE", $age);
        $oTpl->assign("EMAIL", $email);
        $oTpl->assign("INSTITUTION", $institution);
        $oTpl->assign("SUBJECT", $subject);
        $oTpl->assign("MESSAGE", $message);
        
        return $oTpl->getOutputContent();
    }
}