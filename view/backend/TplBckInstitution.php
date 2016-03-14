<?php

class TplBckInstitution extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "institution/");
        $this->assignConstants($oTpl);


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "institution/");
        $this->assignConstants($oTpl);

        $locations = UtlLocation::getAllLocations();

        $idLocation = -1;

        if ($id) {
            $oDbaBckInstitution = new DbaBckInstitution();
            $oInstitution = $oDbaBckInstitution->getInstitution($id);
            $oTpl->assign("name", $oInstitution->getName());
            $oTpl->assign("id", $oInstitution->getId());
            $idLocation = $oInstitution->getLocation();
        }
        
        foreach ($locations as $key => $value) {
            $oTpl->newBlock("LOCATION");

            $oTpl->assign("locationName", $value);
            $oTpl->assign("locationId", $key);

            if ($idLocation == $key) {
                $oTpl->assign("locationSelected", "selected");
            }
        }

        /*
          $oDbaBckDenunciationType = new DbaBckDenunciationType();
          $denunciationList = $oDbaBckDenunciationType->getDenunciationTypes();
          $idDenType = 0;

          if ($id > 0) {
          $oDbaBckDenounced = new DbaBckDenounced();
          $oDataDenounced = $oDbaBckDenounced->getDenounced($id);
          if ($oDataDenounced) {
          $oTpl->assign("name", $oDataDenounced->getName());
          $oTpl->assign("page", $oDataDenounced->getPage());
          $oTpl->assign("description", $oDataDenounced->getDescription());
          $oTpl->assign("email", $oDataDenounced->getEmail());
          $oTpl->assign("image", $oDataDenounced->getImage());
          $oTpl->assign("imageFolder", MEDIA_DENOUNCED_URL);
          $oTpl->assign("id", $oDataDenounced->getId());
          $idDenType = $oDataDenounced->getDenunciationType();
          }
          }


          foreach ($denunciationList as $denunciation) {
          $oTpl->newBlock("DENUNCIATION_TYPE");
          $oTpl->assign("denunciationName", $denunciation->getName());
          $oTpl->assign("denunciationId", $denunciation->getId());

          if($idDenType == $denunciation->getId()){
          $oTpl->assign("denunciationSelected", "selected");
          }
          } */

        return $this->getContainer($oTpl->getOutputContent());
    }

    public function __destructor() {
        
    }

}
