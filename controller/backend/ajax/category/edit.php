<?php

include_once '../../../../include/include_backend.php';

$categoryId = filter_var(@$_POST["id"], FILTER_SANITIZE_NUMBER_INT);



try {

    $name = filter_var(@$_POST["name"], FILTER_SANITIZE_STRING);
    $icon = filter_var(@$_POST["icon"], FILTER_SANITIZE_STRING);
    $description = filter_var(@$_POST["description"], FILTER_SANITIZE_STRING);
    $parentId = filter_var(@$_POST["parentId"], FILTER_SANITIZE_NUMBER_INT);

    if ($name && $description && $icon) {

        if($parentId == 0){
            $parentId = null;
        }

        $oDataCategory = new DataCategory();

        $oDataCategory->setId($categoryId);
        $oDataCategory->setName($name);
        $oDataCategory->setParentId($parentId);
        $oDataCategory->setDescription($description);
        $oDataCategory->setIcon($icon);


        $oDbaBckCategory = new DbaBckCategory();

        if ($categoryId <= 0) {
            $categoryId = $oDbaBckCategory->createCategory($oDataCategory);

            if ($categoryId > 0) {
                $response = array(
                    "result" => true,
                    "categoryId" => $categoryId,
                    "creation" => true
                );
            } else {
                $response = array(
                    "result" => false,
                    "creation" => true
                );
            }
        } else {
            $editImage = false;

            $oDbaBckCategory->editCategory($oDataCategory);

            $response = array(
                "result" => true,
                "categoryId" => $categoryId,
                "creation" => false
            );
        }
    } else {
        $response = array(
            "result" => false,
            "c" => 2
        );
    }
} catch (Exception $exc) {
    $response = array(
        "result" => false,
        "c" => 1
    );
}

echo json_encode($response);
