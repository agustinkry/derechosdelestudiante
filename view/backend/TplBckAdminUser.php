<?php

class TplBckAdminUser extends TplBckContainer {

    public function getList() {
        $oTpl = new UtlTemplate('list.html', TPL_PATH . "admin_user/");
        $this->assignConstants($oTpl);

        $oDbaBckAdminUser = new DbaBckAdminUser();
        $users = $oDbaBckAdminUser->getUsers();

        foreach ($users as $oUser) {
            $oTpl->newBlock("USER_ITEM");

            $oTpl->assign("id", $oUser->getId());
            $oTpl->assign("name", $oUser->getName());
            $oTpl->assign("lastName", $oUser->getLastName());
            $oTpl->assign("email", $oUser->getEmail());

            switch ($oUser->getStatus()) {
                case DbaBckAdminUser::$USER_STATUS_ACTIVE:
                    $oTpl->assign("status", "Activo");
                    $oTpl->assign("css_status", "default");
                    break;
                default:
                    $oTpl->assign("status", "Inactivo");
                    $oTpl->assign("css_status", "info");
                    break;
            }
        }

        return $this->getContainer($oTpl->getOutputContent());
    }

    public function getEdit($id = 0) {
        $oTpl = new UtlTemplate('edit.html', TPL_PATH . "admin_user/");
        $this->assignConstants($oTpl);

        $oUser = UtlSession::getBckUser();
        if ($oUser->getRoot() == 1) {
            $oTpl->newBlock("ROOT_ASSIGN");
            $oTpl->gotoBlock("_ROOT");
        }

        if ($id) {
            $oDbaBckAdminUser = new DbaBckAdminUser();
            $oDataAdminUser = $oDbaBckAdminUser->getUser($id);
            $oTpl->assign("name", $oDataAdminUser->getName());
            $oTpl->assign("lastName", $oDataAdminUser->getLastName());
            $oTpl->assign("email", $oDataAdminUser->getEmail());
            $oTpl->assign("id", $oDataAdminUser->getId());

            if ($oDataAdminUser->getRoot() == 1) {
                $oTpl->assignGlobal("rootSelected", "selected");
            } else {
                $oTpl->assignGlobal("adminSelected", "selected");
            }
        }
/*
        $oDbaCategory = New DbaBckCategory();
        $userCategories = array(-1);
        if(count($oUser->getCategories()) > 0 ){
            $userCategories = $oUser->getCategories();
        }else if($oUser->getRoot()){
            $userCategories = array();
        }
        $categories = $oDbaCategory->getCategories($userCategories);

        if ($oUser->getId() != $id || $oUser->getRoot()) {
            foreach ($categories as $category) {
                $oTpl->newBlock("CATEGORY");

                $oTpl->assign("category_name", $category->getName());
                $oTpl->assign("category_id", $category->getId());
                $oTpl->assign("parent_id", $category->getParentId());

                if (isset($oDataAdminUser)) {
                    if (in_array($category->getId(), $oDataAdminUser->getCategories())) {
                        $oTpl->assign("category_checked", "checked");
                    }
                }
            }
        }*/

        return $this->getContainer($oTpl->getOutputContent());
    }

    public static function getActivateAccount($token) {
        $oTpl = new UtlTemplate('activate_account.html', TPL_PATH . "admin_user/");
        $oTpl->assign("token", $token);
        $oTpl->assignGlobal('ADMIN_URL', ADMIN_URL);
        return $oTpl->getOutputContent();
    }

}
