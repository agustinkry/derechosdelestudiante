<?php

class TplBckLogin {
    
    public static function getForgotPassword(){
        $oTpl = new UtlTemplate('forgot_password.html', TPL_PATH."login/");
        $oTpl->assignGlobal('ADMIN_URL', ADMIN_URL);
        return $oTpl->getOutputContent();
    }
    
    public static function getRecoveryPassword($token){
        $oTpl = new UtlTemplate('recovery_password.html', TPL_PATH."login/");
        $oTpl->assign("token",$token);
        $oTpl->assignGlobal('ADMIN_URL', ADMIN_URL);
        return $oTpl->getOutputContent();
    }

    public static function getLoginHtml() {
        $oTpl = new UtlTemplate('login.html', TPL_PATH."login/");
        $oTpl->assignGlobal('ADMIN_URL', ADMIN_URL);
        return $oTpl->getOutputContent();
    }

}
