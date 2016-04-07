<?php

include_once '../../include/include_frontend.php';

$search = isset($_GET["query"]) ? filter_var($_GET["query"], FILTER_SANITIZE_STRING) : 0;

$oTplFrtRights = new TplFrtRights();

if ($search) {
    echo $oTplFrtRights->getRightsBySearch($search);
} else {
    header("Location: " . WEB_PATH);
}