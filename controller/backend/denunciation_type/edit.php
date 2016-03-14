<?php

include_once '../../../include/include_backend.php';

$denuntiation = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplBckDenunciation = new TplBckDenunciationType();

echo $oTplBckDenunciation->getEdit($denuntiation);
