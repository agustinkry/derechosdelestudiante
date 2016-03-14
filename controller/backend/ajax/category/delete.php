<?php

include_once '../../../../include/include_backend.php';

$categoryId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($categoryId > 0) {

        $oDbaBckCategory = new DbaBckCategory();

        //delete item
        if ($oDbaBckCategory->deleteCategory($categoryId)) {
            $response = array(
                "result" => true
            );
        } else {
            $response = array(
                "result" => false
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
