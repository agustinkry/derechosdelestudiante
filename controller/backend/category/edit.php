<?php

include_once '../../../include/include_backend.php';

$categoryId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplBckCategory = new TplBckCategory();

$oUser = UtlSession::getBckUser();
echo $oTplBckCategory->getEdit($categoryId);
