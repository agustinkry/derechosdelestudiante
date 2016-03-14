
<?php

class TplBckTutorial extends TplBckContainer {

    public function getTutorial() {
        $oTpl = new UtlTemplate('tutorial.html', TPL_PATH);
        $this->assignConstants($oTpl);

        return $this->getContainer($oTpl->getOutputContent());
    }
    
    public function __destructor() {
        
    }

}
