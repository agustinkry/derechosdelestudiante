<?php
define('AVOID_SECURITY', true);
include_once '../../../include/include_backend.php';


echo TplBckLogin::getLoginHtml();


//$db = new medoo();
//$users = $db->select("admin_user", ["name", "lastName"]);
//var_dump($users);
