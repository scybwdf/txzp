<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付跳转中...</title>
</head>
<?php
require_once("shanpayconfig.php");
require_once("lib/shanpayfunction.php");

		

/**************************请求参数**************************/

        //商户订单号
        $out_order_no = $_POST['WIDout_trade_no'];//商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $_POST['WIDsubject'];//必填

        //付款金额
        $total_fee = $_POST['WIDtotal_fee'];//必填 需为整数

        //订单描述

        $body = $_POST['WIDbody'];
		
		
		//服务器异步通知页面路径
        $notify_url = $shan_config['notify_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = $shan_config['return_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"partner" => $shan_config['partner'],
                "user_seller"  => $shan_config['user_seller'],
		"out_order_no"	=> $out_order_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url
);

//建立请求
$html_text = buildRequestFormShan($parameter, $shan_config['key']);
echo $html_text;


?>
</body>
</html>