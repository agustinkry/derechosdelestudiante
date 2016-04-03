<?php

include_once '../../include/include_frontend.php';

$categoryId = isset($_GET["category_id"]) ? filter_var($_GET["category_id"], FILTER_SANITIZE_NUMBER_INT) : 0;
$rightId = isset($_GET["right_id"]) ? filter_var($_GET["right_id"], FILTER_SANITIZE_NUMBER_INT) : 0;

$oTplFrtRights = new TplFrtRights();

echo $oTplFrtRights->getRightsDetail($rightId, $categoryId);