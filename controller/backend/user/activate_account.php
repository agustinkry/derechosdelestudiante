<?php
define('AVOID_SECURITY', true);
include_once '../../../include/include_backend.php';

$token =filter_var($_GET['token'],FILTER_SANITIZE_STRING);
echo TplBckAdminUser::getActivateAccount($token);


//$db = new medoo();
//$users = $db->select("admin_user", ["name", "lastName"]);
//var_dump($users);
