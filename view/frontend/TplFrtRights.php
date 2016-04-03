<?php

class TplFrtRights extends TplFrtContainer {

    public function getRights() {
        $oTpl = new UtlTemplate('rights.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border");
    }

    public function getRightsDetail($idRight) {
        $oTpl = new UtlTemplate('rights_detail.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border");
    }

}
