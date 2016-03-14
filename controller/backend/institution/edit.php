<?php

include_once '../../../include/include_backend.php';

$denouncedId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplBckDenounced = new TplBckInstitution();

echo $oTplBckDenounced->getEdit($denouncedId);
