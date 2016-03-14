<?php

include_once '../../../../include/include_backend.php';

$userId = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

try {

    if ($userId > 0) {

        $oDbaBckAdminUser = new DbaBckAdminUser();

        $oUser = $oDbaBckAdminUser->getUser($userId);

        if ($oUser) {
            //first check is removable
            //now delete item
            if ($oUser->getRemovable() == 1) {

                if ($oDbaBckAdminUser->deleteUser($userId)) {
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
                    "msg" => "No es posible eliminar el usuario seleccionado"
                );
            }
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
