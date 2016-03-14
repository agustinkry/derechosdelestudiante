<?php

include_once '../../../include/include_backend.php';

$userId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplBckAdminUser = new TplBckAdminUser();

$oUser = UtlSession::getBckUser();
echo $oTplBckAdminUser->getEdit($userId);
