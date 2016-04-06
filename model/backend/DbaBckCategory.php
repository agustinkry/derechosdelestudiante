<?php

class DbaBckCategory {

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

    public function createCategory(DataCategory $oCategory) {
        $db = new medoo();

        $data = array(
            "name" => $oCategory->getName(),
            "parent_id" => $oCategory->getParentId(),
            "description" => $oCategory->getDescription(),
            "icon" => $oCategory->getIcon(),
            "#created" => "NOW()"
        );


        return $db->insert(self::$table, $data);
    }

    public function editCategory(DataCategory $oCategory) {
        $db = new medoo();
        $data = array(
            "name" => $oCategory->getName(),
            "parent_id" => $oCategory->getParentId(),
            "icon" => $oCategory->getIcon(),
            "description" => $oCategory->getDescription()
        );


        return $db->update(self::$table, $data, array(//where
                    "id" => $oCategory->getId()
        ));
    }

    public function deleteCategory($categoryId) {
        $db = new medoo();

        $where = array(
            "OR" => array(
                "id" => $categoryId,
                "parent_id" => $categoryId
            )
        );

        return $db->delete(self::$table, $where);
    }

    public function getCategoryParents($id = 0) {
        $db = new medoo();

        $return = array();

        $where = array(
            "AND" => array(
                "id[!]" => $id,
                "parent_id" => null
            )
        );

        $categoryList = $db->select(self::$table, array(
            "id",
            "name"), $where
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

    public function getCategories($categories = array()) {
        $db = new medoo();

        $return = array();

        if (!$categories) {
            $where = array(
                "AND" => array(
                    "parent_id[!]" => NULL
                )
            );
        } else {
            $where = array(
                "AND" => array(
                    "parent_id[!]" => NULL,
                    "id" => $categories
                )
            );
        }

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
