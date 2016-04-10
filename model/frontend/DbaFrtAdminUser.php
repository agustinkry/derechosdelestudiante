<?php

class DbaFrtAdminUser {

    public static $table = "admin_user";

    public function getUsersRootAndWithInstitutionId($institutionId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "root" => 1,
                "status" => 1,
            ),
            "OR" => array(
                "root" => 1,
                "institution_id" => $institutionId,
            ),
        );

        $return = array();

        $users = $db->select(self::$table, array(
            "id",
            "name",
            "lastName",
            "email"), $where
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
