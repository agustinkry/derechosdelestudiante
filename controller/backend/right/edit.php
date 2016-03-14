<?php

include_once '../../../include/include_backend.php';

$rightId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplBckRight = new TplBckRight();

$oUser = UtlSession::getBckUser();
echo $oTplBckRight->getEdit($rightId);
