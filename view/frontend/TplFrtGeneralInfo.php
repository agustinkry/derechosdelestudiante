<?php

class TplFrtGeneralInfo extends TplFrtContainer{
        
    public function getGeneralInfo(){
        $oTpl = new UtlTemplate('general_info.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Consultas", "categories no-color green_border", "questions");
    }
    
}
