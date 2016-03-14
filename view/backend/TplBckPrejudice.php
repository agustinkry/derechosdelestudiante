<?php

class TplBckPrejudice extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "prejudice/");
        $this->assignConstants($oTpl);


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "prejudice/");
        $this->assignConstants($oTpl);


        $denouncedId = 0;
        $categoryId = 0;

        if ($id) {
            $oDbaBckPrejudice = new DbaBckPrejudice();
            $oDataPrejudice = $oDbaBckPrejudice->getPrejudice($id);
            $existReply = false;

            if ($oDataPrejudice) {


                $denouncedId = $oDataPrejudice->getDenouncedId();
                $categoryId = $oDataPrejudice->getCategoryId();
                $oDbaDenounced = new DbaBckDenounced();

                $oDenounced = $oDbaDenounced->getDenounced($denouncedId);

                $oTpl->assign("title", $oDataPrejudice->getTitle());
                $oTpl->assign("urlPage", $oDataPrejudice->getUrlPage());
                $oTpl->assign("description", $oDataPrejudice->getDescription());
                $oTpl->assign("image", $oDataPrejudice->getImage());
                $oTpl->assign("imageFolder", MEDIA_PREJUDICE_URL);
                $oTpl->assign("id", $oDataPrejudice->getId());


                if ($oDenounced) {
                    $oDbaBckMessage = new DbaBckMessage();
                    $messages = $oDbaBckMessage->getMessagesByPrejudice($id);


                    foreach ($messages as $oMessage) {
                        $oTpl->newBlock("MESSAGE");
                        $oTpl->assign("message", $oMessage->getMessage());

                        if ($oMessage->getInBox() == 1) {
                            $oTpl->assign("position", "right");
                            $oTpl->assign("colorNumber", 1);
                            $oTpl->newBlock("USER_NAME");
                            $oTpl->assign("user", $oDenounced->getName());

                            $existReply = true;
                        } else {
                            $oTpl->assign("position", "left");
                            $oTpl->assign("colorNumber", 2);
                        }

                        $oTpl->gotoBlock("_ROOT");
                    }
                }
            }

            if ($existReply) {
                $oTpl->newBlock("RESPOND");
            } else {
                $oTpl->newBlock("NOT_RESPOND");
            }
            $oTpl->gotoBlock("_ROOT");

            $oTpl->newBlock("CORRECTION_RETRACTION");

            switch ($oDataPrejudice->getCorrectionStatus()) {
                case 0:
                    $oTpl->assign("waitingSelected", "selected");
                    break;
                case 1:
                    $oTpl->assign("correctionSelected", "selected");
                    break;
                case 2:
                    $oTpl->assign("retractionSelected", "selected");
                    break;
            }

            $oTpl->assign("urlCorrection", $oDataPrejudice->getUrlCorrection());

            $oTpl->gotoBlock("_ROOT");

            $oTpl->newBlock("STATUS");
            switch ($oDataPrejudice->getStatus()) {
                case 0:
                    $oTpl->assign("newStatusSelected", "selected");
                    break;
                case 1:
                    $oTpl->assign("publishStatusSelected", "selected");
                    break;
                case 2:
                    $oTpl->assign("rejectedStatusSelected", "selected");
                    break;
            }
            $oTpl->gotoBlock("_ROOT");
        }

        $oDbaDenounced = new DbaBckDenounced();
        $denouncedList = $oDbaDenounced->getDenouncedList();

        foreach ($denouncedList as $oDenounced) {

            $oTpl->newBlock("DENOUNCED");
            $oTpl->assign("denouncedId", $oDenounced->getId());
            $oTpl->assign("denoucedName", $oDenounced->getName());
            if ($denouncedId == $oDenounced->getId()) {
                $oTpl->assign("denouncedSelected", "selected");
            }
            $oTpl->gotoBlock("_ROOT");
        }

        $oDbaCategory = new DbaBckCategory();

        $oUser = UtlSession::getBckUser();
        $categoryList = $oDbaCategory->getCategories($oUser->getCategories());

        foreach ($categoryList as $oCategory) {
            $oTpl->newBlock("CATEGORY");
            $oTpl->assign("categoryId", $oCategory->getId());
            $oTpl->assign("categoryName", $oCategory->getName());
            if ($categoryId == $oCategory->getId()) {
                $oTpl->assign("categorySelected", "selected");
            }
            $oTpl->gotoBlock("_ROOT");
        }

        return $this->getContainer($oTpl->getOutputContent());
    }

}
