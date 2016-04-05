<?php

class DbaFrtInstitution {

    public static $table = "institution";

    public function getInstitution($id) {
        $db = new medoo();


        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $institutionList = $db->select(
                self::$table, array("id", "name", "location", "created", "modified"), $where
        );


        if ($institutionList) {
            $institution = current($institutionList);
            $oInstitution = new DataInstitution();
            $oInstitution->loadFromArray($institution);
            return $oInstitution;
        } else {
            return null;
        }
    }

    public function getAllInstitutions() {
        $db = new medoo();

        $return = array();

        $where = array();


        $institutionList = $db->select(self::$table, array(
            "id",
            "name",
            "location"), $where
        );

        if ($institutionList) {
            foreach ($institutionList as $institution) {
                $oDataInstitution = new DataInstitution();
                $oDataInstitution->loadFromArray($institution);
                $return[] = $oDataInstitution;
            }
        }
        return $return;
    }
}
