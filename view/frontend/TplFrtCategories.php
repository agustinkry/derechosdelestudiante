<?php

class TplFrtCategories extends TplFrtContainer {

    public function getCategories() {
        $oTpl = new UtlTemplate('categories.html', TPL_PATH);
        $this->assignConstants($oTpl);

        $oDbaCategory = new DbaFrtCategory();
        $categories = $oDbaCategory->getAllChildrenCategories();

        if ($categories) {
            foreach ($categories as $cat) {
                $oTpl->newBlock("CATEGORY");
                $oTpl->assign("name", $cat->getName());
                $oTpl->assign("icon", $cat->getIcon());
                $url = $cat->getId() . "/" . UtlText::urlOptimize($cat->getName()) . "/";
                $oTpl->assign("url", $url);
                //
            }
        }
        
        
        return $this->getContainer($oTpl->getOutputContent(), "Categor&iacute;as", "categories no-color green_border", "rights");
    }

}
