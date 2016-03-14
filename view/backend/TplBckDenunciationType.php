<?php

class TplBckDenunciationType extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "denunciation_type/");
        $this->assignConstants($oTpl);


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "denunciation_type/");
        $this->assignConstants($oTpl);
        
        if($id>0){
            $oDbaDenunciation = new DbaBckDenunciationType();
            $oDenunciation = $oDbaDenunciation->getDenunciationType($id);
            
            if ($oDenunciation){
                $oTpl->assign("id", $oDenunciation->getId());
                $oTpl->assign("name", $oDenunciation->getName());
                $oTpl->assign("description", $oDenunciation->getDescription());
            }
        }


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function __destructor() {
        
    }

}
