<?php

include_once '../../../../include/include_backend.php';


try {

    $title = filter_var($_POST["title"], FILTER_SANITIZE_STRING);
    $description = $_POST["description"];
    
    



    $rightId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $categories = isset($_POST["category"]) && is_array($_POST["category"]) ? $_POST["category"] : array();

    if ($title && $description && count($categories) > 0) {


        $oDataRight = new DataRight();

        $oDataRight->setId($rightId);

        $oDataRight->setTitle($title);
        $oDataRight->setDescription($description);
        $oDataRight->setCategories($categories);
        
        $oDbaBckRight = new DbaBckRight();

        if ($rightId <= 0) {
            $rightId = $oDbaBckRight->createRight($oDataRight);


            if ($rightId > 0) {
                $response = array(
                    "result" => true,
                    "rightId" => $rightId,
                    "creation" => true
                );
               
            } else {
                $response = array(
                    "result" => false,
                    "creation" => true,
                    "c" => 3
                );
            }
        } else {
            $oDbaBckRight->editRight($oDataRight);

            $response = array(
                "result" => true,
                "rightId" => $rightId,
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
