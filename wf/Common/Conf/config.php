<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'=>'mysql', 
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'txzp',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'dakehui9118',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'wf_',    // 数据库表前缀  
    'DB_DEBUG'  			=>  TRUE, 
	'MODULE_ALLOW_LIST' => 'Home',
	'URL_CASE_INSENSITIVE'  =>  true,  
	'DEFAULT_MODULE'     => 'Home', 
	'DATA_CACHE_TYPE'=>'File',
	'MEMCACHE_HOST'   => 'tcp://127.0.0.1:11211',
	'DATA_CACHE_TIME' => 5,
	'DATA_CACHE_PREFIX'=>'wfcache_',
	//'DATA_CACHE_SUBDIR'=>true,//开启子目录
	//'DATA_CACHE_LEVEL'=>3,//设置子目录的层次
    //'MODULE_DENY_LIST'   => array('Common', 'User'),
   // 'MODULE_ALLOW_LIST'  => array('Home','Mobile'),
	'ENCRYPETION_KEY'=>'key.yuewux.com',
	'AUTO_LOGIN_TIME'=>time()+3600*24*7,
	'IMGUPLOAD_MAX_SIZE'=>5000000,
	'UPLOAD_PATH'=>'./public/',
	'UPLOAD_EXTS'=>array('jpg','png','jpeg','gif'),
     'HTML_CACHE_ON'         =>true,
   // 'HTML_CACHE_TIME'       =>3600,
    'HTML_FILE_SUFFIX'      =>'.html',
    'HTML_READ_TYPE'=>1, 
    'HTML_PATH'             =>WEB_ROOT.'/public/runtime/index/pc/htmls/',
    'HTML_CACHE_RULES'      =>array(
	'Index:'=>array('Index/{:action}_{id}',3600*4),
	'Luyan:'=>array('Luyan/{:action}_{id}',3600*4),
	//'Deal:index'=>array('Deal/{:action}_{p}',3600*4),
	'Deal:inside'=>array('Deal/{:action}_{id}',3600*4),
	'Baike:'=>array('Baike/{:action}_{id}',3600*4),
	'Article:index'=>array('Article/{:action}_{p}',60),
	'Article:inside'=>array('Article/{:action}_{id}',3600*24*30),
	'About:'=>array('About/{:action}_{id}',0)
	),
    'LOAD_EXT_CONFIG'		=>array(
	'system'=>'system',
	'mail'=>'mail'
)
	
);