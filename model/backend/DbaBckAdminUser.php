<?php

class DbaBckAdminUser {

    public static $table = "admin_user";
    public static $USER_STATUS_INACTIVE = 0;
    public static $USER_STATUS_ACTIVE = 1;

    public function login($email, $password) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "email" => $email,
                "password" => $password,
                "status" => self::$USER_STATUS_ACTIVE
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id", "name", "lastName", "email", "root", "status"), $where
        );

        if ($users) {
            $user = current($users);
            $oUser = new DataAdminUser();
            $oUser->loadFromArray($user);


            UtlSession::setBckUser($oUser);
            //set in session
            return true;
        } else {
            return false;
        }
    }

    public function reloadUser() {
        $db = new medoo();

        $oDataAdminUser = UtlSession::getBckUser();

        $where = array(
            "AND" => array(
                "id" => $oDataAdminUser->getId()
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id", "name", "lastName", "email", "root", "status"), $where
        );

        if ($users) {
            $user = current($users);
            $oUser = new DataAdminUser();
            $oUser->loadFromArray($user);


            
            UtlSession::setBckUser($oUser);
        }
    }

    public function getUser($id) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id", "name", "lastName", "email", "status", "root", "removable", "createdBy"), $where
        );

        if ($users) {
            $user = current($users);
            $oDataAdminUser = new DataAdminUser();
            $oDataAdminUser->loadFromArray($user);

           

            return $oDataAdminUser;
        } else {
            return null;
        }
    }

    public function generateToken($email) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "email" => $email,
                "status" => self::$USER_STATUS_ACTIVE
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id"), $where
        );

        if ($users) {
            $user = current($users);

            $passToken = md5(time() . "&$&$" . $user["id"]);

            $db->update(self::$table, array(//values
                "password_token" => $passToken
                    ), array(//where
                "id" => $user["id"]
            ));
            //set in session
            return $passToken;
        }

        return "";
    }

    public function recoveryPassword($token, $password) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "password_token" => $token,
                "status" => self::$USER_STATUS_ACTIVE
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id", "name", "lastName", "email", "root"), $where
        );

        if ($users) {
            //set in session
            
            $user = current($users);
            $oUser = new DataAdminUser();
            $oUser->loadFromArray($user);
            
            UtlSession::setBckUser($oUser);

            //change password
            $db->update(self::$table, array(//values
                "password" => $password,
                "#password_token" => "NULL"), array(//where
                "password_token" => $token
            ));
            return true;
        } else {
            return false;
        }
    }

    public function activateAccount($token, $password) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "activation_token" => $token,
                "status" => self::$USER_STATUS_INACTIVE
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                "admin_user", array("id", "name", "lastName", "email", "root"), $where
        );

        if ($users) {
            //set in session
            
            $user = current($users);
            
            $oUser = new DataAdminUser();
            $oUser->loadFromArray($user);
            
            UtlSession::setBckUser($oUser);

            //change password
            $db->update(self::$table, array(//values
                "password" => $password,
                "#activation_token" => "NULL",
                "status" => self::$USER_STATUS_ACTIVE), array(//where
                "activation_token" => $token
            ));
            return true;
        } else {
            return false;
        }
    }

    public function createUser(DataAdminUser $oUser) {
        $db = new medoo();

        $activationToken = md5(time() . "&$&$" . $oUser->getEmail());

        $data = array(
            "name" => $oUser->getName(),
            "lastName" => $oUser->getLastName(),
            "email" => $oUser->getEmail(),
            "activation_token" => $activationToken,
            "status" => self::$USER_STATUS_INACTIVE,
            "root" => $oUser->getRoot(),
            "createdBy" => $oUser->getCreatedBy(),
            "#created" => "NOW()"
        );

        $userArr = array(
            "id" => $db->insert(self::$table, $data),
            "token" => $activationToken
        );



        return $userArr;
    }

    public function editUser(DataAdminUser $oUser, $assignRoot) {
        $db = new medoo();
        $data = array(//values
            "name" => $oUser->getName(),
            "lastName" => $oUser->getLastName(),
            "email" => $oUser->getEmail()
        );

        if ($assignRoot) {
            $data["root"] = $oUser->getRoot();
        }
        
        return $db->update(self::$table, $data, array(//where
                    "id" => $oUser->getId()
        ));
    }

    public function checkEmailExists($email) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "email" => $email
            ),
            "LIMIT" => 1
        );

        $users = $db->select(
                self::$table, array("id"), $where
        );

        if ($users) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsers() {
        $db = new medoo();

        $oUser = UtlSession::getBckUser();

        $where = array();

        if (!$oUser->getRoot()) {
            $where = array(
                "AND" => array(
                    "createdBy" => $oUser->getId()
                ),
            );
        }

        $return = array();

        $users = $db->select(self::$table, array(
            "id",
            "name",
            "lastName",
            "email",
            "status",
            "root"), $where
        );

        foreach ($users as $user) {
            $oDataAdminUser = new DataAdminUser();
            $oDataAdminUser->loadFromArray($user);
            $return[] = $oDataAdminUser;
        }

        return $return;
    }

    public function deleteUser($userId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $userId
            ),
        );

        return $db->delete(self::$table, $where);
    }

}
