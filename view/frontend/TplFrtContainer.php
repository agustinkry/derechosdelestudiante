<?php

class TplFrtContainer {

    private $oTpl;

    public function __construct() {
        $this->oTpl = new UtlTemplate('container.html', TPL_PATH);
    }

    protected function getContainer($content, $title, $bodyClasses) {

        $this->oTpl->assign("CONTENT", $content);

        $this->oTpl->assignGlobal("pageTitle", $title);
        $this->oTpl->assignGlobal("body_classes", $bodyClasses);

        //get all categories

        $oDbaCategory = new DbaFrtCategory();
        $categories = $oDbaCategory->getAllChildrenCategories();

        foreach ($categories as $oCategory) {
            $this->oTpl->newBlock("CATEGORY");
            $this->oTpl->assign("cateogry_id", $oCategory->getId());
            $this->oTpl->assign("category_name", $oCategory->getName());
        }


        //get all rights

        $oDbaRight = new DbaFrtRight();
        $rights = $oDbaRight->getRights();
        foreach ($rights as $oRight) {
            $this->oTpl->newBlock("RIGHT");
            $this->oTpl->assign("right_id", $oRight->getId());
            $this->oTpl->assign("right_title", $oRight->getTitle());
            $this->oTpl->assign("right_categories", implode(",", $oRight->getCategories()));
        }

        //get all institutions
        $oDbaInstitution = new DbaFrtInstitution();
        $institutions = $oDbaInstitution->getAllInstitutions();
        foreach ($institutions as $oInstitution) {
            $this->oTpl->newBlock("INSTITUTION");
            $this->oTpl->assign("institution_id", $oInstitution->getId());
            $this->oTpl->assign("institution_name", $oInstitution->getName());
        }

        //location
        $locations = UtlLocation::getAllLocations();
        foreach ($locations as $key => $location) {
            $this->oTpl->newBlock("LOCATION");
            $this->oTpl->assign("location_name", $location);
            $this->oTpl->assign("location_id", $key);
        }

        $this->assignConstants($this->oTpl);

        return $this->oTpl->getOutputContent();
    }

    protected function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);
    }

}
