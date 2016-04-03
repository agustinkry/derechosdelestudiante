<?php

class TplFrtCategories extends TplFrtContainer{
        
    public function getCategories(){
        $oTpl = new UtlTemplate('categories.html', TPL_PATH);
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border");
    }
    
}
