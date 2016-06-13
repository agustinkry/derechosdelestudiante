<?php

class DbaBckInstitution {

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

    public function createInstitution(DataInstitution $oInstitution) {
        $db = new medoo();

        $data = array(
            "name" => $oInstitution->getName(),
            "location" => $oInstitution->getLocation(),
            "created" => date("Y-m-d H:i:s")
        );


        return $db->insert(self::$table, $data);
    }

    public function editInstitution(DataInstitution $oInstitution) {
        $db = new medoo();
        $data = array(
            "name" => $oInstitution->getName(),
            "location" => $oInstitution->getLocation()
        );


        return $db->update(self::$table, $data, array(//where
                    "id" => $oInstitution->getId()
        ));
    }

    public function getInsitutions() {
        $db = new medoo();

        $where = array();

        $institutionList = $db->select(
                self::$table, array("id", "name"), $where
        );

        $response = array();

        foreach ($institutionList as $institution) {
            $oInstitution = new DataInstitution();
            $oInstitution->loadFromArray($institution);
            $response[] = $oInstitution;
        }

        return $response;
    }

    public function deleteInstitution($institutionId) {
        $db = new medoo();

        $where = array(
            "id" => $institutionId
        );

        return $db->delete(self::$table, $where);
    }

}
