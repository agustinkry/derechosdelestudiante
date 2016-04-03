<?php

class TplBckCategory extends TplBckContainer {

    private $categoriesIcon = array(
        array("name" => "Inclusi&oacute;n", "value" => "inclusion"),
        array("name" => "Reglamento", "value" => "reglamento"),
        array("name" => "Embarazo", "value" => "emabrazo"),
        array("name" => "Deporte", "value" => "deporte"),
        array("name" => "Salud", "value" => "salud"),
        array("name" => "Acceso a la informaci&oacute;n", "value" => "access"),
        array("name" => "Participaci&oacute;n", "value" => "participacion"),
        array("name" => "Recreaci&oacute;n", "value" => "recreacion")
    );

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


        foreach ($this->categoriesIcon as $icon) {
            $oTpl->newBlock("ICON_TYPE");
            $oTpl->assign("iconName", $icon["name"]);
            $oTpl->assign("iconValue", $icon["value"]);
            if ($id && $oCategory->getIcon() == $icon["value"]) {
                $oTpl->assign("iconSelected", "selected");
            }
        }

        return $this->getContainer($oTpl->getOutputContent());
    }

    public function __destructor() {
        
    }

}
