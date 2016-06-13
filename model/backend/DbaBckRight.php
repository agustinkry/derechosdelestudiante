<?php

class DbaBckRight {

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

    /*
      public function getRightDenounced($id) {
      $db = new medoo();

      $where = array(
      "AND" => array(
      "right.id" => $id
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
      } */

    public function createRight(DataRight $oRight) {
        $db = new medoo();

        $data = array(
            "title" => $oRight->getTitle(),
            "description" => $oRight->getDescription(),
            "created" => date("Y-m-d H:i:s")
        );

        $idRight = $db->insert(self::$table, $data);

        if ($idRight > 0) {
            foreach ($oRight->getCategories() as $category) {
                $db->insert(self::$tableRelCategory, array(
                    "id_right" => $idRight,
                    "id_category" => $category
                ));
            }
        }

        return $idRight;
    }

    public function editRight(DataRight $oRight) {
        $db = new medoo();
        $data = array(//values
            "title" => $oRight->getTitle(),
            "description" => $oRight->getDescription()
        );



        $db->delete(self::$tableRelCategory, array(
            "AND" => array(
                "id_right" => $oRight->getId()
            )
        ));

        foreach ($oRight->getCategories() as $category) {
            $db->insert(self::$tableRelCategory, array(
                "id_right" => $oRight->getId(),
                "id_category" => $category
            ));
        }

        return $db->update(self::$table, $data, array(//where
                    "id" => $oRight->getId()
        ));
    }

    public function deleteRight($rightId) {
        $db = new medoo();

        $where = array(
            "AND" => array(
                "id" => $rightId
            ),
        );

        return $db->delete(self::$table, $where);
    }

}
