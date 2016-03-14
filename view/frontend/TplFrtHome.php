<?php

class TplFrtHome extends TplFrtContainer{
        
    public function getHome(){
        $oTpl = new UtlTemplate('home.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent());
    }
    
    
}
