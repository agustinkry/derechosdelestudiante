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

    public function getChildrenCategories($parentId) {
        $db = new medoo();

        $return = array();

        $where = array(
            "AND" => array(
                "parent_id" => $parentId
            )
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

}
