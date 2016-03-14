<?php

class DbaBckDenounced {

    public static $table = "denounced";

    public function getDenounced($id) {
        $db = new medoo();
        

        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $denouncedList = $db->select(
                self::$table, array("id", "name", "urlPage", "description", "email", "image", "denunciation_type"), $where
        );
        

        if ($denouncedList) {
            $denounced = current($denouncedList);
            $oDataDenounced = new DataDenounced();
            $oDataDenounced->loadFromArray($denounced);
            return $oDataDenounced;
        } else {
            return null;
        }
    }

    public function createDenounced(DataDenounced $oDenounced) {
        $db = new medoo();

        $data = array(
            "name" => $oDenounced->getName(),
            "urlPage" => $oDenounced->getPage(),
            "email" => $oDenounced->getEmail(),
            "description" => $oDenounced->getDescription(),
            "image" => $oDenounced->getImage(),
            "denunciation_type" => $oDenounced->getDenunciationType(),
            "#created" => "NOW()"
        );
        

        return $db->insert(self::$table, $data);
    }

    public function editDenounced(DataDenounced $oDenounced) {
        $db = new medoo();
        $data = array(//values
            "name" => $oDenounced->getName(),
            "urlPage" => $oDenounced->getPage(),
            "description" => $oDenounced->getDescription(),
            "email" => $oDenounced->getEmail(),
            "image" => $oDenounced->getImage(),
            "denunciation_type" => $oDenounced->getDenunciationType()
        );
        


        return $db->update(self::$table, $data, array(//where
                    "id" => $oDenounced->getId()
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
    
    public function deleteDenounced($denouncedId){
        $db = new medoo();
        
        $where = array(
            "AND" => array(
                "id" => $denouncedId
            ),
        );
        
        return $db->delete(self::$table, $where);
    }
    
    public function getDenouncedList() {
        $db = new medoo();

        $return = array();
        
        $denouncedList = $db->select(self::$table, array(
            "id",
            "name",
            "urlPage",
            "description",
            "email",
            "image",
            "denunciation_type"), array()
        );

        foreach ($denouncedList as $denounced) {
            $oDataDenounced = new DataDenounced();
            $oDataDenounced->loadFromArray($denounced);
            $return[] = $oDataDenounced;
        }

        return $return;
    }

}
