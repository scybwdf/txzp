<?php
namespace Home\Controller;
use Think\Controller;
class AlipayController extends Controller{
	public function _initialize() {
        vendor('Yunpay.Yunpayfunction'); 
	}
	public function pay(){
		      $out_order_no =293949;
				  //$_POST['WIDout_trade_no'];//商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = 11111111;
			//$_POST['WIDsubject'];//必填

        //付款金额
        $total_fee = 10;
			//$_POST['WIDtotal_fee'];//必填 需为整数

        //订单描述

        $body = "dkkskks";
			//$_POST['WIDbody'];
		
		
		//服务器异步通知页面路径
        $notify_url = C('notify_url');
        //需http://格式的完整路径，不能加?id=123这类自定义参数
		
        //页面跳转同步通知页面路径
        $return_url = C('return_url');
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"partner" => C('partner'),
       	"user_seller"  => C('user_seller'),
		"out_order_no"	=> $out_order_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url
);

//建立请求
$html_text = buildRequestFormShan($parameter,C('paykey'));
echo $html_text;

	}
}