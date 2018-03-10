<?php
return array(
	//'配置项'=>'配置值'
	'user_seller'	=>'327605',
	'partner'		=>'849063737522697',
	'paykey'			=>'jH3BmTwdMsgaRgvjDdIItKcIn7apn9ni',
	
	//'mailhost'		=>'smtp.qq.com',
	//'mailuser'		=>'admin@yuewux.com',
	//'mailpassword'	=>'xdeoypteftpnbfcc',
	//'mailport'		=>25,
	//'mailssl'		=>0,
	'URL_ROUTER_ON'   => TRUE,
	'URL_MODEL'=>'2',
	//开启伪静态
	'URL_CASE_INSENSITIVE'=>TRUE,
	'URL_HTML_SUFFIX' => 'html|shtml|xml',
	'URL_ROUTE_RULES' => array( 
	'index'           => 'Home/Index/index',
	 'member/login'          =>'Home/Login/login',
	 'member/reg'       => 'Home/Login/register',
	
),
	
);