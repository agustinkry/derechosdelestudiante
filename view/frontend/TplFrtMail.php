<?php

class TplFrtMail {

    public static function getContactMail($name, $age, $rightId, $institutionId, $location, $grade, $message) {
        $oTpl = new UtlTemplate('contact.html', TPL_PATH . "mail/");


        $oDbaRight = new DbaFrtRight();
        $oRight = $oDbaRight->getRight($rightId);

        $oDbaInstitution = new DbaFrtInstitution();
        $oInstitution = $oDbaInstitution->getInstitution($institutionId);

        $locationName = UtlLocation::getLocationById($location);
        
        $oTpl->assign("NAME", $name);
        $oTpl->assign("AGE", $age);
        $oTpl->assign("RIGHT_TITLE", $oRight->getTitle());
        $oTpl->assign("INSTITUTION", $oInstitution->getName());
        $oTpl->assign("LOCATION", $locationName);
        $oTpl->assign("GRADE", $grade);
        $oTpl->assign("MESSAGE", $message);

        self::assignConstants($oTpl);

        return $oTpl->getOutputContent();
    }

    protected static function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);
        $oTpl->assignGlobal("WEB_URL", WEB_PATH);
    }

}
