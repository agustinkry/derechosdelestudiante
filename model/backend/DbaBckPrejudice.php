<?php

class DbaBckPrejudice {

    public static $table = "prejudice";

    public function getPrejudice($id) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $prejudiceList = $db->select(
                self::$table, array("id", "title", "urlPage", "description", "image", "denouncedId", "categoryId", "status", "correction_status", "url_correction"), $where
        );


        if ($prejudiceList) {
            $prejudice = current($prejudiceList);
            $oDataPrejudice = new DataPrejudice();
            $oDataPrejudice->loadFromArray($prejudice);
            return $oDataPrejudice;
        } else {
            return null;
        }
    }

    public function getPrejudiceDenounced($id) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "prejudice.id" => $id
            ),
            "LIMIT" => 1
        );

        $join = array(
            '[><]denounced' => array(
                'denouncedId' => 'id'
            )
        );

        $denouncedList = $db->select(self::$table, $join, array(
            "denounced.id(id)",
            "denounced.name(name)",
            "denounced.urlPage(urlPage)",
            "denounced.description(description)",
            "denounced.email(email)",
            "denounced.image(image)"), $where
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

    public function createPrejudice(DataPrejudice $oPrejudice) {
        $db = new medoo();

        $data = array(
            "title" => $oPrejudice->getTitle(),
            "urlPage" => $oPrejudice->geturlPage(),
            "description" => $oPrejudice->getDescription(),
            "image" => $oPrejudice->getImage(),
            "denouncedId" => $oPrejudice->getDenouncedId(),
            "categoryId" => $oPrejudice->getCategoryId(),
            "correction_status" => $oPrejudice->getCorrectionStatus(),
            "url_correction" => $oPrejudice->getUrlCorrection(),
            "#created" => "NOW()"
        );
        return $db->insert(self::$table, $data);
    }

    public function editPrejudice(DataPrejudice $oPrejudice) {
        $db = new medoo();
        $data = array(//values
            "title" => $oPrejudice->getTitle(),
            "urlPage" => $oPrejudice->geturlPage(),
            "description" => $oPrejudice->getDescription(),
            "image" => $oPrejudice->getImage(),
            "denouncedId" => $oPrejudice->getDenouncedId(),
            "correction_status" => $oPrejudice->getCorrectionStatus(),
            "url_correction" => $oPrejudice->getUrlCorrection(),
            "categoryId" => $oPrejudice->getCategoryId()
        );



        return $db->update(self::$table, $data, array(//where
                    "id" => $oPrejudice->getId()
        ));
    }

    public function deletePrejudice($prejudiceId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $prejudiceId
            ),
        );

        return $db->delete(self::$table, $where);
    }

    public function changeStatus($prejudiceId, $status) {
        $db = new medoo();

         $data = array(//values
            "status" => $status
        );
         
        $where = array(
            "AND" => array(
                "id" => $prejudiceId
            ),
        );

        return $db->update(self::$table, $data, $where);
    }

}
