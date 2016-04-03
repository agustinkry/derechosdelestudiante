<?php

include_once '../../include/include_frontend.php';

$rightId = isset($_GET["id"]) ? filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplFrtRights = new TplFrtRights();

echo $oTplFrtRights->getRightsDetail($rightId);