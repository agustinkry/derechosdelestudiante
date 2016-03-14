<?php

class UtlTemplate extends TemplatePower {

    public function __construct($file, $filePath = '') {
        try {
            if ($filePath == '')
                parent::TemplatePower(ROOT_PATH . "html/tpl/$file");
            else
                parent::TemplatePower($filePath . $file);
            $this->fileName = $file;
            $this->showTplMarks = false;
            $this->prepare();
            $this->assignGlobal('WEB_PATH', WEB_PATH);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function reset() {
        try {
            $this->serialized = false;
            $this->index = array();
            $this->content = array();
            $this->prepare();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
