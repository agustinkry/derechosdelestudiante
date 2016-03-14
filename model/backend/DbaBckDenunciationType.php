<?php

class DbaBckDenunciationType {

    public static $table = "denunciation_type";

    public function getDenunciationType($id) {
        $db = new medoo();


        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $denunciationTypeList = $db->select(
                self::$table, array("id", "name", "description", "created", "modified"), $where
        );


        if ($denunciationTypeList) {
            $denunciationType = current($denunciationTypeList);
            $oDenunciationType = new DataDenunciationType();
            $oDenunciationType->loadFromArray($denunciationType);
            return $oDenunciationType;
        } else {
            return null;
        }
    }

    public function createDenunciationType(DataDenunciationType $oDenunciationType) {
        $db = new medoo();

        $data = array(
            "name" => $oDenunciationType->getName(),
            "description" => $oDenunciationType->getDescription(),
            "#created" => "NOW()"
        );


        return $db->insert(self::$table, $data);
    }

    public function editDenunciationType(DataDenunciationType $oDenunciationType) {
        $db = new medoo();
        $data = array(
            "name" => $oDenunciationType->getName(),
            "description" => $oDenunciationType->getDescription()
        );


        return $db->update(self::$table, $data, array(//where
                    "id" => $oDenunciationType->getId()
        ));
    }

    public function deleteDenunciationType($denunciationTypeId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $denunciationTypeId
            )
        );

        return $db->delete(self::$table, $where);
    }

    public function getDenunciationTypes() {
        $db = new medoo();

        $return = array();

        $where = array();

        $denunciationList = $db->select(self::$table, array(
            "id",
            "name"), $where
        );

        if ($denunciationList) {
            foreach ($denunciationList as $denunciation) {
                $oDenunciationType = new DataDenunciationType();
                $oDenunciationType->loadFromArray($denunciation);
                $return[] = $oDenunciationType;
            }
        }

        return $return;
    }

}
