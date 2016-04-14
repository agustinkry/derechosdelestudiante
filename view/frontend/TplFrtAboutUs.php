<?php

class TplFrtAboutUs extends TplFrtContainer{
        
    public function getAboutUs(){
        $oTpl = new UtlTemplate('aboutus.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Sobre Nosotros", "categories no-color green_border", "about");
    }
    
}
