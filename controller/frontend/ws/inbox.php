<?php
include_once '../../../include/include_frontend.php';

$content = var_export($_REQUEST, TRUE);
error_log($content);
//file_put_contents(ROOT_PATH."log/inbox.txt", $content);

//
//$fp = fopen(ROOT_PATH."log/inbox.txt", 'w');
//fwrite($fp, $content);
//fclose($fp);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

