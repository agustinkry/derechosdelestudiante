<?php

include_once '../../../include/include_frontend.php';

$content = var_export(file_get_contents('php://input'), TRUE);




$html = TplFrtMail::getContactMail("test", "1", "test", "test", "test", $content);
$oMail = UtlConfigMail::getConfiguredMail();

$oMail->addAddress("pprodriguez02@gmail.com");
$oMail->Subject =  "Consulta sin asunto";
$oMail->Body = $html;

$oMail->send();

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

