<?php

class TplBckContainer {

    private $oTpl;

    public function __construct() {
        $this->oTpl = new UtlTemplate('container.html', TPL_PATH);
    }

    protected function getContainer($content) {

        $this->oTpl->assign("CONTENT", $content);


        $oUser = UtlSession::getBckUser();
        if ($oUser->getRoot() == 1) {
            $this->oTpl->newBlock("USER_PERMISSION_B");
        }
        $this->oTpl->gotoBlock("_ROOT");
        $this->oTpl->assign("userId", $oUser->getId());

        $this->assignConstants($this->oTpl);
        $this->assignUserVars();

        return $this->oTpl->getOutputContent();
    }

    private function assignUserVars() {
        $oDataAdminUser = UtlSession::getBckUser();
        $this->oTpl->assign("user_name", $oDataAdminUser->getName() . " " . $oDataAdminUser->getLastName());
    }

    protected function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);
        $oTpl->assignGlobal('ADMIN_URL', ADMIN_URL);
    }

}
