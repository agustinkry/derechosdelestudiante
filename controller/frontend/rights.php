<?php

include_once '../../include/include_frontend.php';

$categoryId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplFrtRights = new TplFrtRights();

if ($categoryId > 0) {
    echo $oTplFrtRights->getRights($categoryId);
} else {
    header("Location: " . WEB_PATH);
}