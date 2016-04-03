<?php

class TplFrtRights extends TplFrtContainer {

    public function getRights($idCategory) {
        $oTpl = new UtlTemplate('rights.html', TPL_PATH);

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

        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border");
    }

    public function getRightsDetail($idRight, $idCategory) {
        $oTpl = new UtlTemplate('rights_detail.html', TPL_PATH);

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
        
        $this->assignConstants($oTpl);
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border");
    }

}
