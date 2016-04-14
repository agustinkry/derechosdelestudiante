<?php

class TplFrtContainer {

    private $oTpl;
    private static $defaultDescription = "Esta herramienta fue co-creada por Consejo de Educación Secundaria (CES), UNICEF Uruguay y DATA Uruguay y permite a estudiantes, padres y actores educativos consultar fichas con información actualizada y completa sobre derechos de los estudiantes. Además brinda una herramienta de consulta directa a los estudiantes, para que puedan conocer más sobre sus derechos, más allá de los temas cubiertos por las fichas.";
    private static $defaultTitle = "Derechos del Estudiante";
    public $ogDescription;
    public $ogTitle;

    public function __construct() {
        $this->oTpl = new UtlTemplate('container.html', TPL_PATH);
    }

    protected function getContainer($content, $title, $bodyClasses, $section = "") {

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

        switch ($section) {
            case "rights":
            case "search":
                $this->oTpl->assignGlobal("footerColor", "footerColor");
                $this->oTpl->assignGlobal("color", "color");
                break;
            case "categories":
            case "questions":
                $this->oTpl->assignGlobal("color", "color");
                break;
        }
        if ($section) {
            $this->oTpl->assignGlobal("active_" . $section, "active");
        }

        return $this->oTpl->getOutputContent();
    }

    protected function assignConstants(UtlTemplate $oTpl) {
        $oTpl->assignGlobal("IMG_URL", IMG_URL);
        $oTpl->assignGlobal("CSS_URL", CSS_URL);
        $oTpl->assignGlobal("COMMON_JS_URL", COMMON_JS_URL);

        if ($this->ogTitle) {
            $oTpl->assignGlobal("og_title", self::$defaultTitle . ' - ' . $this->ogTitle);
        } else {
            $oTpl->assignGlobal("og_title", self::$defaultTitle);
        }
        if ($this->ogDescription) {
            $oTpl->assignGlobal("og_description", $this->ogDescription);
        } else {
            $oTpl->assignGlobal("og_description", self::$defaultDescription);
        }
    }

}
