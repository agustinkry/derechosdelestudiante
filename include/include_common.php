<?php

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', realpath(dirname(__FILE__) . '/../') . '/');
}

require_once ROOT_PATH . 'include/config_site.php';
require_once ROOT_PATH . 'include/config_mysql.php';

define("COMMON_HTML_URL", WEB_PATH . "html/");
define("COMMON_JS_URL", COMMON_HTML_URL . "js/");
define("MEDIA_URL", WEB_PATH . "media/");
define("MEDIA_DENOUNCED_URL", MEDIA_URL . "denounced/");
define("MEDIA_PREJUDICE_URL", MEDIA_URL . "prejudice/");

define("TEMP_PATH", ROOT_PATH."tmp/");
define("MEDIA_PATH", ROOT_PATH."media/");
define("MEDIA_DENOUNCED_PATH", MEDIA_PATH."denounced/");
define("MEDIA_PREJUDICE_PATH", MEDIA_PATH."prejudice/");

function __autoload($class_name) {
    if (strrpos($class_name, 'Tpl') === 0) {//CLASES LOGICAS
        if (strrpos($class_name, 'TplBck') === 0) {
            require_once ROOT_PATH . 'view/backend/' . $class_name . '.php';
        } else {
            require_once ROOT_PATH . 'view/frontend/' . $class_name . '.php';
        }
    } else if (strrpos($class_name, 'Dba') === 0) {//CLASES LOGICAS
        if (strrpos($class_name, 'DbaBck') === 0) {
            require_once ROOT_PATH . 'model/backend/' . $class_name . '.php';
        } else {
            require_once ROOT_PATH . 'model/frontend/' . $class_name . '.php';
        }
    } else if (strrpos($class_name, 'Utl') === 0) {
        require_once ROOT_PATH . 'include/utilities/' . $class_name . '.php';
    } else if (strrpos($class_name, 'medoo') === 0) {//MEDOO
        require_once ROOT_PATH . 'include/lib/' . str_replace('_', '/', $class_name) . '.php';
    } else if (strrpos($class_name, 'TemplatePower') === 0) {//TemplatePower
        require_once(ROOT_PATH . 'include/lib/class.' . $class_name . '.inc.php');
    } else if (strrpos($class_name, 'Data') === 0) {
        require_once ROOT_PATH . 'model/common/DataType/' . $class_name . '.php';
    }
}
