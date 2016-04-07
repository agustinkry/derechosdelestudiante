<?php

class DbaFrtCategory {

    public static $table = "category";

    public function getCategory($id) {
        $db = new medoo();


        $where = array(
            "AND" => array(
                "id" => $id
            ),
            "LIMIT" => 1
        );

        $categoryList = $db->select(
                self::$table, array("id", "name", "parent_id", "icon", "description", "created", "modified"), $where
        );


        if ($categoryList) {
            $category = current($categoryList);
            $oCategory = new DataCategory();
            $oCategory->loadFromArray($category);
            return $oCategory;
        } else {
            return null;
        }
    }

    public function getAllChildrenCategories() {
        $db = new medoo();

        $return = array();

        $where = array(
            "AND" => array(
                "parent_id[!]" => NULL
            ),
            "ORDER" => "name ASC"
        );


        $categoryList = $db->select(self::$table, array(
            "id",
            "name",
            "icon",
            "parent_id"), $where
        );

        if ($categoryList) {
            foreach ($categoryList as $category) {
                $oDataCategory = new DataCategory();
                $oDataCategory->loadFromArray($category);
                $return[] = $oDataCategory;
            }
        }
        return $return;
    }

    public function getCategoryByRight($rightId) {
        $join = array(
            '[><]rights_category' => array(
                'id' => 'id_category'
            )
        );

        $where = array(
            "AND" => array(
                "rights_category.id_right" => $rightId
            )
        );

        $db = new medoo();
        $categoryItem = $db->get(self::$table, $join, array("id", "name", "parent_id", "icon", "description", "created", "modified"), $where);


        if ($categoryItem) {
            $oDataCategory = new DataCategory();
            $oDataCategory->loadFromArray($categoryItem);
            return $oDataCategory;
        }
    }

}
