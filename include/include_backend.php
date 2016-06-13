<?php

include_once 'include_common.php';

include_once 'lib/ssp.class.php';
//PATH
define('TPL_PATH', ROOT_PATH . 'html/tpl/backend/');

//URL
define('ADMIN_URL', WEB_PATH . 'studentcms/');
define('CSS_URL', WEB_PATH . 'html/css/backend/');
define('IMG_URL', WEB_PATH . 'html/img/backend/');



include_once 'backend_security.php';

date_default_timezone_set('America/Montevideo');