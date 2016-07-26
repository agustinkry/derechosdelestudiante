<?php

if ($_SERVER["HTTP_HOST"] == "localhost:8888") {
    define('WEB_PATH', 'http://' . $_SERVER['SERVER_NAME'] . ':8888/unicef/');
} else {
    define('WEB_PATH', 'http://' . $_SERVER['SERVER_NAME'] . '/');
}
//MAIL
define("MAIL_HOST", getenv("MAIL_HOST"));
define("FROM_MAIL", getenv("FROM_MAIL"));
define("MAIL_USERNAME", getenv("MAIL_USERNAME"));
define("MAIL_PASSWORD", getenv("MAIL_PASSWORD"));
define("MAIL_FROM_NAME", getenv("MAIL_FROM_NAME"));
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

