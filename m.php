<?php
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_DEBUG',true);
define('APP_NAME','adminwf');
define('APP_PATH','./adminwf/');
define('WEB_ROOT',dirname(__FILE__));
define('BUILD_CONTROLLER_LIST','Index,User,Menu');
define('RUNTIME_PATH','./public/runtime/admin/');
define('BUILD_MODEL_LIST','User,Menu');
define('THINK_PATH',realpath('./ThinkPHP').'/');
require THINK_PATH.'ThinkPHP.php';
