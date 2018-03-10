<?php
require './system/lib/function.php';
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
// 定义应用目录
//define('DIR_SECURE_FILENAME','index.html');
//define('BIND_MODULE','Admin');
define('BUILD_CONTROLLER_LIST','Index,User,Menu');
define('BUILD_MODEL_LIST','User,Menu');

if(is_Mobile()){
	define('APP_NAME','wap');
	define('APP_PATH','./wap/');
	define('RUNTIME_PATH','./public/runtime/index/wap/');
}
else{
	define('APP_NAME','wf');
	define('APP_PATH','./wf/');
	define('RUNTIME_PATH','./public/runtime/index/pc/');
}
define('WEB_ROOT',dirname(__FILE__));
define('THINK_PATH',realpath('./ThinkPHP').'/');
require THINK_PATH.'ThinkPHP.php';

