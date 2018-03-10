<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'=>'mysql', 
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'txzp',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '1234',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'wf_',    // 数据库表前缀  
    'DB_DEBUG'  			=>  true,
	'URL_CASE_INSENSITIVE'  =>  true,
    'URL_HTML_SUFFIX' => '',
	'DEFAULT_MODULE'     => 'Home',
    //'MODULE_DENY_LIST'   => array('Common', 'User'),
    'MODULE_ALLOW_LIST'  => array('Home'),
     'ENCRYETION_KEY'        =>'key.felixyuewu.com',
	'SMS_ON'				=>1,
    'AUTO_LOGIN_TIME'       =>time()+3600*24*7,
    'AUTH_ON'           => true,                      // 认证开关
    'AUTH_TYPE'         => 1,                         // 认证方式，1为实时认证；2为登录认证。
    'AUTH_GROUP'        => 'auth_group',        // 用户组数据表名
    'AUTH_GROUP_ACCESS' => 'auth_group_access', // 用户-用户组关系表
    'AUTH_RULE'         => 'auth_rule',         // 权限规则表
    'AUTH_USER'         => 'admin',
    'URL_MODULE'        =>'1',
    'IMGUPLOAD_MAX_SIZE'=>5000000,
	'UPLOAD_PATH'=>'./public/',
	'UPLOAD_EXTS'=>array('jpg','png','jpeg','gif'),
    //'VAR_SESSION_ID'=>'session_id',
);
