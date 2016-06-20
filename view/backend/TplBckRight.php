<?php

class TplBckRight extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "right/");
        $this->assignConstants($oTpl);


        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "right/");
        $this->assignConstants($oTpl);

        $rightCategories = array();

        if ($id > 0) {
            $oDbaRight = new DbaBckRight();
            $oRight = $oDbaRight->getRight($id);


            $oTpl->assign("toggle_tab", 'data-toggle="tab"');
            $oTpl->assign("id", $oRight->getId());
            $oTpl->assign("title", $oRight->getTitle());
            $oTpl->assign("description", $oRight->getDescription());
            $oTpl->assign("ACTION_NAME", "Editar");


            if (count($oRight->getCategories()) > 0) {
                $rightCategories = $oRight->getCategories();
            }

            $oDbaMessage = new DbaBckMessage();
            $messages = $oDbaMessage->getMessagesByRight($id);

            foreach ($messages as $oMessage) {
                $this->prepareMessage($oTpl, $oMessage);
                $childMessages = $oDbaMessage->getMessagesByRight($id, $oMessage->getId());
                foreach ($childMessages as $oMessage) {
                    $this->prepareMessage($oTpl, $oMessage);
                }
            }
        } else {
            $oTpl->assign("ACTION_NAME", "Crear");
        }


        $oDbaCategory = New DbaBckCategory();
        $categories = $oDbaCategory->getCategories();

        foreach ($categories as $category) {
            $oTpl->newBlock("CATEGORY");

            $oTpl->assign("category_name", $category->getName());
            $oTpl->assign("category_id", $category->getId());
            $oTpl->assign("parent_id", $category->getParentId());

            if (in_array($category->getId(), $rightCategories)) {
                $oTpl->assign("category_checked", "checked");
            }
        }

        return $this->getContainer($oTpl->getOutputContent());
    }

    public function __destructor() {
        
    }

    function prepareMessage(&$oTpl, $oMessage) {
        $oTpl->newBlock("MESSAGE");
        $oTpl->assign("message", $oMessage->getMessage());
        $oTpl->assign("messageId", $oMessage->getId());
        $oTpl->assign("parentId", $oMessage->getParentMessageId());

        if ($oMessage->getInBox() == 1) {
            $oTpl->assign("position", "right");
            $oTpl->assign("colorNumber", 1);
            $oTpl->newBlock("USER_NAME");
            $oTpl->assign("user", $oMessage->getEmail());
            $oTpl->newBlock("REPLY");
        } else {
            $oTpl->assign("position", "left");
            $oTpl->assign("colorNumber", 2);
        }

        $oTpl->gotoBlock("_ROOT");
    }

}
