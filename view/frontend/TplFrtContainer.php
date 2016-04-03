<?php

class TplFrtContainer {

    private $oTpl;

    public function __construct() {
        $this->oTpl = new UtlTemplate('container.html', TPL_PATH);
    }

    protected function getContainer($content, $title, $bodyClasses) {

        $this->oTpl->assign("CONTENT", $content);

        $this->oTpl->assignGlobal("pageTitle", $title);
        $this->oTpl->assignGlobal("body_classes", $bodyClasses);
        
        $this->assignConstants($this->oTpl);

        return $this->oTpl->getOutputContent();
    }

    protected function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);
    }

}
