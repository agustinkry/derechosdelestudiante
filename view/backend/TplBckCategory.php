<?php

class TplBckCategory extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "category/");
        $this->assignConstants($oTpl);


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "category/");
        $this->assignConstants($oTpl);

        $oDbaCategory = new DbaBckCategory();
        $parentsList = $oDbaCategory->getCategoryParents($id);

        if ($id) {
            $oCategory = $oDbaCategory->getCategory($id);
            $oTpl->assign("id", $oCategory->getId());
            $oTpl->assign("name", $oCategory->getName());
            $oTpl->assign("description", $oCategory->getDescription());
        }
        
        if ($parentsList) {

            foreach ($parentsList as $parent) {
                $oTpl->newBlock("PARENT_CATEGORY");
                $oTpl->assign("categoryId", $parent->getId());
                $oTpl->assign("categoryName", $parent->getName());
                if ($id && $oCategory->getParentId() == $parent->getId()) {
                    $oTpl->assign("categorySelected", "selected");
                }
                $oTpl->gotoBlock("_ROOT");
            }
        }

        return $this->getContainer($oTpl->getOutputContent());
    }

    public function __destructor() {
        
    }

}
