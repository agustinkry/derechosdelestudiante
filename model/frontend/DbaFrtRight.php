<?php

class DbaFrtRight {

    public static $table = "rights";
    public static $tableRelCategory = "rights_category";

    public function getRight($id) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $rightList = $db->select(
                self::$table, array("id", "title", "description"), $where
        );


        if ($rightList) {
            $right = current($rightList);
            $oDataRight = new DataRight();
            $oDataRight->loadFromArray($right);

            $where = array(
                "AND" => array(
                    "id_right" => $id
                )
            );


            $categoriesArr = $db->select(self::$tableRelCategory, array("id_category"), $where);

            $categories = array();

            if ($categoriesArr) {
                foreach ($categoriesArr as $cat) {
                    $categories[] = $cat["id_category"];
                }
            }

            $oDataRight->setCategories($categories);

            return $oDataRight;
        } else {
            return null;
        }
    }

    public function getRightsByCategory($idCategory) {
        $join = array(
            '[><]' . self::$tableRelCategory => array(
                'id' => 'id_right'
            )
        );

        $where = array(
            "AND" => array(
                "rights_category.id_category" => $idCategory
            )
        );

        $db = new medoo();
        $rightsArr = $db->select(self::$table, $join, array("id", "title", "description"), $where);

        $return = array();

        if ($rightsArr) {
            foreach ($rightsArr as $right) {
                $oDataRight = new DataRight();
                $oDataRight->loadFromArray($right);
                $return[] = $oDataRight;
            }
        }

        return $return;
    }

    public function getRights() {

        $db = new medoo();
        $rightsArr = $db->select(self::$table, array("id", "title", "description"));

        $return = array();

        if ($rightsArr) {
            foreach ($rightsArr as $right) {
                $oDataRight = new DataRight();
                $oDataRight->loadFromArray($right);

                $where = array(
                    "AND" => array(
                        "id_right" => $oDataRight->getId()
                    )
                );


                $categoriesArr = $db->select(self::$tableRelCategory, array("id_category"), $where);

                $categories = array();

                if ($categoriesArr) {
                    foreach ($categoriesArr as $cat) {
                        $categories[] = $cat["id_category"];
                    }
                }

                $oDataRight->setCategories($categories);

                $return[] = $oDataRight;
            }
        }

        return $return;
    }

    public function getSearch($searchQuery) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                 "title[~]" => "%" . $searchQuery . "%"
            ),
            "LIMIT" => 1
        );

        $rightList = $db->select(
                self::$table, '*', $where
        );


        $response = array();

        foreach ($rightList as $right) {
            $oDataRight = new DataRight();
            $oDataRight->loadFromArray($right);
            $response[] = $oDataRight;
        }

        return $response;
    }

}
