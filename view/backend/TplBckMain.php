<?php

class TplBckMain extends TplBckContainer{
        
    public function getMain(){
        $oTpl = new UtlTemplate('main.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent());
    }
    
    
}
