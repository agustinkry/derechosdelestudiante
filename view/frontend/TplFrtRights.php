<?php

class TplFrtRights extends TplFrtContainer {

    public function getRights($idCategory) {
        $oTpl = new UtlTemplate('rights.html', TPL_PATH);
        
        $oTpl->assign("ID_CATEGORY", $idCategory);

        //CATEGORY
        $oDbaCategory = new DbaFrtCategory();
        $oCategory = $oDbaCategory->getCategory($idCategory);
        $oTpl->assign("category_name", $oCategory->getName());
        $oTpl->assign("category_description", $oCategory->getDescription());
        $oTpl->assign("category_icon", $oCategory->getIcon());

        $categoryPath = $oCategory->getId() . "/" . UtlText::urlOptimize($oCategory->getName());

        //RIGHT
        $oDbaRight = new DbaFrtRight();
        $rights = $oDbaRight->getRightsByCategory($idCategory);

        foreach ($rights as $oRight) {
            $rightPath = $oRight->getId() . "/" . UtlText::urlOptimize($oRight->getTitle());
            $oTpl->newBlock("RIGHT");
            $oTpl->assign("title", $oRight->getTitle());
            $oTpl->assign("description", UtlText::cut($oRight->getDescription(), 70));
            $oTpl->assign("category_path", $categoryPath);
            $oTpl->assign("right_path", $rightPath);
        }

        //get messages of rights for this category
        $oDbaMessage = new DbaFrtMessage();
        $messages = $oDbaMessage->getMessagesByRightCategory($idCategory);

        $messageAdded = array(); //temp
        foreach ($messages as $oMessage) {

            if (!$oMessage->getParentMessageId()) {
                $oTpl->newBlock("CONVERSATION");
                
                $oTpl->newBlock("MESSAGE");
                $this->constructMessageBlock($oTpl, $oMessage);
                //search childrens
                $childrens = $this->getChildrenMessages($messages, $oMessage->getId());
                foreach ($childrens as $oChlMessage) {
                    //fill data
                    $this->constructMessageBlock($oTpl, $oChlMessage);
                }
            }
        }

        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border", "rights");
    }

    private function constructMessageBlock(&$oTpl, $oMessage) {
        $oTpl->newBlock("MESSAGE");
        if (!$oMessage->getParentMessageId()) {
            $oTpl->newBlock("MESSAGE_STUDENT");
        } else {
            $oTpl->newBlock("MESSAGE_PROFESSOR");
        }


        $formattedDate = UtlDate::getMessageDate($oMessage->getCreated());

        $oTpl->assign("message", $oMessage->getMessage());
        $oTpl->assign("date", $formattedDate);


        $oTpl->goToBlock("_ROOT");
    }

    private function getChildrenMessages($messages, $idMessage) {
        $response = array();

        foreach ($messages as $oMessage) {
            if ($oMessage->getParentMessageId() == $idMessage) {
                $response[] = $oMessage;
            }
        }
        return $response;
    }

    public function getRightsDetail($idRight, $idCategory) {
        $oTpl = new UtlTemplate('rights_detail.html', TPL_PATH);
        
        $oTpl->assign("ID_CATEGORY", $idCategory);
        $oTpl->assign("ID_RIGHT", $idRight);

        //CATEGORY
        $oDbaCategory = new DbaFrtCategory();
        $oCategory = $oDbaCategory->getCategory($idCategory);
        $oTpl->assign("category_name", $oCategory->getName());
        $oTpl->assign("category_description", $oCategory->getDescription());
        $oTpl->assign("category_icon", $oCategory->getIcon());
        $categoryPath = $oCategory->getId() . "/" . UtlText::urlOptimize($oCategory->getName());
        $oTpl->assign("category_path", $categoryPath);


        //RIGHT
        $oDbaRight = new DbaFrtRight();
        $oRight = $oDbaRight->getRight($idRight);
        $oTpl->assign("right_title", $oRight->getTitle());
        $oTpl->assign("right_description", $oRight->getDescription());
        
        $this->ogDescription = strip_tags($oRight->getDescription());
        $this->ogTitle = $oRight->getTitle();

        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border", "rights");
    }

    public function getRightsBySearch($search) {
        $oTpl = new UtlTemplate('search.html', TPL_PATH);

        $oDbaCategory = new DbaFrtCategory();

        $oDbaRight = new DbaFrtRight();
        $rights = $oDbaRight->getSearch($search);

        $message = "";
        $count = count($rights);

        switch ($count) {
            case 0:
                $message = "No se han encontrado resultados para tu b&uacute;squeda '$search'";
                break;
            case 1:
                $message = "Se ha encontrado 1 resultado para tu b&uacute;squeda '$search'";
                break;
            default :
                $message = "Se han encontrado $count resultados para tu b&uacute;squeda '$search'";
                break;
        }

        $oTpl->assign("searchMessage", $message);

        if ($count > 0) {
            $oTpl->newBlock("RESULTS");
            foreach ($rights as $oRight) {
                //CATEGORY

                $oCategory = $oDbaCategory->getCategoryByRight($oRight->getId());
                $categoryPath = $oCategory->getId() . "/" . UtlText::urlOptimize($oCategory->getName());

                $rightPath = $oRight->getId() . "/" . UtlText::urlOptimize($oRight->getTitle());
                $oTpl->newBlock("RIGHT");
                $oTpl->assign("title", $oRight->getTitle());
                $oTpl->assign("description", UtlText::cut($oRight->getDescription(), 70));
                $oTpl->assign("category_path", $categoryPath);
                $oTpl->assign("right_path", $rightPath);
            }
        } else {
            $oTpl->newBlock("NO_RESULTS");
        }


        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border", "search");
    }

}
